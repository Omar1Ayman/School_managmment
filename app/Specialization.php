<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Specialization extends Model
{
    use HasTranslations;
    public $translatable = ['name'];

    public function spec_teachers(){
        return $this->hasMany(Teacher::class , 'spec_id');
    }
}
