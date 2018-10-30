<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUUID;

class Widget extends Model
{
	use HasUUID;

	public $incrementing = false;

	protected $fillable = [
		'name',
		'description',
		'code',
		'status',
	];
}
