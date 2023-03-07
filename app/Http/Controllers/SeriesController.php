<?php

namespace App\Http\Controllers;
use App\Http\Requests\SeriesFormRequest;
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


    public function store(SeriesFormRequest $request)
    {
        $serie = Serie::create(['nome' => $request->nome]);
        $qtdTemporadas = $request->qtd_temporadas;
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
    
            for ($j = 1; $j <= $request->ep_por_temporada; $j++) {
                $temporada->episodios()->create(['numero' => $j]);
            }
        }
        $request->session()
            ->flash(
                'mensagem',
                "Série {$serie->id} e duas temporadas e episódios criados com sucesso {$serie->nome}"
            );
    
        return redirect()->route('listar_series');
    }

    public function destroy (Request $request)

    {



        Serie::destroy($request->id);
        $request->session()
        ->flash(
            'mensagem',
            "Série removida com sucesso"
            );

            return redirect()->route( route: 'listar_series');

    }



}