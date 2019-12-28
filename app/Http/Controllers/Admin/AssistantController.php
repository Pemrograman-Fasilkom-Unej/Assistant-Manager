<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AssistantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.assistant.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.assistant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:32',
            'nim' => 'required|max:15',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:3|max:32|unique:users,username',
            'password' => 'required|min:3|max:32'
        ]);

        $request->request->set('password', Hash::make($request->password));
        $request->request->set('role_id', 2);
        User::create($request->all());
        toastr()->success("Asisten Berhasil Ditambahkan");
        return redirect()->route('admin.assistant.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $assistant)
    {
        return view('dashboard.admin.assistant.show', compact('assistant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $assistant)
    {
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
