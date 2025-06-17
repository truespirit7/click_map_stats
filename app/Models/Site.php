<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Site extends Model
{
    protected $guarded = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->tracking_id = Str::uuid();
        });
    }
}
