<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUUID
{
	public static function bootHasUUID()
	{
		static::creating(function ($model) {
            $model->id = $model->generateUUID();
        });
	}

	public function generateUUID()
	{
		return (string) Str::orderedUuid();
	}
}
