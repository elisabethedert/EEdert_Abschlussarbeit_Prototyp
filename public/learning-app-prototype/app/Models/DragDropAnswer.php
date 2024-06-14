<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DragDropAnswer extends Model
{
    use HasFactory;

    protected $fillable=['answer','drag_drop_question_id'];

    public function multiple_choice_question()
    {
        return $this->belongsTo(DragDropQuestion::class);
    }
}
