<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DragDropQuestion extends Model
{
    use HasFactory;

    protected $fillable=['question','topic','level','type','lecture','unit'];

    protected $casts = [
        'blanks' => 'array',
    ];

    public function multiple_choice_answers()
    {
        return $this->hasMany(DragDropAnswer::class);
    }
}
