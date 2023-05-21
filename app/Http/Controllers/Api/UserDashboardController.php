<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Shop\Cart\Cart;
use App\Shop\Wishlist\Wishlist;
use Illuminate\Support\Facades\DB;
use App\Shop\Orders\Order;

class UserDashboardController extends Controller
{


    public function __construct(Request $request)
    {
    }


    public function userProfile(Request $request, $userid)
    {
        $header = $request->header('Authorization');

        if ($header) {
            $user = User::where('remember_token', $header)->where('id', $userid)->first(['id', 'name', 'email', 'mobile']);
            if ($user) {
                return response()->json([
                    "status" => "1",
                    "message" => "User detail fetched successfully.",
                    "data" => $user
                ]);
            } else {
                return response()->json([
                    "status" => "0",
                    "message" => "Invalid request. User id not matched"
                ]);
            }
        } else {
            return response()->json([
                "status" => "400",
                "message" => "Bad Request. Access token required",
            ]);
        }
    }


    public function productAddToCart(Request $request)
    {
        $header = $request->header('Authorization');

        if ($header) {
            $data = $request->all();

            if ($data['user_id'] == '' || $data['product_id'] == '' || $data['quantity'] == '' || $data['unit_price'] == '' || $data['total_price'] == '') {

                return response()->json([
                    "status" => "0",
                    "message" => "Missing Parameters. User ID, Product Id, Product Quantity, Unit Price & Total Price are mendatory"

                ]);
            } else {

                $last_id = Cart::insertGetId($data);
                if ($last_id) {
                    return response()->json([
                        "status" => "1",
                        "message" => "Product add to cart successfully.",

                    ]);
                } else {
                    return response()->json([
                        "status" => "0",
                        "message" => "Something went wrong."
                    ]);
                }
            }
        } else {
            return response()->json([
                "status" => "400",
                "message" => "Bad Request. Access token required",
            ]);
        }
    }


    public function userCartProducts(Request $request, $userid)
    {
        $header = $request->header('Authorization');

        if ($header) {

            $cartProducts = Cart::JOIN('products', 'products.id', 'carts.product_id')->where('carts.user_id', $userid)->get(['carts.*', 'products.name as product_name', 'products.slug as product_slug', 'products.cover']);
            // print_r('123'); die;

            if ($cartProducts) {
                return response()->json([
                    "status" => "1",
                    "message" => "Cart products fetched successfully.",
                    "data" => $cartProducts

                ]);
            } else {
                return response()->json([
                    "status" => "0",
                    "message" => "Something went wrong."
                ]);
            }
        } else {
            return response()->json([
                "status" => "400",
                "message" => "Bad Request. Access token required",
            ]);
        }
    }


    public function productAddToWishlist(Request $request)
    {
    
        $header = $request->header('Authorization');

        if ($header) {
            $data = $request->all();

            if ($data['user_id'] == '' || $data['product_id'] == '') {

                return response()->json([
                    "status" => "0",
                    "message" => "Missing Parameters. User ID, Product ID are mendatory"
                ]);

            } else {

                $data['user_shop_id'] = 1;

                $checWishlist = Wishlist::where('product_id',$data['product_id'])->where('user_id',$data['user_id'])->first();

                if($checWishlist){
                    return response()->json([
                        "status" => "0",
                        "message" => "Product already in your wishlist."
                    ]);
                }
                else{

                    $last_id = Wishlist::insertGetId($data);
                    if ($last_id) {
                        return response()->json([
                            "status" => "1",
                            "message" => "Product add to wishlist successfully.",
                        ]);
                    } else {
                        return response()->json([
                            "status" => "0",
                            "message" => "Something went wrong."
                        ]);
                    }
    
                }

            }
        } else {
            return response()->json([
                "status" => "400",
                "message" => "Bad Request. Access token required",
            ]);
        }
    }


    public function userWishlistProducts(Request $request, $userid)
    {
        $header = $request->header('Authorization');

        if ($header) {

            $cartProducts = Wishlist::JOIN('products', 'products.id', 'wishlists.product_id')->where('wishlists.user_id', $userid)->get(['wishlists.*', 'products.name as product_name', 'products.slug as product_slug', 'products.cover']);

            if ($cartProducts) {
                return response()->json([
                    "status" => "1",
                    "message" => "Wishlist products fetched successfully.",
                    "data" => $cartProducts
                ]);
            } else {
                return response()->json([
                    "status" => "0",
                    "message" => "Something went wrong."
                ]);
            }

        } else {
            return response()->json([
                "status" => "400",
                "message" => "Bad Request. Access token required",
            ]);
        }
    }


    public function getUserOrdersList(Request $request, $userid){
        
        $orders = Order::where('customer_id',$userid)->orderBy('id','DESC')->get();

        return response()->json([
            "status" => 1,
            "message" => "Orders History fetched successfully.",
            "data" => $orders
        ]);

        print_r($orders);die;
        $items = DB::table('order_product')->JOIN('products','products.id','order_product.product_id')->where('order_product.order_id',$orderId)->select('products.cover','products.description','order_product.*')->get();
        
    }


}