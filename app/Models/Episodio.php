<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Episodio extends Model
{
    public $timestamps = false;
    protected $fillable = ['numero'];

    public function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }

    public function episodios(){
        return $this -> hasMany(related:Serie::Class);
    }

    public function getEpisodiosAssistidos(): Collection 
    {
    
        return $this->episodios->filter(function (Episodio $episodio)
    
        {
            return $episodio->assistido;
        });
    }
}
