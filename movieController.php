<?php
// lab2 / Ramverk/ Gruppmeddlemar: [Abdikadir Omar, Hoseop Joung, & Blend zebari]
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Illuminate\Validation\Rule;

class moviesController extends Controller
{
  public function test() {
    return ['works'=>true];
  }

  public function index()  {

    $posts = Movie::orderBy('title','asc')->get();

    return $posts;

  }

  public function read($id) {
    $post = Movie::findOrFail($id);

    return $post;
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

  public function update(Request $request, $id) {


    $data = $this->validate($request, [

      'title'=>'filled|string',
      'year'=>'filled|integer',
      'genre'=>'filled|string',
      'rating'=>'filled|integer|min:1|max:10'
    ]);
    $post = Movie::findOrFail($id);
    $post->fill($data);
    $post->save();

    return['success' => true];

  }

  public function delete($id) {
    $post = Movie::findOrFail($id);
    $post->delete();

    return ['success'=>true];

  }

}
