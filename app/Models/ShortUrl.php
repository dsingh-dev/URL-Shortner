<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Attributes\Scope;
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

    /**
     * Scope for urls visible only
     */
    #[Scope]
    protected function visibleTo(Builder $query, User $user): Builder {
        if ($user->hasRole('admin')) {
            return $query->where('company_id', $user->company_id);
        }

        return $query->where('user_id', $user->id);
    }

    public function user(): HasOne {
        return $this->hasOne(User::class);
    }

    public function company(): BelongsTo {
        return $this->belongsTo(Company::class);
    }
}
