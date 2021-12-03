<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $fillable= ['filename','imageable_id','imageable_type'];

    public function imageable()
    {
        return $this->morphTo();
    }
}
