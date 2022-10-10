@extends('admin.layout.header')

@section('content')

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>About us</span></a>
            </li>
         </ul>
      </div>

      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">About Us</h4>
         
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                
               </div>
            </div>
         </div>
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped text">

            	@foreach($aboutus as $a)

               <tr>
                    
                    <th>Image1</th>

                 </tr>

                <tr>
                    
                    <th><img src="/uploads/{{$a->image}}" height="150" width="200"></th>

                


                 </tr>

                 <tr>
                   <th>Image2</th>
                 </tr>
                 <tr>

                      <th class="text1"><img src="/uploads/{{$a->image1}}" height="150" width="200"></th>
                    
                 </tr>

           
                  <tr>
                    
                    <th>Title</th>

                 </tr>

                 <tr>

                 	<th class="text">{{$a->title}}</th>

                  </tr>


                  <tr>
                    
                    <th>Experience</th>

                 </tr>

                 <tr>

                  <th class="text">{{$a->experience}}</th>

                 </tr>

                 <tr>
                 	
                 	<th>Description</th>
                 </tr>

                 <tr>

                 	<th class="text">{{$a->description}}</th>              
                  </tr>

                  <tr>

                  	 <th><button class="clo btn0"><a href="{{url('admin/update_aboutus')}}/{{$a->id}}">update</a></button></th>  
                  	

                  </tr>

                 @endforeach
                    
              
            </table>
            
         </div>
      </div>




   
       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript">


        $(function() {
                 setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 3000)

             });


      </script> 


@endsection