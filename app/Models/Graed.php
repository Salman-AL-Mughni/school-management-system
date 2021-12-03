<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class Graed extends Model
{

    use HasTranslations;//هاد الكود ليحفظ الاسم ب الداتا بيز باللغة الانجليزية والعربية
    public $translatable = ['Name','Notes'];//هاد الكود ليحفظ الاسم ب الداتا بيز باللغة الانجليزية والعربية

    protected $fillable=['Name','Notes'];
    protected $table = 'Graeds';
    public $timestamps = true;

      // علاقة المراحل الدراسية لجلب الاقسام المتعلقة بكل مرحلة

      public function Sections()
      {
          return $this->hasMany('App\Models\Section', 'Grade_id');
      }



}
