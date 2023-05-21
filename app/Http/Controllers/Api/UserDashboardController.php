<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Shop\Cart\Cart;

class UserDashboardController extends Controller
{
   
    public function __construct(Request $request)
    {
        
    }    

    public function userProfile(Request $request, $userid)
    {
        $header = $request->header('Authorization');
     
        if($header){
            $user = User::where('remember_token',$header)->where('id',$userid)->first(['id','name','email','mobile']);
            if($user){
                return response()->json([
                    "status" => "1",
                    "message" => "User detail fetched successfully.",
                    "data" => $user
                ]);
            }
            else{
                return response()->json([
                    "status" => "0",
                    "message" => "Invalid request. User id not matched"
                ]);
            }
           
        }
        else{
            return response()->json([
                "status" => "400",
                "message" => "Bad Request. Access token required",
            ]);
        }
    }


    public function productAddToCart(Request $request)
    {
        $header = $request->header('Authorization');
     
        if($header){
            $data = $request->all();

            if($data['user_id']=='' || $data['product_id']=='' || $data['quantity']=='' || $data['unit_price']=='' || $data['total_price']==''){

                return response()->json([
                    "status" => "0",
                    "message" => "Missing Parameters. User ID, Product Id, Product Quantity, Unit Price & Total Price are mendatory"
                    
                ]);
            }
            else{
                // print_r($data); die;
                
                $last_id = Cart::insertGetId($data);
                if($last_id){
                    return response()->json([
                        "status" => "1",
                        "message" => "Product add to cart successfully.",
                        
                    ]);
                }
                else{
                    return response()->json([
                        "status" => "0",
                        "message" => "Something went wrong."
                    ]);
                }
            }
           
        }
        else{
            return response()->json([
                "status" => "400",
                "message" => "Bad Request. Access token required",
            ]);
        }
    }

    
    public function userCartProducts(Request $request, $userid)
    {
        $header = $request->header('Authorization');
     
        if($header){
            
            $cartProducts = Cart::JOIN('products', 'products.id', 'carts.product_id')->where('carts.user_id',$userid)->get(['carts.*','products.name as product_name','products.slug as product_slug','products.cover']);
            // print_r('123'); die;
               
                if($cartProducts){
                    return response()->json([
                        "status" => "1",
                        "message" => "Cart products fetched successfully.",
                        "data" => $cartProducts
                        
                    ]);
                }
                else{
                    return response()->json([
                        "status" => "0",
                        "message" => "Something went wrong."
                    ]);
                }
            
        }
        else{
            return response()->json([
                "status" => "400",
                "message" => "Bad Request. Access token required",
            ]);
        }
    }
}
