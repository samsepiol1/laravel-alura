<?php

namespace App\Http\Controllers;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Episodio;
use App\Models\Temporada;
use App\Serie;
use App\Services\CriadorDeSerie;
use Symfony\Component\HttpFoundation\Request;



/**
 * Summary of SeriesController
 */
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


   
    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie(
            $request->nome, 
            $request->qtd_temporadas, 
            $request->ep_por_temporada
        );
    }

    public function destroy(Request $request)
{

    $serie = Serie::find($request->id);
    $nomeSerie = $serie->nome;
    $serie->temporadas->each(function (Temporada $temporada) {
        $temporada->episodios()->each(function(Episodio $episodio) {
            $episodio->delete();
        });
        $temporada->delete();

    });
    $serie->delete();

    Serie::destroy($request->id);
    $request->session()
        ->flash(
            'mensagem',
            "Série $nomeSerie removida com sucesso"
        );
    return redirect()->route('listar_series');
}

public function editaNome($id, Request $request)
{
    $novoNome = $request->nome;
    $serie = Serie::find($id);
    $serie->nome = $novoNome;
    $serie->save();
}



}