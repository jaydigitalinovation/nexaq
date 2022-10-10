@extends('admin.layout.header')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Team</span></a>
            </li>
         </ul>
      </div>

      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Team Description</h4>
         
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                
               </div>
            </div>
         </div>
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped text">

            	@foreach($team_desc as $td)
  
                  <tr>
                    
                     <th>Title</th>

                 </tr>

                 <tr>

                 	<th class="text">{{$td->title}}</th>

                 </tr>

                 <tr>
                 	
                 	<th>Description</th>
                 </tr>

                 <tr>

                 	<th class="text">{{$td->description}}</th>              
                  </tr>

                  <tr>

                  	 <th><button class="clo btn0"><a href="{{url('admin/update_team_desc')}}/{{$td->id}}">update</a></button></th>  
                  	

                  </tr>

                 @endforeach
                    
              
            </table>
            
         </div>
      </div>




      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Team</h4>
            <button class="btn1"><a href="{{url('admin/add_team')}}/0" style="color:white;">ADD</a></button>
         </div>
        
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                    
         
                     <th>Image</th>
                     <th>Name</th>
                     <th>Occupation</th>
                     <th>Facebook url </th>
                     <th>Instagram url </th>
                     <th>Twitter url </th>                
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($team as $t)
               <tbody class="team_{{$t->id}}">
                    <tr>
                   
                        <td>
                         <img src="/uploads/{{$t->image}}" width="100", height="100">
                        </td>
                        <td>{{$t->name}}</td>
                        <td>{{$t->occupation}}</td>
                         <td>{{$t->fb_url}}</td>
                        <td>{{$t->insta_url}}</td>
                          <td>{{$t->twitter_url}}</td>
                       
                        <td>
                          <a class="icon__1" href="{{url('admin/add_team')}}/{{$t->id}}"><i class="fas fa-edit"></i></a>
                           <a class="icon__2"  onclick="delete_team({{$t->id}})"><i class="fas fa-trash-alt"></i></a>
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


          function delete_team($id){

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

                                url:BASE_URL+'/admin/delete_team/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.team_'+id).hide();
         
   
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