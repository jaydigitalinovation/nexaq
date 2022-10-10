@extends('admin.layout.header')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Case Detail</span></a>
            </li>
         </ul>

         
         <div class="btn1-main btn-nw">
                <!-- <button class="btn1 delete-btn1">all delete</button> -->
                <button class="clo btn0"><a href="{{url('admin/add_more_cs_banner_list')}}/{{$id}}">Next</a></button>
            </div>

      </div>

      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Case Banner Description</h4>
            
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                
               </div>
            </div>
         </div>
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped text">

               @if(count($cs_banner_data) == 0)

               <th><button class="clo btn0"><a href="{{url('admin/add_more_cs_banner_data')}}/{{$id}}">add</a></button></th>

               @else 

            	@foreach($cs_banner_data as $sd)


                  <tr>
                    
                     <th>Image</th>

                 </tr>

                 <tr>

                  <th class="text"><img src="/uploads/{{$sd->image}}"></th>

                 </tr>
           
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

                  	 <th><button class="clo btn0"><a href="{{url('admin/add_more_cs_banner_data')}}/{{$sd->case_id}}">update</a></button></th>  
                  	

                  </tr>

                 @endforeach

                 @endif
                    
              
            </table>
            
         </div>
      </div>

      




      
      <style type="text/css">
         
         .service td{

            text-align: left!important;


         }

         .text img{
            width: 20%;
         }
         .btn-nw button{
            position: absolute;
            top: 18px;
            right: 20px;
         }
         .btn-nw1 button{
            position: absolute;
            top: 18px;
            right: 25px;
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