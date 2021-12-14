<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\DiscountCode;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Boolean;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::with('shopping_cart')->first(); //auth()->user()->with('shopping_cart');

        return [
            'products' => ProductResource::collection($user->shopping_cart),
            'meta' => $this->total_price($user)
        ];
    }

    // 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'id' => 'required|exists:products',
            'quantity' => "required|numeric|min:1",
        ]);

        $user = User::with('shopping_cart')->first(); //auth()->user()->with('shopping_cart');
        $product = Product::findOrFail($request->id);

        $is_new_product = $user->shopping_cart->where('id', $request->id)->isEmpty();
        $count_product = $user->shopping_cart->count();
        if ($is_new_product && $count_product > 10) {
            return response()->json([
                'message' => 'El limite del carrito es de 10 productos'
            ], 422);
        }

        if ($product->stock < $request->quantity) {
            return response()->json([
                'message' => 'No hay stock disponible'
            ], 422);
        }

        /*El método updateOrInsert intentará localizar un registro de base de datos coincidente utilizando los 
        pares de valores y columnas del primer argumento. Si el registro existe, se actualizará con los valores 
        del segundo argumento. Si no se puede encontrar el registro, se insertará un nuevo registro con los 
        atributos combinados de ambos argumentos:*/
        DB::table('shopping_cart')->updateOrInsert([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ], [
            'quantity' => $request->quantity,
            'total_price_quantity' => $request->quantity * $product->price
        ]);

        return [
            'products' => ProductResource::collection($user->shopping_cart()->get()),
            'meta' => $this->total_price($user)
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $user = User::first(); //auth()->user()->with('shopping_cart');
        $user->shopping_cart()->detach($id);

        return [
            'products' => ProductResource::collection($user->shopping_cart),
            'meta' => $this->total_price($user)
        ];
    }

    /**
     * .
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function total_price($user)
    {
        $sub_total = $user->shopping_cart->sum('pivot.total_price_quantity');
        $shipping = 11;
        $tax_percent = 12;
        $tax_amount = $sub_total * ($tax_percent / 100);
        $total = $sub_total + $tax_amount + $shipping;

        $discount = $user->used_discount->where('quantity', '>', 1)->first();

        //El codigo de descuento aplicado, deberia estar almacenado en session ya que es un dato temporal 
        //pero al ser una api sin estado se uso una tabla "used_code_discounts" para almacenarlo ,
        //luego de hacer todo el proceso de compra, se elimina ese registro

        if ($discount) {
            $discount_apply['percent'] = $discount->percent;
            $discount_apply['amount'] = $sub_total * ($discount->percent / 100);
            $total = $sub_total - $discount_apply['amount'];
        } else {
            $discount_apply = null;
        }

        return [
            'tax_percent' => $tax_percent,
            'shipping' => $shipping,
            'sub_total' => round($sub_total, 2),
            'tax_amount' => round($tax_amount, 2),
            'total' => round($total, 2),
            'discount_apply' => $discount_apply
        ];
    }

    public function apply_cupon_discount(Request $request)
    {

        $request->validate([
            'code' => 'required|exists:discounts,code',
        ]);
        $user = User::with('shopping_cart')->first();
        $discount = DiscountCode::where('code', $request->code)->first();
        $user->used_discount()->sync($discount->id);

        return $this->total_price($user);
    }

    public function remove_cupon_discount(Request $request)
    {
        $user = User::with('shopping_cart')->first();
        $user->used_discount()->detach();
        return $this->total_price($user);
    }
}

//terminar shopping cart add 
