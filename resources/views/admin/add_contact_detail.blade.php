@extends('admin.layout.header')

@section('content')

<style type="text/css">
   /* .delete-btn1 {
    right: 83px!important;
}*/
</style>

 <div class="head-banner">
          <ul class="breadcrumb">
              <li>
                  <a href="{{url('admin/home')}}">Home</a>
              </li>
              <li>
                  <a href="#"><span>Add Contact detail</span></a>
              </li>
          </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">ADD Contact detail</h4>
         </div>
         <div class="detail table-responsive">

           <form  action="{{url('admin/store_contact_detail')}}" enctype="multipart/form-data" method="POST" >
                @csrf

            <div class="details_main">

                 <div class="part">
                   <div class="col-md-12 label">
                     <label>Country</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter country name" name="country" value="">
                       @if($errors->has('country')) <p class="error_mes">{{ $errors->first('country') }}</p> @endif
                 </div>   
               </div>
                  <div class="part">
                   <div class="col-md-12 label">
                     <label>Email</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter email" name="email" value="">
                       @if($errors->has('email')) <p class="error_mes">{{ $errors->first('email') }}</p> @endif
                 </div>   
               </div>

               <div class="part">
                   <div class="col-md-12 label">
                     <label>Phone No</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Phone no" name="phone_no" value="">
                       @if($errors->has('phone_no')) <p class="error_mes">{{ $errors->first('phone_no') }}</p> @endif
                 </div>   
               </div>

                  <div class="part part">
                  <div class="col-md-12 label">
                     <label>Address</label>
                  </div>
                  <div class="col-md-12 data data1">
                     <div class="days data1">
                       <textarea type="text" placeholder="Enter here" name="address" value="" rows="2"></textarea>   
                    
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
 