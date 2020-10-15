<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Product List</title>
  </head>
  <body>

    
    <div class="container">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Admin Panel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    <div class="jumbotron">
    <h1>Product List</h1>
  <!-- Button to Open the Modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#productaddmodal">
    Add Products
  </button>
  <table class="table table-hover" style="margin-top:2em">
    <thead>
      <tr>
      <th>Id</th>
        <th>Name</th>
        <th>Image</th>
        <th>Price</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
      <tr>
        
        <td id="{{$product->id}}">{{$product->id}}</td>
        <td>{{$product->name}}</td>
        <td>{{$product->image}}</td>
        <td>{{$product->price}}</td>
        
        <td style="display:none">{{$product->brand}}</td>
        <td style="display:none">{{$product->processor_type}}</td>
        <td style="display:none">{{$product->screen_size}}</td>
        <td style="display:none">{{$product->touch_screen}}</td>
        <td style="display:none">{{$product->availability}}</td>
        <td>
        <button type="submit" class="btn btn-success editbtn">Edit</button>
        
        </td>
        <td><button type="submit" class="btn btn-danger deletebutton" data-id="{{$product->id}}">Delete</button></td>
      </tr>
      @endforeach 
    </tbody>
  </table>

  <!--Add Product Modal -->
  <!-- The Modal -->
  <div class="modal" id="productaddmodal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Products</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form id="addproduct" method="post" enctype="multipart/form-data">
        <div class="modal-body">
        {{ csrf_field() }}
                <div class="form-group">
               
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name">
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" placeholder="Enter Price" name="price" id="price">
                </div>
                <div class="form-group">
                <input type="file" class="form-control-file border" name="file" id="file">
                </div>
                <div class="form-group">
                    <label for="processor_type">Processor Type:</label>
                    <select class="form-control" id="processor_type" name="processor_type">
                    @foreach ($processors as $processor)
                        <option value="{{$processor->id}}"> {{ $processor->name }} </option>
                    @endforeach 
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand">Brand:</label>
                    <select class="form-control" id="brand" name="brand">
                    @foreach ($brands as $brand)
                    <option value="{{$brand->id}}"> {{ $brand->name }} </option>
                    @endforeach 
                    </select>
                </div>
                <div class="form-group">
                    <label for="screen_size">Screen Size:</label>
                    <select class="form-control" id="screen_size" name="screen_size">
                    @foreach ($screensizes as $screensize)
                    <option value="{{$screensize->id}}"> {{ $screensize->name }} </option> 
                    @endforeach 
                    </select>
                </div>
                <div class="form-group">
                <div class="form-check-inline">
                    <label class="form-check-label">Touch screen
                        <input type="radio" class="form-check-input" name="touch_screen" id="touch_screen" checked>Yes
                    </label>
                    </div>
                    <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="touch_screen" id="touch_screen">No
                    </label>
                </div>
                </div>
                <div class="form-group">
                <div class="form-check-inline">
                    <label class="form-check-label">Availability
                        <input type="radio" class="form-check-input" name="availability" id="availability" checked>Yes
                    </label>
                    </div>
                    <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="availability" id="aAvailability">No
                    </label>
                </div>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            
        </div>

        </form>
      </div>
    </div>
  </div>
  <!--add modal --->
  <!--edit Product Modal -->
  <!-- The Modal -->
  <div class="modal" id="producteditmodal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Products</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form id="editproduct" method="post" enctype="multipart/form-data">
        <div class="modal-body">
        {{ csrf_field() }}
                <div class="form-group">
                <input type="hidden" class="form-control"  name="up_id" id="up_id">
          
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" placeholder="Enter Name" name="up_name" id="up_name">
                </div>
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="text" class="form-control" placeholder="Enter Price" name="up_price" id="up_price">
                </div>
                <div class="form-group">
                <input type="file" class="form-control-file border" name="up_file" id="up_file">
                </div>
                <div class="form-group">
                    <label for="processor_type">Processor Type:</label>
                    <select class="form-control" id="up_processor_type" name="up_processor_type">
                    @foreach ($processors as $processor)
                    <option value="{{$processor->id}}"  > {{ $processor->name }} 
                    </option>
                    @endforeach 
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="brand">Brand:</label>
                    <select class="form-control" id="up_brand" name="up_brand">
                    @foreach ($brands as $brand)
                    <option value="{{$brand->id}}"> {{ $brand->name }} </option>
                    @endforeach 
                    </select>
                </div>
                <div class="form-group">
                    <label for="screen_size">Screen Size:</label>
                    <select class="form-control" id="up_screen_size" name="up_screen_size">
                    @foreach ($screensizes as $screensize)
                    <option value="{{$screensize->id}}"> {{ $screensize->name }} </option> 
                    @endforeach 
                    </select>
                </div>
                <div class="form-group">
                <div class="form-check-inline">
                    <label class="form-check-label">Touch screen
                        <input type="radio" class="form-check-input" value="1" name="up_touch_screen" id="up_touch_screen" >Yes
                    </label>
                    </div>
                    <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="0" name="up_touch_screen" id="up_touch_screen">No
                    </label>
                </div>
                </div>
                <div class="form-group">
                <div class="form-check-inline">
                    <label class="form-check-label">Availability
                        <input type="radio" class="form-check-input" value="1" name="up_availability" id="up_availability" >Yes
                    </label>
                    </div>
                    <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="0" name="up_availability" id="up_availability">No
                    </label>
                </div>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
        <button type="submit" id="update" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            
        </div>

        </form>
      </div>
    </div>
  </div>
  <!--edit modal --->
  
  </div>
</div>
   <script type="text/javascript">
   $(document).ready(function(){
     $('#addproduct').on('submit',function(e){
        e.preventDefault();
        $.ajax({
            type:"POST",
            url:"/productadd",
            data:$('#addproduct').serialize(),
            success:function(response){
              alert(response);
                $('#productaddmodal').modal('hide');
                alert('Data Saved');
                location.reload(1);
            },
            error:function(error){
                alert('Data Not Saved');
            }
        })
     });
     $('.editbtn').on('click',function(e){ 
        $('#producteditmodal').modal('show');
        $tr=$(this).closest('tr');
        var data=$tr.children("td").map(function(){
            return $(this).text();
        }).get();
  
       $('#up_id').val(data[0]);
       $('#up_name').val(data[1]);
       $('#up_price').val(data[3]);
       $('#up_brand').val(data[4]);

      $("#up_brand option").removeAttr("selected");
      $("#up_brand option:selected").val(data[4]).attr('selected','selected');
      $("#up_processor_type option").removeAttr("selected");
      $("#up_processor_type option:selected").val(data[5]).attr('selected','selected');
      $("#up_screen_size option").removeAttr("selected");
      $("#up_screen_size option:selected").val(data[6]).attr('selected','selected');
      
       $('input[id=up_touch_screen][value=1]').prop("checked",false);
       $('input[id=up_touch_screen][value=0]').prop("checked",false);
       if(data[7]==1){
        $('input[id=up_touch_screen][value=1]').prop("checked",true);
       
       }else{
           $('input[id=up_touch_screen][value=0]').prop("checked",true);
       }
       $('input[id=up_availability][value=1]').prop("checked",false);
       $('input[id=up_availability][value=0]').prop("checked",false);
       if(data[8]==1){
          $('input[name=up_availability][value=1]').prop('checked', true);
       }else{
          $('input[name=up_availability][value=0]').prop('checked', true);
       }
    
     });   
     $('#editproduct').on('submit',function(e){ 
        e.preventDefault();
        
          $.ajax({
              type:"POST",
              url:"/productedit",
             // dataType:"json",
              data:$('#editproduct').serialize(),
              success:function(response){
                  $('#producteditmodal').modal('hide');
                  alert('Data Updated');
                  location.reload(1);
              },
              error:function(error){
                  alert('Data Not Saved');
              }
          })
     }); 
     $('.deletebutton').on('click',function(e){
        e.preventDefault();
        if (confirm("Are you sure to delete this product ?")) {
          var btn=this;
          $tr=$(this).closest('tr');
          var data=$tr.children("td").map(function(){
            return $(this).text();
          }).get();
          var id=data[0];
          $.ajax({
              type:"POST",
              dataType:"json",
              url:"/productdelete",
              data:{"_token": "{{ csrf_token() }}","id":id},
              success:function(response){
                  alert('Data Deleted');
                  $(btn).closest('tr').fadeOut("fast");
                  
              },
              error:function(error){
                  alert('Data Not Saved');
              }
        })
      }
      return false;
        
    });
   });
   </script>
  </body>
</html>