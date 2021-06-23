<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{

	public $fillable = ['name'];


	public function history(){
		return $this->hasMany('App\Models\History', 'id_vehicle');
	}
	
}