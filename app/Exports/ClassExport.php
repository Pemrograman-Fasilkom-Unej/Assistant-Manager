<?php

namespace App\Exports;

use App\Classes;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ClassExport implements FromView, WithColumnFormatting, ShouldAutoSize
{
    private $class;
    public function __construct($class_id)
    {
        $this->class = Classes::with('students.student', 'tasks.submissions.student')->find($class_id);
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return \view('excel.class-recap', ['class' => $this->class]);
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'B' => '@'
        ];
    }
}
