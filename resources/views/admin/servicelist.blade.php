@extends('admin.layout.header')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Services</span></a>
            </li>
         </ul>
      </div>


      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Services</h4>
            <button class="btn1"><a href="{{url('admin/add_main_service')}}/0" style="color:white;">ADD</a></button>
         </div>
        
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                    
                     <th>Image</th>
                     <th>Title</th>
                     <th>Type</th>
                     <th>Short Description</th>
                     <th>Capabilities</th>
                     <th>Description</th>                                     
                     <th>Action</th>
                     <th>List description</th>
                  </tr>
               </thead>

               @foreach($servicelist as $sl)
               <tbody class="service_{{$sl->id}}">
                    <tr>

                         <td>
                       <img src="/uploads/{{$sl->image}}" width="120" height="120">
                        </td>

                   
                        <td>
                        {{$sl->name}}
                        </td>

                        <td>

                       @foreach($service_type as $st) 

                       @if($st->id==$sl->type)
                        {{$st->name}}

                        @endif

                        @endforeach

                        </td>

                        <td>{{$sl->sort_desc}}</td>

                         <td>{!! $sl->capabilities !!}</td>


                        <td>{!!$sl->description!!}</td>
                       
                        <td>
                            
                          <a class="icon__1" href="{{url('admin/add_main_service')}}/{{$sl->id}}"><i class="fas fa-edit"></i></a>
                           <a class="icon__2"  onclick="delete_main_service({{$sl->id}})"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        <td>
                            <button class="clo btn0"><a href="{{url('/admin/sub_service')}}/{{$sl->id}}">Add Des.</a></button>
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


          function delete_main_service($id){

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

                                url:BASE_URL+'/admin/delete_main_service/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.service_'+id).hide();
         
   
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