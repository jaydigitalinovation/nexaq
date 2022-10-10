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
                <button class="clo btn0"><a href="{{url('admin/add_more_cs_banner')}}/{{$id}}">Previous</a></button>
            </div>
         <div class="btn1-main btn-nw">
                <!-- <button class="btn1 delete-btn1">all delete</button> -->
                <button class="clo btn0"><a href="{{url('admin/add_more_cs_challenge')}}/{{$id}}">Next</a></button>
            </div>
      </div>

      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Case List description</h4>
            <div class="btn1-main">
                <!-- <button class="btn1 delete-btn1">all delete</button> -->
                <button class="btn1"><a href="{{url('admin/add_more_cs_banner_list_data')}}/{{$id}}" style="color:white;">ADD</a></button>
            </div>
            
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                
               </div>
            </div>
         </div>

         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                    <th>Id</th>
                     <th>Title</th>
                     <th>List</th>
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($cs_banner_list as $key=>$cd)
                 <tbody class="cs_banner_list_{{$cd->id}}">
                    <tr>
                        <td>{{$key+1}}</td>
                        
                     
                        <td>
                           @foreach($cs_banner_main_list as $cs)

                           @if($cd->list_id == $cs->id)

                           {{$cs->title}}

                           @endif

                           @endforeach
                        </td>
                        <td>{{$cd->name}}</td>

                       
                        <td>
                           <a class="icon__2" onclick="delete_cs_banner_list({{$cd->id}})"><i class="fas fa-trash-alt"></i></a>
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

            function delete_cs_banner_list($id){

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

                                url:BASE_URL+'/admin/delete_cs_banner_list/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.cs_banner_list_'+id).hide();
         
   
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