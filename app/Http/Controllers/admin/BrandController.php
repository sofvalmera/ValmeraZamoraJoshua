<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use App\Models\Category;



class BrandController extends Controller
{
    //
    public function index(Request $request){
        $brands= Brand::latest('id');
     
        if($request->get('keyword')){

            $brands= $brands->where('name','like','%'.$request->get('keyword').'%');
         }

         $brands= $brands->paginate(10);
       return view('admin.brands.list',compact('brands'));
    }
    public function create(){
        return view('admin.brands.create');

    }
    public function store(Request $request){
        $validator =Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands',
        ]);
        if($validator->passes()){
            $brand=new Brand();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->save();


            $request->session()->flash('success','Brand Added Successfully');

            return response()->json([
                'status' => true,
                'message' => 'Brand Added Successfully'
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    public function edit($id, Request $request){
        // echo $categoryId;

        $brand=Brand::find($id);

        if(empty($brand)){
            $request->session()->flash('error','Brand not found');
            return redirect()->route('brands.index');
        
        

        }
        $data['brand'] = $brand;
        return view('admin.brands.edit',$data);

    }
    public function update($id, Request $request){
        
        $brand=Brand::find($id);

        if(empty($brand)){
            $request->session()->flash('error','Brand not Found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Brand not found'
            ]);
        }
        $validator =Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$brand->id.',id',
        ]);
        if($validator->passes()){
            $brand=new Brand();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->save();


            $request->session()->flash('success','Brand Updated Successfully');

            return response()->json([
                'status' => true,
                'message' => 'Brand Added Successfully'
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    public function destroy($id, Request $request){
        $brand=Brand::find($id);

        if(empty($brand)){
            $request->session()->flash('error','Brand not found');
            return response()->json([
                'status' => false,
                'notFound' => 'true'
            ]);
    
            // return redirect()->route('categories.index');
        }
        $brand->delete();
        $request->session()->flash('success','Brand deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'Brand Deleted Successfully'
        ]);

    }
    
}
