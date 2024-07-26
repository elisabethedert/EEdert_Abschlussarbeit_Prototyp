<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionResults contains the Model for the question results
 */
class QuestionResults extends Model
{
    use HasFactory;

    protected $fillable=['user_id','question_id', 'answer_id','question_type', 'lecture','unit', 'dropped_buttons', 'session' ];

    protected $casts = [
        'dropped_buttons' => 'array',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
