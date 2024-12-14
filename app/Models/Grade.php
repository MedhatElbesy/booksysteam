<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = ['name','stage_id','term_id'];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function term() 
    {
        return $this->belongsTo(Term::class);
    }

}
