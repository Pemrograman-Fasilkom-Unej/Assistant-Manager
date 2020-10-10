<?php

namespace App\Http\Livewire;

use App\Abstracts\LivewireTable;
use App\Models\AssignmentSubmission;
use App\Repositories\AssignmentRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Flysystem\Filesystem;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;
use Livewire\Component;
use Livewire\WithPagination;

class AssignmentDetailSubmissionTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $assignment;
    public $search;

    protected $listeners = [
        'loadAssignmentData' => 'refreshData'
    ];

    public function refreshData()
    {
        $this->resetPage();
    }

    public function render()
    {
        $students = AssignmentRepository::getStudentSubmissions($this->search, $this->assignment)->paginate(10);

        foreach ($students as $student) {
            $student->submission = $student->submissions[0] ?? null;
            $student->status = $student->submission ? (!is_null($student->submission->score) ? 'Done' : 'Submitted') : 'Not Submitted';
            $student->status_badge = $student->status === 'Done' ? 'success' : ($student->status === 'Submitted' ? 'info' : 'danger');
        }

        return view('livewire.assignment-detail-submission-table', compact('students'));
    }

    public function downloadAllSubmission()
    {
        $files = Storage::cloud()->files('assignment/submissions/' . $this->assignment->token);
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
