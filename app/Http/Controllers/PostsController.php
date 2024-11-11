<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
  //
  public function newPost(Request $request)
  {

    $request->validate([
      'title' => 'required|min:3|max:255',
      'body' => 'required',
      'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $post = new Post();
    $post->title = $request->title;
    $post->body = $request->body;
    $imagefile = $request->file('image');
    $getImageName = $imagefile->hashName();
    $imagefile->storeAs("public", $getImageName);
    $post->url = $getImageName;
    $post->save();
    return back()->with("message", "Your Post was uploaded successfully!.");
  }

  public function viewPost($id)
  {
    $post = Post::find($id);
    return view('view-post', compact('post'));
  }

  public function editPost($id)
  {
    $post = Post::find($id);
    return view('edit-post', compact('post'));
  }

  public function updatePost(Request $request, $id)
  {
    $request->validate([
      'title' => 'required|min:3|max:255',
      'body' => 'required',
      'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $post = Post::find($id);
    $post->title = $request->title;
    $post->body = $request->body;
    if ($request->file('image')) {
      Storage::delete('public/' . $post->url);
      $imagefile = $request->file('image');
      $getImageName = $imagefile->hashName();
      $imagefile->storeAs("public", $getImageName);
      $post->url = $getImageName;
    }
    $post->save();
    return to_route('viewPost', ['id' => $post->id])->with("message", "Your Post was updated successfully!.");
  }

  public function removePost($id)
  {
    $post = Post::find($id);
    Storage::delete('public/' . $post->url);
    $post->delete();
    return to_route('posts')->with("message", "Your Post was removed successfully!.");
  }
}
