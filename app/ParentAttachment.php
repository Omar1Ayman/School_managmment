<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParentAttachment extends Model
{
    protected $guarded = [];

    public function parents(){
        return $this->belongsTo(My_Parent::class , 'parent_id');
    }

}
