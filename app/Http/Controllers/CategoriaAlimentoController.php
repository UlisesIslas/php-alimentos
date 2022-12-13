<?php

namespace App\Http\Controllers;

use App\Models\CategoriaAlimento;
use Illuminate\Http\Request;

class CategoriaAlimentoController extends Controller
{
    public function index()
    {
        $categoriasAlimentos = CategoriaAlimento::orderBy('nombre', 'asc')->get();
        return $this->getResponse200($categoriasAlimentos);
    }


    public function store(Request $request)
    {
            $categoriaAlimento = new CategoriaAlimento();
            $categoriaAlimento->nombre = $request->nombre;
            $categoriaAlimento->save();
            return $this->getResponse201("Municipio","created",$categoriaAlimento);
    }


    public function show($id)
    {
        $categoriaAlimento = CategoriaAlimento::find($id);
        if($categoriaAlimento){
            return $this->getResponse200($categoriaAlimento);
        }else{
            return $this->getResponse404();
        }
    }

  
    
    public function update(Request $request, $id)
    {
        //DB::beginTransaction();
        try{
        $categoriaAlimento = CategoriaAlimento::find($id);
        if ($categoriaAlimento) {
            $categoriaAlimento->nombre = $request->nombre;
            $categoriaAlimento->update();
            return $this->getResponse201("Municipio","updated",$categoriaAlimento);
            
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
        $categoriaAlimento = CategoriaAlimento::find($id);
        if($categoriaAlimento){
            $categoriaAlimento->delete();
            return $this->getResponseDelete200($categoriaAlimento);
        }else{
            return $this->getResponse404();
        }
    }
}
