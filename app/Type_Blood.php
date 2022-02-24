<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_Blood extends Model
{
    protected $fillabel = ['name'];

    public function parents(){
        return $this->hasMany(My_Parent::class);
    }

    public function students(){
        return $this->hasMany(Student::class);
    }

}
