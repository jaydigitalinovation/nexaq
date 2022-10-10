@extends('admin.layout.header')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Our Mission-Vision</span></a>
            </li>
         </ul>
      </div>

   
      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Our Mission-Vision</h4>
          <!--   <button class="btn1"><a href="{{url('admin/add_service')}}" style="color:white;">ADD</a></button> -->
         </div>
        
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                    
                     <th>Title</th>
                     <th>Description</th>
                    
                     
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($mission_vision as $mv)
               <tbody class="">
                    <tr>
                   
                       
                        <td>{{$mv->title}}</td>
                        <td>{{$mv->description}}</td>
                       
                        <td>
                          <a class="icon__1" href="{{url('admin/update_mission_vision')}}/{{$mv->id}}"><i class="fas fa-edit"></i></a>
                      
                        </td>
                        
                    </tr>
               </tbody>

               @endforeach
              

            </table>
            
         </div>
      </div>
      <style type="text/css">
         
         td {
      text-align: left !important;
}
      </style>

       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript">


        $(function() {
                 setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 3000)

             });


      </script> 


@endsection