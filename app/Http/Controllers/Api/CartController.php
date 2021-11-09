<?php

namespace App\Http\Controllers\Api;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart($id){
        $product = Product::findOrfail($id);
        $sameProductCheck = DB::table('carts')->where('product_id',$id)->first();
        if($sameProductCheck){
            if($sameProductCheck->product_quantity < $product->p_quantity){
                DB::table('carts')->where('product_id',$id)->increment('product_quantity');
                $cart= DB::table('carts')->where('product_id',$id)->first();
                DB::table('carts')->where('product_id',$id)->update(['sub_total'=>$cart->product_quantity * $cart->product_price]);
            }else{
                return response()->json(['error'=>'Can not increment. out of stack']);
            }

        }else{
            $data = [];
            $data['product_id']=$id;
            $data['product_name']=$product->p_name;
            $data['product_quantity']=1;
            $data['product_price']=$product->selling_price;
            $product_discount=$product->selling_price * $product->p_discount/100;
            $data['product_discount']= $product_discount;
            $data['unit_discount']=$product->p_discount;

            
            $data['sub_total']=$product->selling_price- $product_discount;
            DB::table('carts')->insert($data);
            return response()->json(['success'=>'Cart added']);
        }

    }
    public function getCarts(){
        $carts = DB::table('carts')->get();
        return response()->json($carts);
    }
    public function cartRemove($id){
        $cart = DB::table('carts')->delete($id);
        return response()->json(['success'=>'Cart deleted']);
    }
    public function cartIncrement($id){
         $newCart = DB::table('carts')->find($id);
         $product_id = $newCart->product_id;
         $product = Product::find($product_id);
         $product_quantity = $product->p_quantity;
         if($newCart->product_quantity < $product_quantity){
             DB::table('carts')->where('id',$id)->increment('product_quantity');
             $cart = DB::table('carts')->where('id',$id)->first();
             $discount=$cart->product_quantity* $product->p_discount/100 * $cart->product_price;
             DB::table('carts')->where('id',$id)->update(['sub_total'=>($cart->product_quantity * $cart->product_price)-$discount,'product_discount'=>$discount]);
             return response()->json($id);
         }else{
             return response()->json(['error'=>'Can not increment. out of stack']);
         }
    }
    public function cartDecrement($id){
        DB::table('carts')->where('id',$id)->decrement('product_quantity');
        $cart = DB::table('carts')->where('id',$id)->first();
        $product_id = $cart->product_id;
        $product = Product::find($product_id);
        $discount=$cart->product_quantity* $product->p_discount/100 * $cart->product_price;
        DB::table('carts')->where('id',$id)->update(['sub_total'=>($cart->product_quantity * $cart->product_price)-$discount,'product_discount'=>$discount]);
        return response()->json($id);
    }

    public function cartAdjustSellingPrice(Request $request){
		$cart_id=$request->cart_id;
		$newSellingPrice=$request->adjustment;
       	$cart = DB::table('carts')->find($cart_id);
        $product_id = $cart->product_id;
        $product = Product::find($product_id);
        if ($product->buying_price > $newSellingPrice ){
            return response()->json(['error'=>'Selling price is less than the buying price!']);

        }
        else{
		$newsub_total=$cart->product_quantity * $newSellingPrice;
        DB::table('carts')->where('id',$cart_id)->update(['product_price'=>$newSellingPrice, 'sub_total'=>$newsub_total]);
        return response()->json($cart_id);
        }

    }
    public function cartAdjustSellingQty(Request $request){
		$cart_id=$request->cart_id;
		$buyingQty=$request->buyingQty;
		$cart = DB::table('carts')->find($cart_id);
		$newsub_total=$buyingQty * $cart->product_price;
        DB::table('carts')->where('id',$cart_id)->update(['product_price'=>$cart->product_price, 'sub_total'=>$newsub_total,'product_quantity'=>$buyingQty]);
        return response()->json($cart_id);


    }

    public function cartAdjustSellingDiscount(Request $request){
		$cart_id=$request->cart_id;
		$adjustedUnitDiscount=$request->unit_discount;
		$cart = DB::table('carts')->find($cart_id);

        $product_id = $cart->product_id;
        $product = Product::find($product_id);
        $discount=$cart->product_quantity* $adjustedUnitDiscount/100 * $cart->product_price;

        $newUnitPrice=$cart->product_price- $discount;
        if ($product->buying_price > $newUnitPrice ){
            return response()->json(['error'=>'Selling price is less than the buying price!']);

        }
        else{
            DB::table('carts')->where('id',$cart_id)->update(['sub_total'=>($cart->product_quantity * $cart->product_price)-$discount,'product_discount'=>$discount,'unit_discount'=>$adjustedUnitDiscount]);
            return response()->json($cart_id);
        }

        


    }
    public function cartQuantity(){
        $cartQuantity = DB::table('carts')->sum('product_quantity');
        return response()->json($cartQuantity);
    }

    public function cartSubtotal(){
        $subtotal = DB::table('carts')->sum('sub_total');
        return response()->json($subtotal);
    }
    public function cartsProductPrice(){
        $subTotal = DB::table('carts')->sum('sub_total');
        $totalPrice=round($subTotal);
        return response()->json($totalPrice);
    }
}
