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
        $requestData = $request->validate([
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
        $data = [
            'model' => \App\Models\User::findOrFail($id), 
             'method' => 'PUT',
             'route' => ['user.update'. $id],
             'button' => 'UPDATE'
        ];
        return view('operator.user_form', $data); 
    }

    
    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users, email,'. $id,
            'nohp' => 'required|unique:users, nohp,' . $id,
            'akses' => 'required|in:operator,admin',
            'password' => 'nullable'
        ]);
        $model = Model::findOrFail($id);
        if ($requestData['password'] == ""){
            unset($requestData['password']);
        }else{
            $requestData['password'] = bcrypt($requestData['password']);
        }
        $model->fill($requestData);
        $model->save();
        flash('data berhasil diupdate');
        return redirect()->route('user.index');
    }

   
    public function destroy($id)
    {
        $model = Model::findOrFail($id);

        if ($model->id == 1){
            flash('data tidak bisa dihapus')->error();
            return back();
        }


        $model->delete();
        flash('data berhasil dihapus');
        return back();
    }
}
