<?php
namespace App;
use App\Models\Temporada;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model{

    protected $table = 'series';

    public $timestamps = false;


    protected $fillable = ['nome'];

    public function Temporadas(){
        return $this->hasMany( related: Temporada::class);
    }


}