<?php

namespace App\Http\Livewire;

use App\Models\Classroom;
use App\Models\Setting;
use App\Models\Topic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class ClassroomCreateCard extends Component
{
    public $topics;
    public $classes;
    public $assistants;
    public $programs;
    public $days;

    public $topic;
    public $program;
    public $class;
    public $day = 0;
    public $time;
    public $selected_assistants;

    public function mount()
    {
        $this->topics = Topic::select(['id','name', 'slug'])->get()->toArray();
        $this->classes = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
        $this->programs = [
            "SI" => "Sistem Informasi",
            "TI" => "Teknologi Informasi",
            "IF" => "Informatika",
            "O" => "Other"
        ];
        $this->days = [
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jum'at",
            "Sabtu",
            "Minggu"
        ];
        $this->assistants = User::select('id', 'name', 'username')
            ->role('assistant')
            ->get()
            ->toArray();
    }

    public function submit(){
        $this->validate([
            'topic' => 'required|exists:topics,id',
            'program' => 'required',
            'class' => 'required',
            'day' => 'required|numeric|min:0|max:6',
            'time' => 'required',
            'selected_assistants' => 'required|array'
        ]);

        try {
            DB::beginTransaction();
            $topic = Topic::find($this->topic);
            $year = Carbon::now()->year;
            $season = Setting::where('name', 'season')->first()->value;
            $title = "$topic->name | $this->program - $this->class | $year/$season";
            $classroom = Classroom::create([
                'topic_id' => $this->topic,
                'title' => $title,
                'slug' => Str::slug($title),
                'year' => $year,
                'season' => $season,
                'class_day' => $this->day + 1,
                'class_time' => date("H:i", strtotime($this->time)),
                'status' => 0
            ]);
            $classroom->assistants()->attach($this->selected_assistants);
            DB::commit();

            if(Auth::user()->hasRole('admin')){
                $this->redirect(route('dashboard.admin.classroom.index'));
            } else {

            }
        } catch (\Exception $e){
            DB::rollBack();
            dd($e, "Please ss and contact admin");
        }
    }

    public function render()
    {
        return view('livewire.classroom-create-card');
    }
}
