@extends('admin.layout.header')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href="index.html"><span>Service</span></a>
            </li>
         </ul>
      </div>

      <!-- <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0"> Service Description</h4>
         
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                
               </div>
            </div>
         </div>
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped text">

            	@foreach($service_description as $sd)
           
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

                  	 <th><button class="clo btn0"><a href="{{url('admin/update_service_desc')}}/{{$sd->id}}">update</a></button></th>  
                  	

                  </tr>

                 @endforeach
                    
              
            </table>
            
         </div>
      </div> -->




      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0"> Home Page Service  List</h4>
            <button class="btn1"><a href="{{url('admin/add_service')}}" style="color:white;">ADD</a></button>
         </div>
        
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                    
                     <th>Sr.No</th>
                     <th>Image</th>
                     <th>Title</th>
                     <th>Description</th>
                    
                     
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($service as $key=>$s)
               <tbody class="service_{{$s->id}}">
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                          <img src="/uploads/{{$s->image}}" width="60" height="60" class="bg-dark">
                        </td>
                        <td>{{$s->title}}</td>
                        <td>{{$s->description}}</td>
                       
                        <td>
                          <a class="icon__1" href="{{url('admin/update_service')}}/{{$s->id}}"><i class="fas fa-edit"></i></a>
                           <a class="icon__2"  onclick="delete_service({{$s->id}})"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        
                    </tr>
               </tbody>

               @endforeach
              

            </table>
            
         </div>
      </div>

       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript">


        $(function() {
                 setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 3000)

             });


         function delete_service($id){

     if(confirm("do you want delete this product ?")){
             $.ajax({

                url:'delete_service/'+$id,
                type:'GET',
                dataType: "json",

        success: function(response){
        
                      $('.service_'+$id).hide();
          
                        },

      error: function(response) {


           alert('error');
          
                 
                  },        
          
                });

          }
      } 

      </script> 


@endsection