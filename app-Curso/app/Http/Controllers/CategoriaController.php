<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    //abri o formulario de cadastro
    public function mostrarFormCat(){
        return view('cad_categoria');
    }

    public function index(){
        return view('index');
    }

public function cadastroCat(Request $request){
    //verifica se exiate algo na variavel nomecategoria.
$registrosCat = $request->validate([
    'nomecategoria'=> 'string|required'
]);

//esta linha é que grava o registro no banco.
 Categoria::create($registrosCat);

 return Redirect::route('index');

}
public function mostrarManipulaCategoria(){
    $registrosCategoria = Categoria::All();

    return view('manipula_categoria',['registrosCategoria' => $registrosCategoria]);
}
public function DeletarCategoria(Categoria $registrosCategoria)
{
    $registrosCategoria->delete();
    return Redirect::back();
}
public function BuscarCategoriaNome(Request $request)
{
    $registrosCategoria = Categoria::query();
    $registrosCategoria->when($request->categoria, function($query, $valor){
        $query->where('nomecategoria','like','%'.$valor.'%');

    });
    $registrosCategoria = $registrosCategoria->get();
    return view('manipula_categoria',['registrosCategoria' => $registrosCategoria]);    
}
public function MostrarAlterarCategoria(Categoria $registrosCategoria){
    $registrosCategoria = Categoria::All();
    return view('altera_aula',['registrosCategoria'=> $registrosCategoria]);
}
public function AlterarBancoCategoria(categoria $registroCategoria, Request $request){
    alert("Dados alterados com sucesso");
    return Redirect::route('index');
}
}
