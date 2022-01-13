<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuitarModels;
use App\Models\CommentModel;
use App\Models\SessionModel;

class ProductsController extends Controller
{

    // Info products page ============================================================
    public function ProductInfo(Request $request)
    {
        if ($request['category'] == 'Guitars')
        {
            $db = new GuitarModels;
            $category = $request['category'];
            $name = $request['product'];
            $type = $db->where('name', $name)->value('type');
            $brand = $db->where('name', $name)->value('brand');
            $color = $db->where('name', $name)->value('color');
            $price = $db->where('name', $name)->value('price');
            $description = $db->where('name', $name)->value('description');
        }

        $review = new CommentModel;
        $review = $review->where('product', $request['product'])->get();

        return view('product')->with(['category' => $category, 
                                      'type' => $type, 
                                      'name' => $name,
                                      'brand' => $brand,
                                      'color' => $color,
                                      'price' => $price,
                                      'description' => $description,
                                      'posts' => $review,
                                    ]);
    }




    // Post comment function =========================================================
    public function PostComment(Request $request)
    {
        $db = new CommentModel;

        $db->product = $request['product_name'];
        $db->user = session('user');
        $db->message = $request['message'];
        $db->save();

        return back();
    }



    // Add items to favourite =======================================================================
    public function AddToFav(Request $request)
    {
        $db = new SessionModel;
        $unique = true;

        // Add first item
        if (session()->get('fav_index') == 0)
        {
            session()->put('fav_item', [$request['product_name']]);
            session()->put('fav_price', [$request['product_price']]);
            session()->increment('fav_index');
        }
        else
        { 
            // Add next item if it is unique
            foreach(session()->get('fav_item') as $item)
                if ($item == $request['product_name'])
                    $unique = false;

            if ($unique == true){
                session()->push('fav_item', $request['product_name']);
                session()->push('fav_price', $request['product_price']);
                session()->increment('fav_index');
            }
        }


        //  if item is unique then add to database
        if ($unique == true){
            $db->token = session('_token');
            $db->fav_products_name = $request['product_name'];
            $db->fav_products_price = $request['product_price'];
            $db->save();
        }


        return back();
    }




    // Add items to cart =========================================================================
    public function AddToCart(Request $request)
    {
        $db = new SessionModel;
        $unique = true;

        // Add first item
        if (session()->get('cart_index') == 0)
        {
            session()->put('cart_item', [$request['product_name']]);
            session()->put('cart_price', [$request['product_price']]);
            session()->increment('cart_index');
        }
        else
        { 
            // Add next item if it is unique
            foreach(session()->get('cart_item') as $item)
                if ($item == $request['product_name'])
                    $unique = false;

            if ($unique == true){
                session()->push('cart_item', $request['product_name']);
                session()->push('cart_price', $request['product_price']);
                session()->increment('cart_index');
            }
        }


        //  if item is unique then add to database
        if ($unique == true){
            $db->token = session('_token');
            $db->cart_products_name = $request['product_name'];
            $db->cart_products_price = $request['product_price'];
            $db->save();
        }


        return back();
    }




    // Delete item from favourite =======================================================================
    public function DelFromFav(Request $request)
    {
        $db = new SessionModel;

        $db->where('fav_products_name', $request['product_name'])->delete();

        foreach(session('fav_item') as $index => $item)
            if ($request['product_name'] == $item){
                session()->pull('fav_item.'.(string)$index);     
                session()->pull('fav_price.'.(string)$index);
            }
        session()->decrement('fav_index');

        return back();
    }





    // Delete item from cart ============================================================================
    public function DelFromCart(Request $request)
    {
        $db = new SessionModel;

        $db->where('cart_products_name', $request['product_name'])->delete();

        foreach(session('cart_item') as $index => $item)
            if ($request['product_name'] == $item){
                session()->pull('cart_item.'.(string)$index);     
                session()->pull('cart_price.'.(string)$index);
            }
        session()->decrement('cart_index');

        return back();
    }
}
