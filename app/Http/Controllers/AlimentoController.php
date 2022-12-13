<?php

namespace App\Http\Controllers;

use App\Models\Alimento;
use Illuminate\Http\Request;

class AlimentoController extends Controller
{
    public function index()
    {
        //$alimentos = Alimento::orderBy('id', 'asc')->get();
        $alimentos = Alimento::with('categoriaAlimentos')->orderBy('id', 'asc')->get();
        return $this->getResponse200($alimentos);
    }


    public function store(Request $request)
    {
            $alimento = new Alimento();
            $alimento->nombre = $request->nombre;
            $alimento->categoria_alimentos_id = $request->categoria_alimentos_id;
            $alimento->save();
            return $this->getResponse201("Municipio","created",$alimento);
    }


    public function show($id)
    {
        $alimento = Alimento::find($id);
        if($alimento){
            return $this->getResponse200($alimento);
        }else{
            return $this->getResponse404();
        }
    }

  
    
    public function update(Request $request, $id)
    {
        //DB::beginTransaction();
        try{
        $alimento = Alimento::find($id);
        if ($alimento) {
            $alimento->nombre = $request->nombre;
            $alimento->categoria_alimentos_id = $request->categoria_alimentos_id;
            $alimento->update();
            return $this->getResponse201("Municipio","updated",$alimento);
            
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
        $alimento = Alimento::find($id);
        if($alimento){
            $alimento->delete();
            return $this->getResponseDelete200($alimento);
        }else{
            return $this->getResponse404();
        }
    }
}
