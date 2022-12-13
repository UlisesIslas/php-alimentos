<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use Illuminate\Http\Request;

class ConvenioController extends Controller
{
    public function index()
    {
        //$convenios = Convenio::orderBy('id', 'asc')->get();
        $convenios = Convenio::with('municipio', 'cadenaComercial')->orderBy('id', 'asc')->get();
        return $this->getResponse200($convenios);
    }


    public function store(Request $request)
    {
            $convenio = new Convenio();
            $convenio->municipio_id = $request->municipio_id;
            $convenio->cadena_comercial_id = $request->cadena_comercial_id;
            $convenio->save();
            return $this->getResponse201("Municipio","created",$convenio);
    }


    public function show($id)
    {
        $convenio = Convenio::find($id);
        if($convenio){
            return $this->getResponse200($convenio);
        }else{
            return $this->getResponse404();
        }
    }

  
    
    public function update(Request $request, $id)
    {
        //DB::beginTransaction();
        try{
        $convenio = Convenio::find($id);
        if ($convenio) {
            $convenio->municipio_id = $request->municipio_id;
            $convenio->cadena_comercial_id = $request->cadena_comercial_id;
            $convenio->update();
            return $this->getResponse201("Municipio","updated",$convenio);
            
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
        $convenio = Convenio::find($id);
        if($convenio){
            $convenio->delete();
            return $this->getResponseDelete200($convenio);
        }else{
            return $this->getResponse404();
        }
    }
}
