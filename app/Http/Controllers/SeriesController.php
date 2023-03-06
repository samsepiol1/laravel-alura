<?php

namespace App\Http\Controllers;
use App\Serie;
use Symfony\Component\HttpFoundation\Request;


class SeriesController extends Controller{
    public function index() {

        $series = serie::query()->orderBy(column: 'nome') -> get();
        return view('series.index', compact('series'));
    
    }

    public function create(){
        return view('series.create');
    }

    public function store(Request $request){
    $serie = Serie::create($request->all());

    return redirect(to: '/series');
}
}