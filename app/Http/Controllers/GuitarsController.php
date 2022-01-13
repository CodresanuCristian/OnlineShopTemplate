<?php

namespace App\Http\Controllers;

use App\Models\GuitarModels;
use Illuminate\Http\Request;

class GuitarsController extends Controller
{

    // GET DYNAMICLLY FILTERS =========================================================================
    public function GetFilters(Request $request)
    {
        if ($request['category'] == 'guitars'){
            $db = new GuitarModels;
            $type = $db->pluck('type')->unique()->values()->all();
            $brands = $db->pluck('brand')->unique()->values()->all();
            $colors = $db->pluck('color')->unique()->values()->all();
            $prices = $db->pluck('price')->values()->all();
    
            return response()->json([
                'type' => $type,
                'brands' => $brands, 
                'colors' => $colors,
                'min_price' => $db->min('price'),
                'max_price' => $db->max('price'),
            ]);
        }
        else if ($request['category'] == 'cycling'){
        }
        else if ($request['category'] == 'snowboarding'){
        }
    }



    // DEFAULT GUITAR PAGE VIEW =========================================================================
    public function DefaultView()
    {
        $db = new GuitarModels;
        $guitars = $db->get();
        $results = $guitars->count();

        return view('guitars')->with(['guitars' => $guitars])->with(['results' => $results]); 
    }




    // APPLY FILTERS IN GUITAR PAGE ====================================================================
    public function CustomView(Request $request)
    {
        $db = new GuitarModels;
        $guitars = collect($db->get());

        $guitars_filtered = $guitars->filter(function ($item) use ($request){
            foreach($request['type'] as $type){
                if ($item['type'] == $type){
                    return $item['type'];
                }
            }
        })->filter(function ($item) use ($request){
            foreach($request['brands'] as $brand){
                if ($item['brand'] == $brand){
                    return $item['brand'];
                }
            }
        })->filter(function ($item) use ($request){
            foreach($request['colors'] as $color){
                if ($item['color'] == $color){
                    return $item['color'];
                }
            }
        })->filter(function ($item) use ($request){
            return (($request['price_min'] <= $item['price']) && ($item['price'] <= $request['price_max']));
        });

        return view('guitars')->with(['guitars' => $guitars_filtered, 'results' => $guitars_filtered->count()]); 
    }
}
