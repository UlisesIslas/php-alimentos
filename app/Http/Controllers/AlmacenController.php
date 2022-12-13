<?php

namespace App\Http\Controllers;

use App\Models\Almacen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlmacenController extends Controller
{
    public function index()
    {
        //$almacenes = Almacen::orderBy('id', 'asc')->get();
        $almacenes = Almacen::with('cadenaComercial', 'alimento')->orderBy('id', 'asc')->get();
        return $this->getResponse200($almacenes);
    }

    public function alimentosAlmacen($id) {
        //$alimentos = DB::select('SELECT ali.nombre FROM recolecciones r INNER JOIN almacenes a ON a.id = r.almacen_id INNER JOIN cadenas_comerciales cc ON cc.id = a.cadena_comercial_id INNER JOIN almacenes a2 ON a2.cadena_comercial_id = cc.id INNER JOIN alimentos ali ON ali.id = a2.alimentos_id WHERE r.usuario_id = ? AND r.id = ?',)
        $alimentos = DB::select('SELECT al.nombre, al.id FROM almacenes a INNER JOIN alimentos al ON al.id = a.alimentos_id WHERE a.cadena_comercial_id = ?', [$id]);
        return $this->getResponse200($alimentos);
    }


    public function store(Request $request)
    {
            $almacen = new Almacen();
            $almacen->cadena_comercial_id = $request->cadena_comercial_id;
            $almacen->alimentos_id = $request->alimentos_id;
            $almacen->save();
            return $this->getResponse201("Municipio","created",$almacen);
    }


    public function show($id)
    {
        $almacen = Almacen::find($id);
        if($almacen){
            return $this->getResponse200($almacen);
        }else{
            return $this->getResponse404();
        }
    }

  
    
    public function update(Request $request, $id)
    {
        //DB::beginTransaction();
        try{
        $almacen = Almacen::find($id);
        if ($almacen) {
            $almacen->cadena_comercial_id = $request->cadena_comercial_id;
            $almacen->alimentos_id = $request->alimentos_id;
            $almacen->update();
            return $this->getResponse201("Municipio","updated",$almacen);
            
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
        $almacen = Almacen::find($id);
        if($almacen){
            $almacen->delete();
            return $this->getResponseDelete200($almacen);
        }else{
            return $this->getResponse404();
        }
    }
}
