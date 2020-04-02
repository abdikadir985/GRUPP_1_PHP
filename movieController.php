<?php
// lab2 / Ramverk/ Gruppmeddlemar: [Abdikadir Omar, Hoseop Joung, & Blend zebari]
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Validation\Rule;

class moviesController extends Controller
{
  public function test() {
    return ['JSON'=>true];
  }

  public function index()  {

    $posts = Movie::orderBy('title','asc')->get();

    return $posts;

  }
  
  public function read($id) {
    $Posts = Movie::findOrFail($id);
    
    return $Posts;

  }

  public function create(Request $request) {
    $this->validate($request,[

      'title'=>'required|alpha_num',
      'year'=>'integer',
      'genre'=>'string',
      'rating'=>'integer|min:1|max:10'
    ]);
    Movie::create($request->all());

    return['success'=>true];
  }

  public function update(Request $request,$id){

    $data=  $this->validate($request, [
      'title' => 'string|filled',
      'year' => 'integer',
      'genre' => 'string',
      'rating' => 'integer|min:1|max:10'
    ]);

    $Posts = Movie::findOrFail($id);
    $Posts-> fill($data);
    $Posts ->save();

    return ['success'=> true];

  }

  public function delete($id){

    $Posts= Movie::findorFail($id);
    $Posts-> delete();

    return ['success' => true];

  }

}
