<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ShortUrl extends Model
{
    /** @use HasFactory<\Database\Factories\ShortUrlFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id', 'user_id', 'company_id'];

    protected static function booted() {
        static::creating(function ($url) {
            $url->company_id = auth()->user()->company_id;
            $url->user_id = auth()->id();
        });
    }


    public function user(): HasOne {
        return $this->hasOne(User::class);
    }

    public function company(): BelongsTo {
        return $this->belongsTo(Company::class);
    }
}
