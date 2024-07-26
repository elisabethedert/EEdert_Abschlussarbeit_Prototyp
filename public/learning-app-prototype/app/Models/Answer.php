<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Answer contains the Model for the answers
 */
class Answer extends Model
{
    use HasFactory;
    protected $fillable=['answer','question_id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
