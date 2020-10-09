<?php


namespace App\Abstracts;

use App\Interfaces\LivewireTableData;
use App\Traits\LivewireTableComponent;
use Livewire\Component;

abstract class LivewireTable extends Component implements LivewireTableData
{
    use LivewireTableComponent;
}
