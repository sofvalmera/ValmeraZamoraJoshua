<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\admin\CategoryController;


class SubCategoryController extends Controller
{

    public function index(Request $request){
        $subCategories= SubCategory::select('sub_categories.*','categories.name as categoryName')
        ->latest('sub_categories.id')
        ->leftJoin('categories','categories.id','sub_categories.category_id');

        if(!empty($request->get('keyword'))){

            $subCategories= $subCategories->where('sub_categories.name','like','%'.$request->get('keyword').'%');
         }

       $subCategories= $subCategories->paginate(10);
       return view('admin.sub_category.list',compact('subCategories'));

    }
    //
    public function create(){
        $categories = Category::orderBy('name','ASC')->get();
        $data['categories'] = $categories;
        return view('admin.sub_category.create',$data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
            'category' => 'required',
            'status' => 'required',
            
        ]);
        if($validator->passes()){
            $subCategory=new SubCategory();
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;

            $subCategory->showHome = $request->showHome;


            $subCategory->category_id = $request->category;
            $subCategory->save();


            $request->session()->flash('success','Sub Category Added Successfully');

            return response()->json([
                'status' => true,
                'message' => 'Sub Category Added Successfully'
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
      
    }


    public function edit($categoryId, Request $request){

        $subCategory=SubCategory::find($categoryId);
        
        if(empty($subCategory)){
            $request->session()->flash('error','Record  Not Found');
            return redirect()->route('sub-categories.index');
        }


        $categories = Category::orderBy('name','ASC')->get();
        $data['categories'] = $categories;
        $data['subCategory'] = $subCategory;
        return view('admin.sub_category.edit',$data);

    }

    public function update($id, Request $request){
        $subCategory=SubCategory::find($id);

        if(empty($subCategory)){
            $request->session()->flash('error','Record not Found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'subCategory not found'
            ]);
        }
        $validator =Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:sub_categories,slug,'.$subCategory->id.',id',
            'category' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->category_id = $request->category;
            $subCategory->showHome = $request->showHome;

           
            $subCategory->save();

           
            $request->session()->flash('success','Sub Category Updated Successfully');
            return response()->json([
                'status' => true,
                'message' => 'Sub Category Updated Successfully'
            ]);
     
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
        
    }
    public function destroy($id, Request $request){
        $subCategory=SubCategory::find($id);

        if(empty($subCategory)){
            $request->session()->flash('error','Category not found');
            return response()->json([
                'status' => false,
                'notFound' => 'true'
            ]);
    
            // return redirect()->route('categories.index');
        }
        $subCategory->delete();
        $request->session()->flash('success','Sub Category deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'Sub Category Deleted Successfully'
        ]);

    }

}
