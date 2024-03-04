<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PostController extends Controller
{
    
    use MediaUploadingTrait;
    public function index()
    {
        $posts = Post::all();
    
        // dd($posts->photo->getUrl('thumb'));
        return view("posts.index", compact("posts"));
    }
    public function create()
    {
        return view("posts.create");
    }

    public function store(Request $request)
    {
        $post = Post::create($request->all());
        // $post->addMediaFromRequest("photo")
        //      ->usingName("spatie Media")
        //      ->toMediaCollection("photo");
             if ($request->input('photo', false)) {
                $post->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }

        return redirect()->route("admin.posts.index")->with("success","");
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view("posts.show", compact("post"));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
