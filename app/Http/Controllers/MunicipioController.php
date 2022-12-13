<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class MunicipioController extends Controller
{
  
    public function index()
    {
        $municipios = Municipio::orderBy('nombre', 'asc')->get();
        return $this->getResponse200($municipios);
    }


    public function store(Request $request)
    {
            $municipio = new Municipio();
            $municipio->nombre = $request->nombre;
            $municipio->save();
            return $this->getResponse201("Municipio","created",$municipio);
    }


    public function show($id)
    {
        $municipio = Municipio::find($id);
        if($municipio){
            return $this->getResponse200($municipio);
        }else{
            return $this->getResponse404();
        }
    }

  
    
    public function update(Request $request, $id)
    {
        //DB::beginTransaction();
        try{
        $municipio = Municipio::find($id);
        if ($municipio) {
            $municipio->nombre = $request->nombre;
            $municipio->update();
            return $this->getResponse201("Municipio","updated",$municipio);
            
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
        $municipio = Municipio::find($id);
        if($municipio){
            $municipio->delete();
            return $this->getResponseDelete200($municipio);
        }else{
            return $this->getResponse404();
        }
    }
}
