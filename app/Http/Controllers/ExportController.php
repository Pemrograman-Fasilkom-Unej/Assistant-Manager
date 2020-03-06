<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Exports\ClassExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportClass($id){
        $class = Classes::find($id);
        $this->authorize('view', $class);
        return Excel::download(new ClassExport($class->id), "$class->year-$class->semester-$class->title.xlsx");
    }
}
