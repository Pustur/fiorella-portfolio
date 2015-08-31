<?php

namespace Fiorella;

use Illuminate\Database\Eloquent\Model;

class Technique extends Model
{
    protected $table = "techniques";
    protected $fillable = [
    	"name"
    ];

    public function works()
    {
        return $this->hasMany('Fiorella\Work');
    }
}
