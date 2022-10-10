@extends('admin.layout.header')

@section('content')

 <div class="head-banner">
          <ul class="breadcrumb">
              <li>
                  <a href="{{url('admin/home')}}">Home</a>
              </li>
              <li>
                  <a href="#"><span>Update Footer About us</span></a>
              </li>
          </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">UPDATE Footer About us</h4>
         </div>
         <div class="detail table-responsive">

           <form  action="{{url('admin/store_update_footer_about_us')}}/{{$id}}" enctype="multipart/form-data" method="POST" >
                @csrf

            <div class="details_main">
               <div class="details_inner">
                  <div class="part2">
                      <div class="col-md-12 label">
                     <label> Image</label>
                  </div>
                     <div class="details_image">
                           <img id="blah" src="/uploads/{{$image}}" alt="" />
                     </div>
                       <input type="file" name="image" onchange="readURL(this);" require="">
                       <input type="hidden" name="oldimage" value="{{$image}}">
                      
                        
                  </div>            
               </div>                       
               <div class="part part1">
                  <div class="col-md-12 label">
                     <label> Description</label>
                  </div>
                  <div class="col-md-12 data data1">
                     <div class="days data1">
                       <textarea type="text" placeholder="Enter here" name="description" value="{{$description}}" rows="2">{{$description}}</textarea>   
                   
                     </div>
                     
                  </div>
               </div>
               <div class="uplode-btn">
                  <button>Add</button>
                  <a href="{{url('admin/update')}}">Back to Home?</a>
               </div>
            </div>
         </div>
       </form>
      </div>

   @endsection

   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
 