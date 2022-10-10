@extends('admin.layout.header')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href="{{url('/admin/servicelist')}}"><span>Service</span></a>
            </li>
         </ul>
      </div>






      @foreach($main_services as $ss)


      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">{{$ss->name}} Page Banner</h4>
           
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

              @foreach($banner_image as $ab)

              @if($ab->page_name==$ss->name)
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
               @endif

               @endforeach
              

            </table>
            
         </div>
      </div>



      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0"> Service Description</h4>
         
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                
               </div>
            </div>
         </div>

         @if($sub_service_description !='')
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped text">

                @foreach($sub_service_description as $sd)
           
                  <tr>
                    
                     <th>Title</th>

                 </tr>

                 <tr>

                    <th class="text">{{$sd->title}}</th>

                 </tr>

                 <tr>
                    
                    <th>Description</th>
                 </tr>

                 <tr>

                    <th class="text">{{$sd->description}}</th>              
                  </tr>

                  <tr>

                     <th><button class="clo btn0"><a href="{{url('admin/update_sub_service_description_data')}}/{{$sd->id}}">update</a></button></th>  
                    

                  </tr>

                 @endforeach
                    
              
            </table>
            
         </div>
         @else
         <button class="clo btn0 mt-3"><a href="{{url('admin/add_sub_service_description')}}/{{$ss->id}}">Add</a></button>
         @endif
      </div>


      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0"> {{$ss->name}}  List</h4>
            <button class="btn1"><a href="{{url('admin/add_sub_service')}}/{{$ss->id}}" style="color:white;">ADD</a></button>
         </div>
        
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Image</th>
                     <th>Title</th>
                     <th>Description</th>
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($sub_service as $key=>$s)
               <tbody class="services_{{$s->id}}">
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            <img src="/uploads/{{$s->image}}" width="100" height="100">
                        </td>
                        <td>{{$s->title}}</td>
                        <td>
                           {{$s->description}}
                        </td>
                       
                        <td>
                          <a class="icon__1" href="{{url('admin/update_sub_service_data')}}/{{$s->id}}"><i class="fas fa-edit"></i></a>
                           <a class="icon__2"  onclick="delete_sub_service({{$s->id}})"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        
                    </tr>
               </tbody>

               @endforeach
              

            </table>
            
         </div>
      </div>
      @endforeach

       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script type="text/javascript">


        $(function() {
                 setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 3000)

             });


      function delete_sub_service($id){


             swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                 
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {

                    var BASE_URL = "{{ url('/') }}";

                    var id = $id;

                          $.ajax({

                                url:BASE_URL+'/admin/delete_sub_service/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.services_'+id).hide();
         
   
                                     },
 
                            error: function(response) {

                                     alert('error');
          
                                },        
          
                           });



                    
                    } else {
                     
                    }
                  });
         
          

             }  

      </script> 


@endsection