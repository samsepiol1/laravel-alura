<?php

namespace App\Http\Controllers;
use App\Serie;
use Symfony\Component\HttpFoundation\Request;


class SeriesController extends Controller{
    public function index(Request $request) {

        $series = serie::query()->orderBy(column: 'nome')
         -> get();
         $mensagem = $request->session()->get(key: 'mensagem');
        return view('series.index', compact('series','mensagem'));
    
    }

    public function create(){
        return view('series.create');
    }
    public function store(Request $request){

    $serie = Serie::create($request->all());
    $request->session()
    ->flash(
        'mensagem',
        "Série {$serie->id} criada com sucesso {$serie->nome}"
        );


    return redirect(to: '/series');
}


}