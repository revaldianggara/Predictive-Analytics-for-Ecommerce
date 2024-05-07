<?php

namespace App\Traits;

use App\Observers\UserStampObserver;
use Carbon\Carbon;
use Exception;

trait UserStamp
{
    public static function boot()
    {
        parent::boot();
        static::observe(UserStampObserver::class);
    }

    public function carbon_date($column)
    {
        try {
            return Carbon::parse($this->$column, 'Asia/Jakarta');
        } catch (Exception $e) {
            return Carbon::parse($this->getAttributes()[$column], 'Asia/Jakarta');
        }
    }
}
