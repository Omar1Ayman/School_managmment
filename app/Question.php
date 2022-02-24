<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];
    public function quizze()
    {
        return $this->belongsTo(Quizze::class , 'quizze_id');
    }
}
