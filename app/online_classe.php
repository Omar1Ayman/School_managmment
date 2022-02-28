<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class online_classe extends Model
{
    public $fillable= ['integration','Grade_id','Classroom_id','section_id','user_id','meeting_id','topic','start_at','duration','password','start_url','join_url'];

    public function grade()
    {
        return $this->belongsTo(Grade::class ,'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo(RawRoom::class, 'Classroom_id');
    }


    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
