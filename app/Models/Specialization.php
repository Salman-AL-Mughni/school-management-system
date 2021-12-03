<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Specialization extends Model
{
    //
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable =['Name'];
}
