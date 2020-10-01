<?php

namespace App\Http\Controllers\Admin;

use App\Classes;
use App\Config;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    public function index()
    {
        $configs = Config::get();
        return view('dashboard.admin.config.index', compact('configs'));
    }

    public function changeYear(Request $request)
    {
        $this->validate($request, [
            'year' => 'required|numeric',
            'semester' => 'required|numeric'
        ]);

        try {
            DB::beginTransaction();
            $yearModel = Config::where('key', 'year')->first();
            $semesterModel = Config::where('key', 'semester')->first();

            Classes::where('year', (clone $yearModel)->value)
                ->where('semester', (clone $semesterModel)->value)
                ->update([
                    'status' => 0
                ]);

            Classes::where('year', $request->year)
                ->where('semester', $request->semester)
                ->update([
                    'status' => 1
                ]);

            $a = $yearModel->update([
                'value' => $request->year
            ]);

            $semesterModel->update([
                'value' => $request->semester
            ]);

            Cache::forever('year', $request->year);
            Cache::forever('semester', $request->semester);

            DB::commit();
            return redirect()->back()->with('success', 'Pengaturan Tahun dan Semester berhasil diubah');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
