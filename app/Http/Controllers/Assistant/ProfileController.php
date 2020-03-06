<?php

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $assistant = Auth::user();
        return view('dashboard.assistant.profile.index', compact('assistant'));
    }

    public function update(Request $request){
        $assistant = Auth::user();
        $this->validate($request, [
            'name' => 'required|min:3|max:32',
            'nim' => 'required|max:15',
            '_avatar' => 'image'
        ]);

        $assistant->update([
            'name' => $request->name,
            'nim' => $request->nim,
        ]);

        if($request->has('_avatar')){
            Storage::disk('public')->delete($assistant->avatar);
            $file = $request->file('_avatar');
            $avatar = Storage::disk('public')->put("assets/assistants", $file);
            $assistant->update([
                'avatar' => 'storage/' . $avatar
            ]);
        }

        if(!is_null($request->new_password)){
            $assistant->update([
                'password' => Hash::make($request->new_password)
            ]);
        }

        toastr()->success('Profil berhasil diupdate');
        return redirect()->back();
    }
}
