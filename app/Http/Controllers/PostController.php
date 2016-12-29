<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Session;
use Validator;
use App\Category;
use App\Tag;
use Purifier;
use Image;
use Storage;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10);
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $cats = array();
        $cats[''] = "Select a Category";
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        return view('posts.create')->withCategories($cats)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request); //Die & Dump
        //validate the data
        $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => 'required|min:5|max:255|alpha_dash|unique:posts,slug',
                'body' => 'required',
                'category_id' => 'required|integer|min:0',
                'featured_image' => 'sometimes|image'
            ));

        //store to database
        $post = new Post;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = Purifier::clean($request->body);
        $post->category_id = $request->category_id;

        //Save the image
        if($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/images/'.$filename);
            Image::make($image)->resize(640,360)->save($location);
            $post->image = $filename;
        }

        $post->save();

        if(isset($request->tags)) {
            $post->tags()->sync($request->tags, false);
        }

        Session::flash('success', 'The blog post was successfully saved!');

        return redirect()->route('posts.show', $post->id);

        //Redirect to another page
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category) {
            $cats[$category->id] = $category->name;
        }

        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
            $tags2[$tag->id] = $tag->name;
        }

        return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $id = $post->id;
        Validator::extend('unique_to_others', function($field, $value, $parameters, $validator) {
            $matching_slug = Post::where([ ['id', '!=', $parameters[0]], ['slug', '=', $value] ])->first();
            if(isset($matching_slug->id)){
                return false;
            } else {
                return true;
            }
        });

        $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => "required|min:5|max:255|alpha_dash|unique:posts,slug,$id",
                'body' => 'required',
                'category_id' => 'required|integer|min:0',
                'featured_image' => 'image'
            ));

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->body = Purifier::clean($request->input('body'));
        $post->category_id = $request->input('category_id');

        if($request->hasFile('featured_image')) {
            $oldFilename = $post->image;

            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('uploads/images/'.$filename);
            Image::make($image)->resize(640,360)->save($location);

            $post->image = $filename;
        }

        $post->save();

        if(isset($oldFilename)) {
            Storage::delete('images/'.$oldFilename);
        }

        if(isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }

        Session::flash('success', 'This post was successfully updated.');

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        Storage::delete('images/'.$post->image);
        $post->delete();
        Session::flash('success', 'The post was successfully deleted');

        return redirect()->route('posts.index');
    }
}
