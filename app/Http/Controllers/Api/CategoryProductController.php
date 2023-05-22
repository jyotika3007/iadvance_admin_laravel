<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Shop\Categories\Category;
use App\Shop\Products\Product;

class CategoryProductController extends Controller
{
   
    // Get products based on categories
    public function index($cat_id)
    {
        $ids = [];
        $categories = Category::where('id',$cat_id)->where('status',1)->get(['id']);

        // print_r($categories); die;
        
        foreach($categories as $cat){
            array_push($ids, $cat->id);
            $sub_categories = Category::where('parent_id',$cat->id)->where('status',1)->get(['id']);
            
            foreach($sub_categories as $sub_cat){
                // print_r($cat->id); die;
                array_push($ids, $sub_cat->id);
                $child_categories = Category::where('parent_id',$sub_cat->id)->where('status',1)->get(['id']);
                
                foreach($child_categories as $child_cat){
                    array_push($ids, $child_cat[0]->id);
                }
            }
        }
        // print_r($ids);

        $products = Product::JOIN('category_product','category_product.product_id','products.id')->whereIn('category_product.category_id',$ids)->get(['products.id','products.slug','products.name','products.cover','products.price','products.sale_price','products.discount','products.stock_quantity']);

        return response()->json([
            'status' => 1,
            'message' => 'Products fetched successfully',
            'data' => $products
        ]);
    }

}
