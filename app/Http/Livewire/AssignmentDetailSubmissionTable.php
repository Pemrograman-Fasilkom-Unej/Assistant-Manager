<?php

namespace App\Http\Livewire;

use App\Abstracts\LivewireTable;
use App\Models\AssignmentSubmission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Flysystem\Filesystem;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;
use Livewire\Component;

class AssignmentDetailSubmissionTable extends LivewireTable
{
    public $assignment;
    public $students;
    public $cacheData;

    protected $listeners = [
        'loadAssignmentData' => 'getData'
    ];

    public function mount()
    {
        $this->getData();
    }

    public function render()
    {
        return view('livewire.assignment-detail-submission-table');
    }

    public function getData()
    {
        $assignment = $this->assignment;
        $this->students = $this->assignment
            ->classroom
            ->members()
            ->with('submissions', function ($q) use ($assignment) {
                $q->where('assignment_id', $assignment->id);
            })
            ->get()
            ->map(function ($student) {
                $student->submission = $student->submissions[0] ?? null;
                $student->status = $student->submission ? (!is_null($student->submission->score) ? 'Done' : 'Submitted') : 'Not Submitted';
                $student->status_badge = $student->status === 'Done' ? 'success' : ($student->status === 'Submitted' ? 'info' : 'danger');
                return $student;
            })
            ->sortByDesc('submission.created_at');
    }

    public function downloadAllSubmission()
    {
        $files = Storage::cloud()->files('assignment/submissions/');
        $path = "downloadable/" . Str::slug($this->assignment->classroom->title) . "_" . Str::slug($this->assignment->title) . "_" . now()->format('Y-m-d_H-i') . '.zip';
        $download_path = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix() . $path;
        $zip = new Filesystem(new ZipArchiveAdapter($download_path));
        foreach ($files as $file) {
            $zip->put($file, Storage::cloud()->get($file));
        }

        $zip->getAdapter()->getArchive()->close();
        $this->redirect(Storage::disk('public')->url($path));
    }
}
