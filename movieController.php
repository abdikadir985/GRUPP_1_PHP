<?php
// lab2 / Ramverk/ Gruppmeddlemar: [Abdikadir Omar, Hoseop Joung, & Blend zebari]
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Validation\Rule;

class moviesController extends Controller
{

  public function index()  {

    $Posts = Movie::all();

    return $Posts;

  }
  public function getByregnr ($regnr){

    $Posts = bil::where('regnr','=',$regnr)->firstorFail();

    return $Posts;
  }

  public function create(Request $request) {

    $data=  $this->validate($request, [
      'title' => 'string|required',
      'year' => 'integer',
      'genre' => 'string',
      'rating' => 'integer|min:1|max:10',
    ]);

    $data = $request->all();

    $Posts = new Movie();

    $Posts->fill($data);

    $Posts->save();

    return ['success' => true,'id' => $Posts->id,];
  }

  public function read($id) {


    $Posts = Movie::findOrFail($id);

    return $Posts;

  }

  public function update(Request $request,$id){

    $data=  $this->validate($request, [
      'title' => 'string|filled',
      'year' => 'integer',
      'genre' => 'string',
      'rating' => 'integer|min:1|max:10',
    ]);

    $Posts = Movie::findOrFail($id);
    $Posts-> fill($data);
    $Posts ->save();

    return ['success'=> true,];

  }

  public function delete($id){

    $Posts= Movie::findorFail($id);
    $Posts-> delete();

    return ['success' => true,];

  }

}
