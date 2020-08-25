<?php

namespace App\Http\Controllers\Admin;

use App\Cat;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostEditRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user', 'photo', 'cat')->paginate(5);

        return view('admin.posts.index', compact(['posts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Cat::pluck('title', 'id');

        return view('admin.posts.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $post = new Post();
        if ($file = $request->file('photo')) {
            $name = Str::random(10) . time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = new Photo();
            $photo->name = $file->getClientOriginalName();
            $photo->path = $name;
            $photo->user_id = Auth::id();
            $photo->save();
            $post->photo_id = $photo->id;
        }
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');     // the input slug must be made before validation!!!
        $post->description = $request->input('description');
        $post->cat_id = $request->input('cats');
        $post->user_id = Auth::id();
        $post->meta_description = $request->input('meta_description');
        $post->meta_keywords = $request->input('meta_keywords');
        $post->status = $request->input('status');
        $post->save();
        Session::flash('create_post', 'post created successfully');
        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('cat')->where('id', $id)->first();
        $categories = Cat::pluck('title', 'id');
        return view('admin.posts.edit', compact(['post', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostEditRequest $request, $id)
    {
        $post = Post::findorfail($id);

        if ($file = $request->file('photo')) {

            // first deleting the old photo if was exist

            if ($photo = Photo::find($post->photo_id)) {

                if (file_exists(public_path() . $post->photo->path)) {
                    unlink(public_path() . $post->photo->path);
                }
            } else {
                $photo = new photo();
            }

            $name = Str::random(10) . time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo->name = $file->getClientOriginalName();
            $photo->path = $name;
            $photo->user_id = Auth::id();
            $photo->save();

            $post->photo_id = $photo->id;

        }

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');     // the input slug must be made before validation!!!
        $post->description = $request->input('description');
        $post->cat_id = $request->input('cats');
        $post->user_id = Auth::id();
        $post->meta_description = $request->input('meta_description');
        $post->meta_keywords = $request->input('meta_keywords');
        $post->status = $request->input('status');
        $post->save();
        Session::flash('update_post', 'post updated successfully');
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        // try to delete the photo if was exist
        if ($post->photo_id) {
            $photo = Photo::findOrFail($post->photo_id);
            if (file_exists(public_path() . $post->photo->path)) {
                unlink(public_path() . $post->photo->path);
            }
            $photo->delete();
        }

        Session::flash('delete_post', 'Post deleted successfully');

        return redirect('admin/posts');
    }
}
