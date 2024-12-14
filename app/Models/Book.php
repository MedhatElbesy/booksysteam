<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Book extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    protected $fillable = [
        'name', 'type', 'user_id', 'term_id', 'stage_id', 'grade_id'
    ];

    public function scopeFilter($query, $stageId = null, $gradeId = null, $termId = null,$type = null)
{
    if ($termId) {
        $query->where('term_id', $termId);
    }

    if ($stageId) {
        $query->where('stage_id', $stageId);
    }

    if ($gradeId) {
        $query->where('grade_id', $gradeId);
    }
    
    if ($type) {
        $query->where('type', $type);
    }

    return $query;
}


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
