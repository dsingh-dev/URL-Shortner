<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    /**
     * Get all the companies users
     */
    public function users(): HasMany {
        return $this->hasMany(User::class);
    }

    /**
     * Get all the shorturls
     */
    public function shortUrls(): HasMany {
        return $this->hasMany(ShortUrl::class);
    }
}
