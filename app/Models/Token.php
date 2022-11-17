<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Token extends Model
{
    use HasFactory;

    const TABLE_NAME = 'tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'location',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'token_tag');
    }
}
