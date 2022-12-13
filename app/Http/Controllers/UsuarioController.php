<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::orderBy('nombre', 'asc')->get();
        return $this->getResponse200($usuarios);
    }


    public function store(Request $request)
    {
            $usuario = new Usuario();
            $usuario->correo = $request->correo;
            $usuario->password = $request->password;
            $usuario->nombre = $request->nombre;
            $usuario->apellido1 = $request->apellido1;
            $usuario->apellido2 = $request->apellido2;
            $usuario->status = $request->status;
            $usuario->municipio_id = $request->municipio_id;
            $usuario->save();
            return $this->getResponse201("Usuario","created",$usuario);
    }


    public function show($id)
    {
        $usuario = Usuario::find($id);
        if($usuario){
            return $this->getResponse200($usuario);
        }else{
            return $this->getResponse404();
        }
    }

  
    
    public function update(Request $request, $id)
    {
        //DB::beginTransaction();
        try{
        $usuario = Usuario::find($id);
        if ($usuario) {
            $usuario->correo = $request->correo;
            $usuario->password = $request->password;
            $usuario->nombre = $request->nombre;
            $usuario->apellido1 = $request->apellido1;
            $usuario->apellido2 = $request->apellido2;
            $usuario->status = $request->status;
            $usuario->municipio_id = $request->municipio_id;
            $usuario->update();
            return $this->getResponse201("Usuario","updated",$usuario);
            
        } else {
            return $this->getResponse404();
        }
        //DB::commit();
        }catch(Exception $e){
            return $this->getResponse500($e->getMessage());
          //  DB::rollBack();
        }
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        if($usuario){
            $usuario->delete();
            return $this->getResponseDelete200($usuario);
        }else{
            return $this->getResponse404();
        }
    }
}
