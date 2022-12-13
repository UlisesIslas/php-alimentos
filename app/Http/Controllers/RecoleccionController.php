<?php

namespace App\Http\Controllers;

use App\Models\Recoleccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecoleccionController extends Controller
{
    public function index()
    {
        //$recolecciones = Recoleccion::orderBy('id', 'asc')->get();
        $recolecciones = Recoleccion::with('usuario', 'almacen')->orderBy('id', 'asc')->get();
        return $this->getResponse200($recolecciones);
    }

    public function recoleccionesUsuario()
    {
        //$recolecciones = Recoleccion::with('usuario', 'almacen')->where('usuario_id', auth()->user()->id)->orderBy('id', 'asc')->get();
        $recolecciones = DB::select('SELECT r.status, r.id, r.usuario_id, cc.nombre, a.id AS almacen FROM recolecciones r INNER JOIN almacenes a ON a.id = r.almacen_id INNER JOIN cadenas_comerciales cc ON cc.id = a.cadena_comercial_id WHERE r.usuario_id = ?', [auth()->user()->id]);
        return $this->getResponse200($recolecciones);
    }

    public function updateStatus($id)
    {
        $recoleccion = Recoleccion::find($id);
        if ($recoleccion->usuario_id == auth()->user()->id) {
            if ($recoleccion->status < 3) {
                $recoleccion->status = $recoleccion->status + 1;
                $recoleccion->update();
            }
            return $this->getResponse200($recoleccion);
        }
        return $this->getResponse403();
    }

    public function origenDestino($id)
    {
        $recoleccion = DB::select('SELECT cc.nombre AS cadena, ba.nombre AS banco FROM recolecciones r INNER JOIN almacenes alc ON alc.id = r.almacen_id INNER JOIN cadenas_comerciales cc ON cc.id = alc.cadena_comercial_id INNER JOIN users u ON u.id = r.usuario_id INNER JOIN municipios m ON m.id = u.municipio_id INNER JOIN banco_alimentos ba ON ba.municipio_id = m.id WHERE r.id = ?', [$id]);
        return $this->getResponse200($recoleccion);
    }


    public function store(Request $request)
    {
        $recoleccion = new Recoleccion();
        $recoleccion->usuario_id = $request->usuario_id;
        $recoleccion->alimentos_id = $request->alimentos_id;
        $recoleccion->save();
        return $this->getResponse201("Municipio", "created", $recoleccion);
    }


    public function show($id)
    {
        $recoleccion = Recoleccion::find($id);
        if ($recoleccion) {
            return $this->getResponse200($recoleccion);
        } else {
            return $this->getResponse404();
        }
    }



    public function update(Request $request, $id)
    {
        //DB::beginTransaction();
        try {
            $recoleccion = Recoleccion::find($id);
            if ($recoleccion) {
                $recoleccion->usuario_id = $request->usuario_id;
                $recoleccion->alimentos_id = $request->alimentos_id;
                $recoleccion->update();
                return $this->getResponse201("Municipio", "updated", $recoleccion);

            } else {
                return $this->getResponse404();
            }
            //DB::commit();
        } catch (Exception $e) {
            return $this->getResponse500($e->getMessage());
            //  DB::rollBack();
        }
    }

    public function destroy($id)
    {
        $recoleccion = Recoleccion::find($id);
        if ($recoleccion) {
            $recoleccion->delete();
            return $this->getResponseDelete200($recoleccion);
        } else {
            return $this->getResponse404();
        }
    }
}