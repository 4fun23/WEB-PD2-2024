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


    public function enduser(): BelongsTo
    {
        return $this->belongsTo(Enduser::class);
    }

    public function gameMode(): belongsTo
    {
        return $this->belongsTo(Character::class);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => intval($this->id),
            'username' => $this->username,
            'bio' => $this->bio,
            'enduser' => $this->enduser->name,
            'gameMode' => ($this->gameMode ? $this->gameMode->name : ''),
            'totalLevel' => number_format($this->totalLevel),
            'questPoints' => number_format($this->questPoints),
            'collectionLogSlots' => number_format($this->collectionLogSlots),
            'image' => asset('images/' . $this->image),
        ];
    }

}
