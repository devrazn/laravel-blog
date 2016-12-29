<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public function category() {
		return $this->belongsTo('App\Category');

	}

	public function tags() {
		/*
		* Many to many relationship in laravel:
		* Laravel by default assumes the relationship table name to be post_tag,
		* foreign key for post table to be post_id & foreign key for tag table
		* to be tag_id. So these parameters need not be passed if these default 
		* names are used. So the method can be:
		* return $this->belongsToMany('App\Tag');
		*/
		return $this->belongsToMany('App\Tag', 'post_tag', 'post_id', 'tag_id');		
	}

	public function comments() {
		return $this->hasMany('App\Comment');
	}
}
