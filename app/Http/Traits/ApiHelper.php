<?php
namespace App\Http\Traits;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

trait ApiHelper {
    protected function validateData(Request $request, $rules)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), $rules);
        if($validator->fails()){
            json_response(0, "errors", $validator->errors())->send();
            die();
        }
    }

    protected function paginate(Collection $data, $row, $page){
        return json_response(1, "", $data->forPage($page, $row)->values());
    }
}