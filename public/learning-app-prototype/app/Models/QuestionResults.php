<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionResults extends Model
{
    use HasFactory;

    protected $fillable=['user_id','question_id', 'answer_id','question_type', 'lecture','unit' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
