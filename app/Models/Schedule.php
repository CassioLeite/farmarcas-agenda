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
        'due_at',
        'conclusion_at',
        'status',
        'title',
    ];

    protected $casts = [
        'status' => Status::class,
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
        'starting_at' => 'datetime:Y-m-d H:i:s',
        'due_at' => 'datetime:Y-m-d H:i:s',
        'conclusion_at' => 'datetime:Y-m-d H:i:s',
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
