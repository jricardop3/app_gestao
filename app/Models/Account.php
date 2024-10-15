<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'amount',
        'due_date',
        'status',
        'user_id',
    ];

    // Definindo a relação com o modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDueDateAttribute($value)
    {
        return Carbon::parse($value);
    }
    
}
