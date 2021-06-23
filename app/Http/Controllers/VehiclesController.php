<?php

namespace App\Http\Controllers;


use \Illuminate\Http\Request;

use App\Models\Vehicle;

class VehiclesController extends Controller
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
  
      return view('vehicle');
      // return response()->json($data);
    }

    public function getData(){
      $data = Vehicle::all();

      return response()->json($data);
    }

    public function get($id)
    {
        $data = Vehicle::find($id);
        return response()->json($data);
    }

    public function store(Request $request){

        $query = Vehicle::updateOrCreate(['id' => $request->id],['name' => $request->name]);

        return response()->json(['data' => $query, 'messages' => true]);
    }

    public function destroy($id){
        $data = Vehicle::find($id)->delete();
        return response()->json($data);
    }

}
