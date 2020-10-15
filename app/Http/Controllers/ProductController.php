<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Processor;
use App\Screensize;
ini_set('memory_limit','512M');
class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
  
       $products = Product::all();
       $brands = Brand::all();
       $processors = Processor::all();
       $screensizes = Screensize::all();

      
      return view('addproduct',compact('products','brands','processors','screensizes'));
    }
    public function store(Request $request){
       
        $products=new Product;
        $products->name = $request->input('name');
        // print_r($request);
        // echo $request->file('file');die;
        if($request->file('file')== ''){
            $products->image = "noimage.jpg";
        }else{
            
            // $request->validate([
            //     'file' => 'required|mimes:pdf,jpg,png|max:2048',
            // ]);
            $image=$request->file('file');
           // $fileName = time().'.'.$request->file->extension();  
            $fileName      =   time().'.'.$image->getClientOriginalExtension();
           $target_path    =   public_path('/uploads/');
            
           $image>move($target_path, $fileName);
            
            $products->image = $fileName;
        }
       
        $products->brand = $request->input('brand');
        $products->price = $request->input('price');
        $products->processor_type = $request->input('processor_type');
        $products->screen_size = $request->input('screen_size');
        if($request->input('touch_screen')== 'on'){
            $products->touch_screen = 1;
        }else{
            $products->touch_screen = 0;
        }
        if($request->input('availability')== 'on'){
            $products->availability = 1;
        }else{
            $products->availability = 0;
        }
        //$products->availability = $request->input('availability');
        $products->save();
    }

    public function update(Request $request){
     
        $products = Product::find($request->input('up_id'));
        
        $products->name = $request->input('up_name');
        
        if($request->input('up_file') == ''){
            $products->image = "noimage.jpg";
        }else{
            
          //  $products->image = $request->input('up_file');
            
            $request->validate([
                'file' => 'required|mimes:pdf,jpg,jpeg,png|max:3000',
            ]);
      
            $fileName = time().'.'.$request->file->extension();  
            
            $request->file->move(public_path('uploads'), $fileName);
            $products->image = $fileName;
        }
       
        $products->brand = $request->input('up_brand');
        $products->price = $request->input('up_price');
        $products->processor_type = $request->input('up_processor_type');
        $products->screen_size = $request->input('up_screen_size');
        $products->touch_screen =  $request->input('up_screen_size');
        $products->availability = $request->input('up_availability');
        $products->save();
    }
    public function delete(Request $request){
        $product = Product::find($request->id);
        $product->delete();
        return response()->json(['success' => true],200);
    }
}
