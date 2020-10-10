<?php

namespace App\Http\Livewire;

use App\Models\AssignmentSubmission;
use Livewire\Component;

class AssignmentDetailAssignScoreModal extends Component
{
    public $assignment;
    public $submissionId;
    public $score = 0;
    public $name;

    public function assignScore(){
        $this->validate([
            'submissionId' => 'required|exists:assignment_submissions,id',
            'score' => 'required|numeric|min:0|max:100'
        ]);

        $submission = AssignmentSubmission::find($this->submissionId);
        if($submission->assignment->id === $this->assignment->id){
            // Change score
            $submission->update([
                'score' => $this->score
            ]);
//            $this->emit('loadAssignmentData');
            $this->emit('assignScoreDone');
            $this->emit('alert', [
                'type' => 'success',
                'message' => 'Score has been set'
            ]);
        }
        $this->reset(['score', 'submissionId']);
    }

    public function render()
    {
        return view('livewire.assignment-detail-assign-score-modal');
    }
}
