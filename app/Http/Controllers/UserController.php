<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User as Model;

class UserController extends Controller
{
   
    public function index()
    {
        return view('operator.user_index', [
            'models' => Model::where('akses','<>','wali')
            ->latest()
            ->paginate(50)
        ]);
    }

    
    public function create()
    {
        $data = [
            'model' => new \App\Models\User(),
             'method' => 'POST',
             'route' => 'user.store',
             'button' => 'SIMPAN'
        ];
        return view('operator.user_form', $data); 
    }

   
    public function store(Request $request)
    {
        $requestData = $request->Validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'nohp' => 'required|unique:users',
            'akses' => 'required|in:operator,admin',
            'password' => 'required'
        ]);
        $requestData['password'] = bcrypt($requestData['password']);
        $requestData['email_verified_at'] = now();
        Model::create($requestData);
        flash('data berhasil disimpan');
        return back();
    }

    
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
