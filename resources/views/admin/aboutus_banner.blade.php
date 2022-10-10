@extends('admin.layout.header')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>About Us Page Banner</span></a>
            </li>
         </ul>
      </div>

   


      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">About Us Page Banner</h4>
           
         </div>
        
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Title</th> 
                     <th>Image</th>
                     <th>Action</th>
                  </tr>
               </thead>

              @foreach($aboutus_banner as $ab)
               <tbody class="">
                    <tr>
                   
                       
                        <td>{{$ab->page_name}}</td>

                         <td>
                          <img src="/uploads/{{$ab->image}}" width="200" height="150">
                        </td>
                       
                       
                        <td>
                          <a class="icon__1" href="{{url('admin/update_banner_image')}}/{{$ab->id}}"><i class="fas fa-edit"></i></a>
                        
                        </td>
                        
                    </tr>
               </tbody>

               @endforeach
              

            </table>
            
         </div>
      </div>

       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
      <script type="text/javascript">


        $(function() {
                 setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 3000)

             });


      

      </script> 


@endsection