<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
