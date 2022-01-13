<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuitarModels;

class AdminController extends Controller
{
    //  ADD PRODUCTS IN DATABASE ==========================================================================
    public function AddProducts(Request $request)
    {
        // ADD GUITAR 
        if ($request['nav_option'] == 'op1'){
            $data = $request->validate([
                'guitar_type' => 'required',
                'guitar_name' => 'required',
                'guitar_brand' => 'required',
                'guitar_color' => 'required',
                'guitar_price' => 'required',
            ]);

            $db = new GuitarModels;
            $db->type = $request['guitar_type'];
            $db->name = $request['guitar_name'];
            $db->brand = $request['guitar_brand'];
            $db->color = $request['guitar_color'];
            $db->price = $request['guitar_price'];
            $db->save();
        }  
        // // ADD BIKE
        // else if ($request['nav_option'] == 'op2'){ 
        //     $data = $request->validate([
        //         'bike_type' => 'required',
        //         'size' => 'required',
        //         'speed' => 'required',
        //         'name' => 'required',
        //         'brand' => 'required',
        //         'price' => 'required',
        //     ]);
        // }
        // // ADD SNOWBOARD
        // else if ($request['nav_option'] == 'op3'){ 
        //     $data = $request->validate([
        //         'gender' => 'required',
        //         'type' => 'required',
        //         'size' => 'required',
        //         'level' => 'required',
        //         'name' => 'required',
        //         'brand' => 'required',
        //         'price' => 'required',
        //     ]);
        // }

        return view('admin');
    }
}