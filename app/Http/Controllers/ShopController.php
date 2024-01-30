<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;

class ShopController extends Controller
{
    //
    public function index(Request $request,$categorySlug = null, $subCategory =null ){
        $categorySelected = '';
        $subCategorySelected = '';



        $categories=Category::orderBy('name','ASC')->with('sub_category')->where('status',1)->get();
        $brands=Brand::orderBy('name','ASC')->where('status',1)->get();


        // $products=Product::orderBy('id','DESC')->where('status',1)->get();
        $products=Product::where('status',1);

        if(!empty($categorySlug)){
            $category=Category::where('slug',$categorySlug)->first();
            $products=$products->where('category_id',$category->id);
            $categorySelected = $category-id;
        }
        
        if(!empty($subCategorySlug)){
            $subCategory=SubCategory::where('slug',$subCategorySlug)->first();
            $products=$products->where('sub_category_id',$subCategory->id);
            $subCategorySelected = $subCategory-id;
        }

        $products = $products->orderBy('id','DESC');
        $products = $products->get();


        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['products'] = $products;
        $data['categorySelected'] = $categorySelected;
        $data['subCategorySelected'] = $subCategorySelected;
        return view('front.shop',$data);

    }
}
