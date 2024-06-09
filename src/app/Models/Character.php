<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'enduser_id',
        'bio',
        'totalLevel',
        'questPoints',
        'collectionLogSlots',
        ];
        

    public function enduser(): BelongsTo{
        return $this->belongsTo(Enduser::class);
    }
}
