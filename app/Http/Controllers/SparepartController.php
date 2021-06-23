<?php

namespace App\Http\Controllers;


use \Illuminate\Http\Request;

use App\Models\Sparepart;

class SparepartController extends Controller
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

    public function index(){
      $data = ['sparepart' => Sparepart::all()];

      return view('sparepart', $data);
      // return response()->json($data);
      
    }

    public function getData(){
        $array = [];
        $data = Sparepart::with(['history'])->get();

        foreach ($data as $key => $value) {
          $stokmin = 0;
          foreach ($value->history as $key) {
             $stokmin += $key->total_stok;                               
          }

          $array[] = [
            'id' => $value->id,
            'name' => $value->name,
            'stok' =>  $value->stok - $stokmin,
          ];
        }

        return response()->json($array);
    }

    public function get($id)
    {
        
        $data = Sparepart::with('history')->find($id);

        $stokmin = 0;

        foreach ($data->history as $key) {
           $stokmin += $key->total_stok; 
        }

        $array = [
          'id' => $data->id,
          'name' => $data->name,
          'stok' => $data->stok - $stokmin,
        ];

        return response()->json($array);
    }

    public function store(Request $request){

        $query = Sparepart::updateOrCreate(
                  ['id' => $request->id],
                  [
                    'name' => $request->name, 
                    'stok' => $request->stok
                  ]
                );

        return response()->json(['data' => $query, 'messages' => true]);
    }

    public function destroy($id){
        $data = Sparepart::find($id)->delete();
        return response()->json($data);
    }

}
