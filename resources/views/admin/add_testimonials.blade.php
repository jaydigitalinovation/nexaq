@extends('admin.layout.header')

@section('content')

 <div class="head-banner">
          <ul class="breadcrumb">
              <li>
                  <a href="{{url('admin/home')}}">Home</a>
              </li>
              <li>
                  <a href="#"><span>Add Testimonials</span></a>
              </li>
          </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">ADD Testimonials</h4>
         </div>
         <div class="detail table-responsive">

           <form  action="{{url('admin/store_testimonials')}}" enctype="multipart/form-data" method="POST" >
                @csrf

            <div class="details_main">
               <div class="details_inner">
                  <div class="part2">
                      <div class="col-md-12 label">
                     <label>Image</label>
                  </div>
                     <div class="details_image">
                           <img id="blah" src="/image/dummy_banner.jpg" alt="" />
                     </div>
                       <input type="file" name="image" onchange="readURL(this);" require="">
                         @if($errors->has('image')) <p class="error_mes">{{ $errors->first('image') }}</p> @endif
                        
                  </div>            
               </div>
              
                 <div class="part">
                   <div class="col-md-12 label">
                     <label>Name</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Name" name="name" value="">
                       @if($errors->has('name')) <p class="error_mes">{{ $errors->first('name') }}</p> @endif
                 </div>   
               </div>
               <div class="part part">
                  <div class="col-md-12 label">
                     <label>Description</label>
                  </div>
                  <div class="col-md-12 data data1">
                     <div class="days data1">

                       <textarea type="text" placeholder="Enter here" name="description" value="" rows="2"></textarea> 
                         @if($errors->has('description')) <p class="error_mes">{{ $errors->first('description') }}</p> @endif  
                    
                     </div>
                    
              
                  </div>
               </div>

               <div class="part part">
                  <div class="col-md-12 label">
                     <label>Address</label>
                  </div>
                  <div class="col-md-12 data data1">
                     <div class="days data1">

                       <textarea type="text" placeholder="Enter here" name="address" value="" rows="2"></textarea> 
                         @if($errors->has('address')) <p class="error_mes">{{ $errors->first('address') }}</p> @endif  
                    
                     </div>
                    
              
                  </div>
               </div>
               <div class="uplode-btn">
                  <button>Add</button>
                  <a href="{{url('admin/home')}}">Back to Home?</a>
               </div>
            </div>
         </div>
       </form>
      </div>

   @endsection


   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script type="text/javascript">

      function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(130)
                        .height(130);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }





    
    </script>
 