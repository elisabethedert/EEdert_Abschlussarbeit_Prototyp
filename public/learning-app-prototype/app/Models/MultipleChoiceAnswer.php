<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleChoiceAnswer extends Model
{
    use HasFactory;

    protected $fillable=['answer','multiple_choice_question_id'];

    public function multiple_choice_question()
    {
        return $this->belongsTo(MultipleChoiceQuestion::class);
    }
}
