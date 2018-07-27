<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;
use App\User;
use App\Rate;

class Book extends Model
{

   	use Rateable;

    protected $fillable = [ 'user_id', 'title', 'description'];


    public function scopeGetBook($query, $book_name )
	{
		return $query->where('slug',  $book_name )->first();
	}
    
	public function setTitleAttribute($value)
	{
	    $this->attributes['title'] = $value;
	    $this->attributes['slug'] = str_slug($value);

	}

	public function scopeGetBookUser($query, $user_id)
	{
		return $query->where('user_id',  $user_id )->first();
	}
    



 	public function user()
	{
	    return $this->belongsTo(User::class);
	}

}
