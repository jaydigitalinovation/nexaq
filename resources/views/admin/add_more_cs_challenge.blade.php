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
         <div class="btn1-main btn-nw1">
                <!-- <button class="btn1 delete-btn1">all delete</button> -->
                <button class="clo btn0"><a href="{{url('admin/add_more_cs_banner_list')}}/{{$id}}">Previous</a></button>
            </div>
         <div class="btn1-main btn-nw">
                <!-- <button class="btn1 delete-btn1">all delete</button> -->
                <button class="clo btn0"><a href="{{url('admin/add_more_cs_expertise')}}/{{$id}}">Next</a></button>
            </div>

      </div>

      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Case Challenge Description</h4>
            
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                
               </div>
            </div>
         </div>
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped text">

               @if(count($cs_challenge_data) == 0)

               <th><button class="clo btn0"><a href="{{url('admin/add_more_cs_challenge_data')}}/{{$id}}">add</a></button></th>

               @else 

            	@foreach($cs_challenge_data as $sd)
           
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

                 	<th class="text">{!!$sd->description!!}</th>              
                  </tr>

                  <tr>

                  	 <th><button class="clo btn0"><a href="{{url('admin/add_more_cs_challenge_data')}}/{{$sd->case_id}}">update</a></button></th>  
                  	

                  </tr>

                 @endforeach

                 @endif
                    
              
            </table>
            
         </div>
      </div>


      <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                    <th>Id</th>
                     <th>Description</th>
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($challenge_description as $key=>$cd)
                 <tbody class="cs_description_{{$cd->id}}">
                    <tr>
                        <td>{{$key+1}}</td>
                        
                     
                        
                        <td>{{$cd->description}}</td>

                       
                        <td>
                           <a class="icon__2" onclick="delete_cs_description({{$cd->id}})"><i class="fas fa-trash-alt"></i></a>
                        </td>
                       <!--  <td class="clo">
                           <button class="clo btn0"><a href="#">view</a></button>
                        </td> -->
                    </tr>
                 </tbody>
               @endforeach
              

            </table>
            
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
            right: 90px;
         }
      </style>

       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
      <script type="text/javascript">


        $(function() {
                 setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 3000)

             });

            function delete_cs_description($id){

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

                                url:BASE_URL+'/admin/delete_add_more_cs_challenge/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.cs_description_'+id).hide();
         
   
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