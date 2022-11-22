<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model 
{
    protected $fillable = [
        'titulo','valor', 'urlimg','updated_at','created_at'
    ];
    
}
