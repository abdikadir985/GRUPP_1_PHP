<?php
// lab2 / Ramverk/ Gruppmeddlemar: [Abdikadir Omar, Hoseop Joung, & Blend zebari]

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Validation\Rule;

class movieController extends Controller {
  
    public function __index()  {

      $Posts = movie::all();

      return $Posts['']-title;
      
    }
}
