<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
   public function update()
   {
   	$cart = Auth()->user()->cart;
   	$cart->status = 'Pending';
   	$cart->save();

	$notification = 'Tu pedido se ha registrado correctamente. Pronto nos contactaremos via mail.';
   	return back()->with(compact('notification'));
   }
}
