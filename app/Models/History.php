<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class History extends Model
{
	protected $table = 'history';
	public $fillable = ['id_vehicle', 'id_sparepart', 'stok'];


	public function sparepart(){
		return $this->belongsTo('App\Models\Sparepart', 'id_sparepart');
	}

	public function vehicle(){
		return $this->belongsTo('App\Models\Vehicle', 'id_vehicle');
	}

	

}