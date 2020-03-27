<?php
// lab2 / Ramverk/ Gruppmeddlemar: [Abdikadir Omar, Hoseop Joung, & Blend zebari]
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Validation\Rule;

class moviesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     *
     */
    public function index()  {

      $Posts = Movie::all();

      return $Posts;

    }




}
