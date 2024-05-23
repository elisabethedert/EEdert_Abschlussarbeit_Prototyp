<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultipleChoiceQuestion extends Model
{
    use HasFactory;

    protected $fillable=['question','topic','level','lecture','unit'];

    public function multiple_choice_answers()
    {
        return $this->hasMany(MultipleChoiceAnswer::class);
    }
}
