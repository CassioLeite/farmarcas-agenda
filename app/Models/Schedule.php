<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_id',
        'description',
        'starting_at',
        'conclusion_at',
        'due_at',
        'status',
        'title',
    ];

    protected $casts = [
        'status' => Status::class
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function type(): HasOne
    {
        return $this->hasOne(Type::class);
    }
}
