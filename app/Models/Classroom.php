<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classroom extends Model
{
    use HasTranslations;//هاد الكود ليحفظ الاسم ب الداتا بيز باللغة الانجليزية والعربية
    public $translatable = ['Name_class'];//هاد الكود ليحفظ الاسم ب الداتا بيز باللغة الانجليزية والعربية

    protected $table = 'Classrooms';
    public $timestamps = true;
    protected $fillable=['Name_class','Grade_id'];



    public function Grades()// علاقة بين الصفوف المراحل الدراسية لجلب اسم المرحلة في جدول الصفوف
    {
        return $this->belongsTo('App\Models\Graed', 'Grade_id');
    }

}
