<?php

namespace Fiorella;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = "works";
    protected $fillable = [
    	"title",
        "size",
        "technique_id",
    	"image"
    ];

    public function setTitleAttribute($title){
    	$this->attributes['title'] = ucfirst($title); // Uppercase the first letter of the title

        /**
         * If there's not a slug already, we can set it, if it's already there we don't do anything
         * so the links won't break in the future (even if this might cause a slug to not match the title)
         */
    	if(!$this->slug){
    		$this->attributes['slug'] = Str::slug($title);
    	}
    }

    public function technique()
    {
        return $this->belongsTo('Fiorella\Technique');
    }
}
