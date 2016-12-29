<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Tag;
use Session;
use Validator;

class TagController extends Controller
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
        $tags = Tag::all();
        return view('tags.index')->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
                'name' => 'required|max:255|unique:tags,name'
            ));
        $tag = new Tag;
        $tag->name = $request->input('name');
        $tag->save();

        Session::flash('success', 'New Tag Created.');
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('tags.edit')->withTag($tag);
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
        $tag = Tag::find($id);
        $id = $tag->id;
        Validator::extend('unique_to_others', function($field, $value, $parameters, $validator) {
            $matching_tag = Tag::where([ ['id', '!=', $parameters[0]], ['name', '=', $value] ])->first();
            if(isset($matching_tag->id)) {
                return false;
            } else {
                return true;
            }
        });

        $this->validate($request, array(
                'name' => "required|max:255|unique_to_others:$id"
            ));

        $tag->name = $request->input('name');
        $tag->save();

        Session::flash('success', 'Tag Name Updated.');
        return redirect()->route('tags.show', $tag->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->posts()->detach();

        $tag->delete();

        Session::flash('success', 'Tag <b>'.$tag->name.'</b> deleted.');
        return redirect()->route('tags.index', $tag->id);
    }
}
