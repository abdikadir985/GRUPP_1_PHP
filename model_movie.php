<?php
// lab 2 gruppmeddlemar [Abdikadir Omar, Hoseop Joung & Blend Zebari]
namespace App;

use Illuminate\Database\Eloquent\Model;

class movie extends Model {

  protected $tabel = 'movies';

  protected $fillable = ['title','year','genre', 'rating'];

}

 ?>
