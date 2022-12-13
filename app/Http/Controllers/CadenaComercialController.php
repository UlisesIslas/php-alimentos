<?php

namespace App\Http\Controllers;

use App\Models\CadenaComercial;
use Illuminate\Http\Request;

class CadenaComercialController extends Controller
{
    public function index()
    {
        $cadenasComerciales = CadenaComercial::orderBy('nombre', 'asc')->get();
        return $this->getResponse200($cadenasComerciales);
    }


    public function store(Request $request)
    {
            $cadenaComercial = new CadenaComercial();
            $cadenaComercial->nombre = $request->nombre;
            $cadenaComercial->status = $request->status;
            $cadenaComercial->save();
            return $this->getResponse201("Municipio","created",$cadenaComercial);
    }


    public function show($id)
    {
        $cadenaComercial = CadenaComercial::find($id);
        if($cadenaComercial){
            return $this->getResponse200($cadenaComercial);
        }else{
            return $this->getResponse404();
        }
    }

  
    
    public function update(Request $request, $id)
    {
        //DB::beginTransaction();
        try{
        $cadenaComercial = CadenaComercial::find($id);
        if ($cadenaComercial) {
            $cadenaComercial->nombre = $request->nombre;
            $cadenaComercial->status = $request->status;
            $cadenaComercial->update();
            return $this->getResponse201("Municipio","updated",$cadenaComercial);
            
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
        $cadenaComercial = CadenaComercial::find($id);
        if($cadenaComercial){
            $cadenaComercial->delete();
            return $this->getResponseDelete200($cadenaComercial);
        }else{
            return $this->getResponse404();
        }
    }
}
