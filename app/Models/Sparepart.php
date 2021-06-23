<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sparepart extends Model
{

	public $fillable = ['name', 'stok'];

	public function history(){
		return $this->hasMany('App\Models\History', 'id_sparepart')
					->select('id_sparepart', DB::raw('SUM(stok) as total_stok'))
					->groupBy('id_sparepart');
	}
}