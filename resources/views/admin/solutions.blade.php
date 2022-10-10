@extends('admin.layout.header')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Solution</span></a>
            </li>
         </ul>
      </div>

      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Solution Description</h4>
         
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                
               </div>
            </div>
         </div>
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped text">

            	@foreach($solutions_desc as $sd)
           
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

                  	 <th><button class="clo btn0"><a href="{{url('admin/update_solutions_desc')}}/{{$sd->id}}">update</a></button></th>  
                  	

                  </tr>

                 @endforeach
                    
              
            </table>
            
         </div>
      </div>




      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0"> Our Solutions</h4>
            <button class="btn1"><a href="{{url('admin/add_solutions')}}/0" style="color:white;">ADD</a></button>
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

               @foreach($solutions as $s)
               <tbody class="solutions_{{$s->id}} service">
                    <tr>
                   
                       
                        <td>{{$s->title}}</td>
                        <td>{{$s->description}}</td>
                       
                        <td>
                          <a class="icon__1" href="{{url('admin/add_solutions')}}/{{$s->id}}"><i class="fas fa-edit"></i></a>
                           <a class="icon__2"  onclick="delete_solutions({{$s->id}})"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        
                    </tr>
               </tbody>

               @endforeach
              

            </table>
            
         </div>
      </div>
      <style type="text/css">
         
         .service td{

            text-align: left!important;


         }
      </style>

       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
      <script type="text/javascript">


        $(function() {
                 setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 3000)

             });

            function delete_solutions($id){

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

                                url:BASE_URL+'/admin/delete_solutions/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.solutions_'+id).hide();
         
   
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