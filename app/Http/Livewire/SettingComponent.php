<?php

namespace App\Http\Livewire;

use App\Models\Classroom;
use App\Models\Setting;
use Livewire\Component;

class SettingComponent extends Component
{
    public $tab = 'general';
    public $year;
    public $season;
    private $settings;

    public function mount()
    {
        $this->settings = Setting::select('name', 'value')->get();
        $this->year = $this->settings->where('name', 'year')->first()->value;
        $this->season = $this->settings->where('name', 'season')->first()->value;
    }

    public function updateAcademic()
    {
        $current_year = Setting::where('name', 'year')->first();
        $current_season = Setting::where('name', 'season')->first();

        Classroom::where('year', $current_year->value)
            ->where('season', $current_season->value)->update([
                'status' => 0
            ]);

        $current_year->update([
            'value' => $this->year
        ]);

        $current_season->update([
            'value' => $this->season
        ]);

        Classroom::where('year', $this->year)
            ->where('season', $this->season)->update([
                'status' => 1
            ]);
    }

    public function render()
    {
        return view('livewire.setting-component');
    }
}
