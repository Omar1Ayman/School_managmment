<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fees_Invoice extends Model
{
    protected $guarded = [];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo(RawRoom::class, 'Classroom_id');
    }


    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function fees()
    {
        return $this->belongsTo(Fees::class, 'fee_id');
    }
}
