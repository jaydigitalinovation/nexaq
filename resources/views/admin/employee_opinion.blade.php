@extends('admin.layout.header')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Employee opinion</span></a>
            </li>
         </ul>
      </div>

      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Employee opinion</h4>
            <button class="btn1"><a href="{{url('admin/add_employee_opinion')}}/0" style="color:white;">ADD</a></button>
         </div>
        
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                    
         
                     <th>Image</th>
                     <th>Name</th>
                     <th>Occupation</th>
                     <th>Description </th>                
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($employee_opinion as $eo)
               <tbody class="opinion_{{$eo->id}}">
                    <tr>
                   
                        <td>
                         <img src="/uploads/{{$eo->image}}" width="100", height="100">
                        </td>
                        <td>{{$eo->name}}</td>
                        <td>{{$eo->occupation}}</td>
                        <td>{{$eo->description}}</td>
                     
                       
                        <td>
                          <a class="icon__1" href="{{url('admin/add_employee_opinion')}}/{{$eo->id}}"><i class="fas fa-edit"></i></a>
                           <a class="icon__2"  onclick="delete_employee_opinion({{$eo->id}})"><i class="fas fa-trash-alt"></i></a>
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


          function delete_employee_opinion($id){

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

                                url:BASE_URL+'/admin/delete_employee_opinion/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.opinion_'+id).hide();
         
   
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