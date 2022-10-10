@extends('admin.layout.header')

@section('content')


 <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Update Segment</span></a>
            </li>
         </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">Update Segment</h4>
         </div>
         <form action="{{url('admin/store_update_segment')}}/{{$segment_id}}" method="post" enctype="multipart/form-data">
         	@csrf
         <div class="detail table-responsive">
            <div class="details_main">
               <div class="details_inner">
                  <div class="part-1">
                     <div class="details_image">
                        <img src="/uploads/{{$image}}" id="blah">
                     </div>
                     <div class="details_sub">
                        <input type="file" name="image" onchange="readURL(this);" >
                         <input type="hidden" name="oldimage" value="{{$image}}"  >
                          @if($errors->has('image')) <p class="error_mes">{{ $errors->first('image') }}</p> @endif

                          <input type="hidden" name="industry_id" value="{{$industry_id}}">
                     
                     </div>  
                  </div>            
               </div>
               <div class="details_inner">
                  <div class="part">
                     <div class="row">
                        <div class="col-lg-2 label">
                           <label>Name</label>
                        </div>
                        <div class="col-lg-10 data">
                           <input type="text" placeholder="Enter Name" name="name" value="{{$name}}" >
                             @if($errors->has('name')) <p class="error_mes">{{ $errors->first('name') }}</p> @endif
                        </div>
                     </div>   
                  </div>
              
               </div>
            
              
               <div class="uplode-btn" style="text-align: center;">
                  <button>submit</button>
                  <a href="{{url('admin/home')}}">Back to Home?</a>
               </div>
            </div>
         </div>

         </form>
      </div>


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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

@endsection