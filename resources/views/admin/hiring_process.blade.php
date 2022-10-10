@extends('admin.layout.header')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Career</span></a>
            </li>

             <li>
               <a href=""><span>Hiring Process</span></a>
            </li>
         </ul>
      </div>

        <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Hiring Process Page Banner</h4>
           
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
            <h4 class="mb-0">Hiring Process Description</h4>
         
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                
               </div>
            </div>
         </div>
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped text">

               @foreach($hiring_process_desc as $hd)
           
                  <tr>
                    
                     <th>Title</th>

                 </tr>

                 <tr>

                  <th class="text">{{$hd->title}}</th>

                 </tr>

                 <tr>
                  
                  <th>Description</th>
                 </tr>

                 <tr>

                  <th class="text">{!!$hd->description!!}</th>              
                  </tr>

                  <tr>

                      <th><button class="clo btn0"><a href="{{url('admin/update_hiring_process_desc')}}/{{$hd->id}}">update</a></button></th>  
                     

                  </tr>

                 @endforeach
                    
              
            </table>
            
         </div>
      </div>

        <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Hiring Process Steps</h4>
            <button class="btn1"><a href="{{url('admin/add_hiring_step')}}/0" style="color:white;">ADD</a></button>
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

               @foreach($hiring_step as $hs)
               <tbody class="step_{{$hs->id}}">
                    <tr>
                   
                  
                        <td>{{$hs->title}}</td>
                       
                        <td>{!!$hs->description !!}</td>
                     
                       
                        <td>
                          <a class="icon__1" href="{{url('admin/add_hiring_step')}}/{{$hs->id}}"><i class="fas fa-edit"></i></a>
                           <a class="icon__2"  onclick="delete_hiring_step({{$hs->id}})"><i class="fas fa-trash-alt"></i></a>
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

            function delete_hiring_step($id){

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

                                url:BASE_URL+'/admin/delete_hiring_step/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.step_'+id).hide();
         
   
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