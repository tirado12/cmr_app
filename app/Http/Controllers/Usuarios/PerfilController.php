<?php

namespace App\Http\Controllers\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless(Auth::check(), 404);
        $usuario = $request->user();
        $user = User::find($usuario->id);
        return view('perfil.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $user= User::find($id);
        
        //  return view('perfil.index', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $user =User::find(Auth::user()->id);
        $data=$request->all();
        if(empty($data['password'])){
            $request->validate([
                'name' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'area' => 'required'
            ]);
            $data['password'] = $user->password;
            if(!empty($request->file('img'))) {
                $file = $request->file('img');
                File::delete(public_path($user->img));
                $destinationPath = public_path("usuarios/").$user->id;
                $file->move($destinationPath, $file->getClientOriginalName());
                $destinationPath = "/usuarios/".$user->id.'/'. $file->getClientOriginalName();
                $data['img'] = $destinationPath;
            }
            $user->update($data);
        }else{
            $request->validate([
                'name' => 'required',
                'lastname' => 'required',
                'email' => 'required',
                'area' => 'required',
                'password' => 'required'
            ]);
            if(!empty($request->file('img'))) {
                $file = $request->file('img');
                $destinationPath = public_path("usuarios\\").$user->id;
                $file->move($destinationPath, $file->getClientOriginalName());
                $destinationPath = "\\usuarios\\".$user->id.'\\'. $file->getClientOriginalName();
                $data['img'] = $destinationPath;
            }
            $data['password'] = bcrypt($data['password']);
            $user->update($data);
        }
        return redirect()->route('perfil.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
