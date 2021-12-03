<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PaymentStudent extends Model
{
    protected $guarded=[];
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
}
