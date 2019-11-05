<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnuncioAjax extends Model
{
    protected $fillable=['name','status','image','text','video'];
}
