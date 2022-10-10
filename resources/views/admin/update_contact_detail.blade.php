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

           <form  action="{{url('admin/store_update_contact_detail')}}/{{$id}}" enctype="multipart/form-data" method="POST" >
                @csrf

            <div class="details_main">

                 <div class="part">
                   <div class="col-md-12 label">
                     <label>Country</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter country" name="country" value="{{$country}}">
                       @if($errors->has('country')) <p class="error_mes">{{ $errors->first('country') }}</p> @endif
                 </div>   
               </div>
                  <div class="part">
                   <div class="col-md-12 label">
                     <label>Email</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter email" name="email" value="{{$email}}">
                       @if($errors->has('email')) <p class="error_mes">{{ $errors->first('email') }}</p> @endif
                 </div>   
               </div>
               <div class="part">
                   <div class="col-md-12 label">
                     <label>Phone No</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Phone No" name="phone_no" value="{{$phone_no}}">
                       @if($errors->has('phone_no')) <p class="error_mes">{{ $errors->first('phone_no') }}</p> @endif
                 </div>   
               </div>

                 <div class="part">
                   <div class="col-md-12 label">
                     <label>Address</label>
                   </div>
                  <div class="col-md-12 data">
                    <textarea  placeholder="Enter here" name="address" value="{{$address}}">{{$address}}</textarea>
                       @if($errors->has('address')) <p class="error_mes">{{ $errors->first('address') }}</p> @endif
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
 