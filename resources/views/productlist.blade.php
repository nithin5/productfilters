<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <!-- <script  src="https://code.jquery.com/ui/1.9.1/jquery-ui.min.js"   integrity="sha256-UezNdLBLZaG/YoRcr48I68gr8pb5gyTBM+di5P8p6t8="   crossorigin="anonymous"></script>
   -->
    <title>Product List</title>
  </head>
  <body>

    
  <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12" style="background-color:grey">
          <h1 style="text-align:center">Product List</h1>
         
       </div>
   </div>
    <div class="row">
      <!-- <div class="jumbotron"> -->
      <div class="col-sm-3 col-md-3" style="background-color:#D3D3D3">
          <div class="form-group">
                      <label for="brand">Brand:</label>
                      @foreach ($brands as $brand)
                      <div class="list-group-item checkbox">
                          <label><input type="checkbox" class="common_selector brand" value="{{$brand->id}}" > 
                          {{ $brand->name }}  </label>
                      </div>
                      @endforeach 
                
         </div>
    <hr/>
         <div class="form-group">
                    <label for="brand">ScreenSize:</label>
                    @foreach ($screensizes as $screensize)
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector screensize" value="{{$screensize->id}}" > 
                        {{ $screensize->name }} </label>
                    </div>
                    @endforeach 
                
         </div>
    <hr/>
         <div class="form-group">
                    <label for="brand">Processor Type:</label>
                    @foreach ($processors as $processor)
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector ptype" value="{{ $processor->id }}" > 
                        {{ $processor->name }} </label>
                    </div>
                    @endforeach 
          
        </div><hr/>
        <div class="form-group">
                  <label for="brand">Price:</label>
                    <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000" />
                    <p id="price_show">15000 - 65000</p>
                    <div id="price_range"></div>
     </div>  <hr/>
     <div class="form-group">
                    <label for="touch_screen">TouchScreen:</label>
                   
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector touch" value="1" > 
                       Yes </label><br/>
                       <label><input type="checkbox" class="common_selector touch" value="0" > 
                       No </label>
                    </div>
                    
          
        </div><hr/>
        <div class="form-group">
                    <label for="availability">Availability:</label>
                   
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector avail" value="1" > 
                       Yes </label><br/>
                       <label><input type="checkbox" class="common_selector avail" value="0" > 
                       No </label>
                    </div>
                    
          
        </div><hr/>
    </div>  
    
    <div class="col-sm-9 col-md-9">  
    <br/>
      
    <div class="row filter_data" style="margin-top:10px">

    </div>
    
    </div>
  

  </div>
  
  
  </div> 
<!-- </div> -->
<!-- <style>
#loading
{
 text-align:center; 
 background: url('loading.gif') no-repeat center; 
 height: 150px;
}
</style> -->
   <script type="text/javascript">
   $(document).ready(function(){
    filter_data();

          function filter_data()
          {
            
              $('.filter_data').html('<div id="loading" style="" ></div>');
              var action = 'fetch_data';
              var minimum_price = $('#hidden_minimum_price').val();
              var maximum_price = $('#hidden_maximum_price').val();
              var brand = get_filter('brand');
              var screensize = get_filter('screensize');
              var ptype = get_filter('ptype');
              var touch = get_filter('touch');
              var avail = get_filter('avail');
              var search = $('#searchtag').val();
              
              $.ajax({
                  url:"/productlistupdate",
                  method:"POST",
                  data:{"_token": "{{ csrf_token() }}",search:search,action:action,minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, screensize:screensize,touch:touch,avail:avail, ptype:ptype},
                  success:function(data){
                      $('#first_row').hide();
                      $('.filter_data').html(data);
                  }
              });
          }

          function get_filter(class_name)
          {
              var filter = [];
              $('.'+class_name+':checked').each(function(){
                  filter.push($(this).val());
              });
              return filter;
          }

          $('.common_selector').click(function(){
              filter_data();
          });
          $('#price_range').slider({
              range:true,
              min:15000,
              max:65000,
              values:[15000, 65000],
              step:500,
              stop:function(event, ui)
              {
                  $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                  $('#hidden_minimum_price').val(ui.values[0]);
                  $('#hidden_maximum_price').val(ui.values[1]);
                  filter_data();
              }
          });
          

        
   });
  
   </script>
  </body>
</html>