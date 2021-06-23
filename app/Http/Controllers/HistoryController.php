<?php

namespace App\Http\Controllers;


use \Illuminate\Http\Request;

use App\Models\History;
use App\Models\Vehicle;
use App\Models\Sparepart;

class HistoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index($id = 3){
      $data = [
        'vehicle' => Vehicle::find($id),
        'history' => History::where('id_vehicle', $id)->get(),
        'sparepart' => Sparepart::all(),
      ];

      return view('detail', $data);
    }

    public function getData($id){
      $array = [];
      $data = History::with(['sparepart:id,name'])->where('id_vehicle', $id)->get();

      foreach ($data as $key => $value) {
         $array[] = [
            'id' => $value->id,
            'name' => $value->sparepart['name'],
            'tgl'  => date('Y-m-d',strtotime($value->created_at)),
            'stok' => $value->stok,
         ];
      }
      return response()->json($array);
    }

    public function get($id)
    {
        $data = History::find($id);
        return response()->json($data);
    }

    public function store(Request $request){

        $query = History::updateOrCreate(['id' => $request->id],
                  [
                    'id_vehicle' => $request->id_vehicle,
                    'id_sparepart' => $request->id_sparepart,
                    'stok'    => $request->stok,
                  ]);

        return response()->json(['data' => $query, 'messages' => true]);
    }

    public function destroy($id){
        $data = History::find($id)->delete();
        return response()->json($data);
    }

}
