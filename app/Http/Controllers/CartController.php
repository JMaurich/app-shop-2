<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;
use App\Mail\Neworder;


class CartController extends Controller
{
   public function update()
   {
   	$client = auth()->user();
   	$cart = $client->cart;
   	$cart->status = 'Pending';
   	$cart->order_date = Carbon::now();
   	$cart->save();

   	$admins = User::where('admin', true)->get();
   	Mail::to($admins)->send(new NewOrder($client, $cart));

	$notification = 'Tu pedido se ha registrado correctamente. Pronto nos contactaremos via mail.';
   	return back()->with(compact('notification'));
   }
}
