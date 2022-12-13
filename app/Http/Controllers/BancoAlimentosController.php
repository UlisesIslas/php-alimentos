<?php

namespace App\Http\Controllers;

use App\Models\BancoAlimentos;
use Illuminate\Http\Request;

class BancoAlimentosController extends Controller
{
    public function index()
    {
        //$bancosAlimentos = BancoAlimentos::orderBy('nombre', 'asc')->get();
        $bancosAlimentos = BancoAlimentos::with('municipio')->orderBy('nombre', 'asc')->get();
        return $this->getResponse200($bancosAlimentos);
    }


    public function store(Request $request)
    {
            $bancoAlimentos = new BancoAlimentos();
            $bancoAlimentos->nombre = $request->nombre;
            $bancoAlimentos->municipio_id = $request->municipio_id;
            $bancoAlimentos->save();
            return $this->getResponse201("Municipio","created",$bancoAlimentos);
    }


    public function show($id)
    {
        $bancoAlimentos = BancoAlimentos::find($id);
        if($bancoAlimentos){
            return $this->getResponse200($bancoAlimentos);
        }else{
            return $this->getResponse404();
        }
    }

  
    
    public function update(Request $request, $id)
    {
        //DB::beginTransaction();
        try{
        $bancoAlimentos = BancoAlimentos::find($id);
        if ($bancoAlimentos) {
            $bancoAlimentos->nombre = $request->nombre;
            $bancoAlimentos->municipio_id = $request->municipio_id;
            $bancoAlimentos->update();
            return $this->getResponse201("Municipio","updated",$bancoAlimentos);
            
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
        $bancoAlimentos = BancoAlimentos::find($id);
        if($bancoAlimentos){
            $bancoAlimentos->delete();
            return $this->getResponseDelete200($bancoAlimentos);
        }else{
            return $this->getResponse404();
        }
    }
}
