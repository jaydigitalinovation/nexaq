@extends('admin.layout.header')

@section('content')

 <div class="head-banner">
          <ul class="breadcrumb">
              <li>
                  <a href="{{url('admin/home')}}">Home</a>
              </li>
              <li>
                  <a href="#"><span>Update Achievements</span></a>
              </li>
          </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">UPDATE Achievements</h4>
         </div>
         <div class="detail table-responsive">

           <form  action="{{url('admin/store_update_achievement')}}/{{$id}}" enctype="multipart/form-data" method="POST" >
                @csrf

            <div class="details_main">

                 <div class="part">
                   <div class="col-md-12 label">
                     <label>Title</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Title" name="title" value="{{$title}}">
                       @if($errors->has('title')) <p class="error_mes">{{ $errors->first('title') }}</p> @endif
                 </div>   
               </div>
                  <div class="part">
                   <div class="col-md-12 label">
                     <label>Number</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter number" name="number" value="{{$number}}">
                       @if($errors->has('number')) <p class="error_mes">{{ $errors->first('number') }}</p> @endif
                 </div>   
               </div>
               <div class="part">
                   <div class="col-md-12 label">
                     <label>Achievements area</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Achievements area" name="area" value="{{$area}}">
                       @if($errors->has('area')) <p class="error_mes">{{ $errors->first('area') }}</p> @endif
                 </div>   
               </div>


              
               <div class="uplode-btn">
                  <button>Update</button>
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
 