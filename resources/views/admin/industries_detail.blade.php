@extends('admin.layout.header')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Indsutries</span></a>
            </li>

            <li>
               <a href=""><span>{{$page_name}}</span></a>
            </li>
         </ul>
      </div>

        <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">{{$page_name}} Page Banner</h4>
           
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

         <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">{{$page_name}} Description</h4>
         
         </div>
        
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>   
                     <th>Title</th>
                     <th>Description </th>                
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($industry_desc as $id)
               <tbody class="">
                    <tr>
                   
                  
                        <td>{{$id->title}}</td>
                       
                        <td>{!!$id->description !!}</td>
                     
                       
                        <td>
                          <a class="icon__1" href="{{url('admin/update_industry_desc')}}/{{$id->id}}"><i class="fas fa-edit"></i></a>
                         
                        </td>
                        
                    </tr>
               </tbody>

               @endforeach
              

            </table>
            
         </div>
      </div>

      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">{{$page_name}} Experties</h4>
            <button class="btn1"><a href="{{url('admin/add_experties')}}/{{$industry_id}}" style="color:white;">ADD</a></button>
         </div>
        
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                 
                     <th>Title</th>
                     <th>Description </th>

                     <th>View</th>
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($expertise as $ex)

               <tbody class="experties_{{$ex->id}}">

                  <tr>

                     <td>{{$ex->title}}</td>
                     <td>{{$ex->description}}</td>

                    <td>   <a class="icon__1" href="{{url('admin/view_industries_experties')}}/{{$ex->id}}"><i class="fas fa-eye"></i></a></td>

                     <td>
                       
                          <a class="icon__1" href="{{url('admin/update_experties')}}/{{$ex->id}}"><i class="fas fa-edit"></i></a>
                          <a class="icon__2" onclick="delete_experties({{$ex->id}})"><i class="fas fa-trash-alt"></i></a>
                     </td>

                     </tr>
                
         
                  
               </tbody>

              @endforeach
              

            </table>
            
         </div>
      </div>


        <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">{{$page_name}} Segments</h4>
            <button class="btn1"><a href="{{url('admin/add_segment')}}/{{$industry_id}}" style="color:white;">ADD</a></button>
           
         </div>
        
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Name</th> 
                     <th>Image</th>
                     <th>Action</th>
                  </tr>
               </thead>

              @foreach($segments as $s)
               <tbody class="segment_{{$s->id}}">
                    <tr>
                   
                       
                        <td>{{$s->name}}</td>

                         <td>
                          <img src="/uploads/{{$s->image}}" width="120" height="120">
                        </td>
                       
                       
                        <td>
                          <a class="icon__1" href="{{url('admin/update_segment')}}/{{$s->id}}"><i class="fas fa-edit"></i></a>
                          <a class="icon__2" onclick="delete_segment({{$s->id}})"><i class="fas fa-trash-alt"></i></a>
                        
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

            function delete_segment($id){

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

                                url:BASE_URL+'/admin/delete_segment/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.segment_'+id).hide();
         
   
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