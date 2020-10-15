<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\Processor;
use App\Screensize;
use DB;
class ProductlistController extends Controller
{
    //
    public function __construct()
    {
       // $this->middleware('auth');
    }

    public function index(){
      
       $products = Product::all();
     
       $brands = Brand::all();
       $processors = Processor::all();
       $screensizes = Screensize::all();

         return view('productlist',compact('products','brands','processors','screensizes'));
    }


    public function update(){
      $query = " SELECT p.name as pname,p.image as image,p.price as price,b.name as brandname,pr.name as ptype,s.name as screensize FROM products p join brands b on b.id=p.brand join processors pr on pr.id=p.processor_type join screensizes s on s.id=p.screen_size WHERE 1=1 ";
      if(isset($_POST["action"]))
      {
        
      
       if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
       {
        $query .= "
         AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
        ";
       }
       if(isset($_POST["brand"]))
       {
        $brand_filter = implode("','", $_POST["brand"]);
        $query .= " AND brand IN('".$brand_filter."')";
       }
       if(isset($_POST["ptype"]))
       {
        $ptypefilter = implode("','", $_POST["ptype"]);
        $query .= " AND processor_type IN('".$ptypefilter."')";
       }
       if(isset($_POST["screensize"]))
       {
        $screen_filter = implode("','", $_POST["screensize"]);
        $query .= " AND screen_size IN('".$screen_filter."')";
       }
       if(isset($_POST["touch"]))
       {
        $touch_filter = implode("','", $_POST["touch"]);
        $query .= " AND touch_screen IN('".$touch_filter."')";
       }
       if(isset($_POST["avail"]))
       {
        $avail_filter = implode("','", $_POST["avail"]);
        $query .= " AND availability IN('".$avail_filter."')";
       }
       if(isset($_POST["search"]))
       {
        
        $query .= " AND p.name LIKE('%".$_POST["search"]."%')";
       }
       
       $q1= DB::select($query);
      
       $total_row=COUNT($q1);
       
       $output = '';
       if($total_row > 0)
       {
        foreach($q1 as $key=>$row)
        {
         $output .= '
                 <div class="col-sm-12 col-md-12" style="margin-bottom:10px"> 
                   <div class="col-sm-3 col-md-3" style="float:left">
                      <img src="uploads/'.$row->image.'" alt="" class="img-responsive"  style="width:250px;height:250px">
                   </div><div class="col-sm-9 col-md-9" style="float:right">
                   <p align="center" ><a href="#">'.$row->pname.'</a></p>
                   <p align="center"><strong><a href="#"> Brand Name  : '.$row->brandname.'</a></strong></p>
                   <p align="center"><strong><a href="#">Processor Type  : '.$row->ptype.'</a></strong></p>
                   <p align="center"><strong><a href="#">Screen Size  : '.$row->screensize.'</a></strong></p>
                   <p align="center"><strong><a href="#">Price  : '.$row->price.'</a></strong></p>
                   </table>
                   </div>
                   
             </div>
         ';
        }
       }
       else
       {
        $output = '<h3>No Data Found</h3>';
       }
       echo $output;
      }
   
      }  
}
