<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
	protected $table = 'activities';
	protected $fillable = ['title','contents', 'activity_type', 'status'];
}
