<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;
use App\User;
use App\Rate;
use willvincent\Rateable\Rating;

class Book extends Model
{

   	use Rateable;
 
    const RATED = "true";
   	const NOT_RATED = "false";

    protected $fillable = [ 'user_id', 'title', 'description'];

    protected $appends = ['rated']; // or type



    public function scopeGetBook($query, $book_name )
	{
		return $query->where('slug',  $book_name );
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

	public function getRatedAttribute()
	{
		$this->constraints = [
            'user_id' => auth()->id(),
            'book_id' => $this->getKey()

        ];

        if(Rate::where($this->constraints)->exists()){

        	return Rate::where(['type' => $this->ratedByMe()])->first();
        }

	
	}



    public function rates()
    {   
        return $this->hasMany(Rate::class, 'type', 'user_id', 'rateable_id');
    }

    public function ratedByMe()
    {
    	foreach($this->rates as $rate){
    		if($rate->user_id === auth()->id() ){
    			return self::NOT_RATED;
    		}
    	}

    	return self::RATED;
    }

 	public function user()
	{
	    return $this->belongsTo(User::class);
	}

}
