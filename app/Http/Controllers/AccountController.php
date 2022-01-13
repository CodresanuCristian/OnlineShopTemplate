<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SessionModel;

class AccountController extends Controller
{
    public function Signup(Request $request)
    {
        $user = new User;

        session()->regenerate();
        $token = session('_token');

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->remember_token = $token;
        $user->save();

        return view('login');
    }



    public function Login(Request $request)
    {
        $user = new User;
        $db_session = new SessionModel;
        $data = $request->input();
        $password = $user->where('email', $data['email'])->value('password');
        $token = $user->where('email', $data['email'])->value('remember_token'); 

        // If passwords match
        if ($data['password'] == $password)
        {
            // Remove Guest session
            if (session('user') == 'Guest'){
                $db_session->where('token',session('_token'))->delete();
                session()->flush();
            }

            // Load user session
            $session = $db_session->where('token', $token)->get();
            $cart_products_name = $session->pluck('cart_products_name')->whereNotNull()->values();
            $cart_products_price = $session->pluck('cart_products_price')->whereNotNull()->values();
            $fav_products_name = $session->pluck('fav_products_name')->whereNotNull()->values();
            $fav_products_price = $session->pluck('fav_products_price')->whereNotNull()->values();
        

            session()->put('user', $data['email']);
            session()->put('_token', $token);
            session()->put('cart_index', $cart_products_name->count());
            session()->put('fav_index', $fav_products_name->count());

            foreach ($fav_products_name as $index => $fav_name){
                if ($index == 0){
                    session()->put('fav_item', [$fav_name]);
                    session()->put('fav_price', [$fav_products_price[$index]]);
                }
                else{
                    session()->push('fav_item', $fav_name);
                    session()->push('fav_price', $fav_products_price[$index]);
                }
            }

            foreach ($cart_products_name as $index => $cart_name){
                if ($index == 0){
                    session()->put('cart_item', [$cart_name]);
                    session()->put('cart_price', [$cart_products_price[$index]]);
                }
                else{
                    session()->push('cart_item', $cart_name);
                    session()->push('cart_price', $cart_products_price[$index]);
                }
            }

            return redirect('/');
        }
        else
            return view('login');
    }



    public function Logout()
    {
        session()->flush();
        if (! session()->has('user'))       session()->put('user','Guest');
        if (! session()->has('fav_item'))   session()->put('fav_index', 0);
        if (! session()->has('cart_item'))  session()->put('cart_index', 0);

        return redirect('/login');
    }
}
