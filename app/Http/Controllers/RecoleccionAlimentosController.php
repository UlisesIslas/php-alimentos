<?php

namespace App\Http\Controllers;

use App\Models\Recoleccion;
use App\Models\RecoleccionAlimentos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecoleccionAlimentosController extends Controller
{
    public function index()
    {
        $recolecciones = RecoleccionAlimentos::with('recoleccion', 'alimento')->orderBy('id', 'asc')->get();
        return $this->getResponse200($recolecciones);
    }

    public function alimentosRecolectados($id)
    {
        $tmp = Recoleccion::find($id);
        if ($tmp->usuario_id == auth()->user()->id) {
            $recolecciones = DB::select('SELECT ra.id,ra.comentarios,ra.foto,a.nombre AS alimento, ca.nombre AS categoria FROM recoleccion_alimentos ra INNER JOIN alimentos a ON a.id = ra.alimento_id INNER JOIN categorias_alimentos ca ON ca.id = a.categoria_alimentos_id WHERE ra.recoleccion_id = ?', [$id]);
            return $this->getResponse200($recolecciones);
        }
        return $this->getResponse403();
    }

    public function store(Request $request)
    {
        $recoleccion = new RecoleccionAlimentos();
        $recoleccion->recoleccion_id = $request->recoleccion_id;
        $recoleccion->alimento_id = $request->alimento_id;
        $tmpRec = Recoleccion::find($request->recoleccion_id);
        if ($tmpRec->status == 1) {
            $tmpRec->status = 2;
            $tmpRec->save();
        }
        //$recoleccion->comentarios = $request->comentarios;
        $recoleccion->save();
        return $this->getResponse200($recoleccion);
        //$response = $this->response();
        /* DB::beginTransaction();
        try {
        $recoleccion = new RecoleccionAlimentos();
        $recoleccion->recoleccion_id = $request->recoleccion_id;
        $recoleccion->alimento_id = $request->alimento_id;
        $recoleccion->comentarios = $request->comentarios;
        $recoleccion->save();
        return $this->getResponse200($recoleccion);
        DB::commit();
        } catch (Exception $e) {
        return $this->getResponse500($e->getMessage());
        DB::rollBack();
        } */
    }

    public function show($id)
    {
        $recoleccion = RecoleccionAlimentos::find($id);
        if ($recoleccion) {
            return $this->getResponse200($recoleccion);
        } else {
            return $this->getResponse404();
        }
    }

    public function update(Request $request, $id)
    {
       // DB::beginTransaction();
        try {
            $recoleccion = RecoleccionAlimentos::find($id);
            if ($recoleccion) {
               
                $recoleccion->comentarios = $request->comentarios;
                $recoleccion->foto = $request->foto;
                $recoleccion->update();
                return $this->getResponse201("RecoleccionAlimentos", "updated", $recoleccion);
            } else {
                return $this->getResponse404();
            }
            //DB::commit();
        } catch (Exception $e) {
            return $this->getResponse500($e->getMessage());
           // DB::rollBack();
        }
    }
}