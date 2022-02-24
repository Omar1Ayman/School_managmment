<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Nationality extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable = ['name'];

    public function parents(){
        return $this->hasMany(My_Parent::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }

}
