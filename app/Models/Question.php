<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question contains the Model for the questions
 */
class Question extends Model
{
    use HasFactory;
    protected $fillable=['question','topic','level','type','lecture','unit'];

    protected $casts = [
        'blanks' => 'array',
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
