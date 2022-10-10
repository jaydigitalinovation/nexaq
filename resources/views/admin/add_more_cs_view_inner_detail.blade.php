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
                <button class="clo btn0"><a href="{{url('admin/add_more_cs_inner_detail')}}/{{$case_id}}">Back</a></button>
            </div>

      </div>

      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">{{$name}} Description</h4>
            <div class="btn1-main">
                <!-- <button class="btn1 delete-btn1">all delete</button> -->
                <button class="btn1"><a href="{{url('admin/add_more_cs_view_inner_detail_data')}}/{{$id}}" style="color:white;">ADD</a></button>
            </div>
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                
               </div>
            </div>
         </div>
      </div>


      <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                    <th>Id</th>
                     <th>Balance View</th>
                     <th>Description</th>
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($cs_inner_detail_des_data as $key=>$cd)
                 <tbody class="cs_description_{{$cd->id}}">
                    <tr>
                        <td>{{$key+1}}</td>
                        
                     
                        
                        <td>{{$cd->title}}</td>
                        <td>{{$cd->description}}</td>

                       
                        <td>
                           
                           <a class="icon__2" onclick="delete_cs_description({{$cd->id}})"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        
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

                                url:BASE_URL+'/admin/delete_add_more_cs_view_inner_detail_data/'+id,
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