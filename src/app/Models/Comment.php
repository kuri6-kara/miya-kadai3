<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'weight_log_id', 'comment'];

    public function weightLog(): BelongsTo
    {
        return $this->belongsTo(Weight_log::class);
    }
}
