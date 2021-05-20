<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'answer', 'trx'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
