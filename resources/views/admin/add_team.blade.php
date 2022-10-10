@extends('admin.layout.header')

@section('content')


 <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               @if($id==0)
               <a href=""><span>Add new Team member</span></a>
               @else
               <a href=""><span>Update Team member Detail</span></a>
               @endif
            </li>
         </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
           @if($id==0)
            <h4 class="mb-4">Add new Team member</h4>
          @else
              <h4 class="mb-4">Update Team member Detail</h4>
            @endif
         </div>
         <form action="{{url('admin/store_team')}}/{{$id}}" method="post" enctype="multipart/form-data">
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
                           <input type="hidden" name="oldimage" value="{{$image}} "/>
                          @if($errors->has('image')) <p class="error_mes">{{ $errors->first('image') }}</p> @endif
                      <!--   <img id="blah" src="#" alt="">  -->
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
                           <input type="text" placeholder="Enter name" name="name" value="{{$name}}" >
                             @if($errors->has('name')) <p class="error_mes">{{ $errors->first('name') }}</p> @endif
                        </div>
                     </div>   
                  </div>
              
               </div>

                <div class="details_inner">
                  <div class="part">
                     <div class="row">
                        <div class="col-lg-2 label">
                           <label>Occupation</label>
                        </div>
                        <div class="col-lg-10 data">
                           <input type="text" placeholder="Enter Occupation" name="occupation" value="{{$occupation}}" >
                             @if($errors->has('occupation')) <p class="error_mes">{{ $errors->first('occupation') }}</p> @endif
                        </div>
                     </div>   
                  </div>     
               </div>

               <div class="details_inner">
                  <div class="part">
                     <div class="row">
                        <div class="col-lg-2 label">
                           <label>Facbook url</label>
                        </div>
                        <div class="col-lg-10 data">
                           <input type="text" placeholder="Enter Facbook url" name="fb_url" value="{{$fb_url}}" >
                             @if($errors->has('fb_url')) <p class="error_mes">{{ $errors->first('fb_url') }}</p> @endif
                        </div>
                     </div>   
                  </div>     
               </div>

                <div class="details_inner">
                  <div class="part">
                     <div class="row">
                        <div class="col-lg-2 label">
                           <label>Instagram url</label>
                        </div>
                        <div class="col-lg-10 data">
                           <input type="text" placeholder="Enter Instagram url" name="insta_url" value="{{$insta_url}}" >
                             @if($errors->has('insta_url')) <p class="error_mes">{{ $errors->first('insta_url') }}</p> @endif
                        </div>
                     </div>   
                  </div>     
               </div>

               <div class="details_inner">
                  <div class="part">
                     <div class="row">
                        <div class="col-lg-2 label">
                           <label>Twitter url</label>
                        </div>
                        <div class="col-lg-10 data">
                           <input type="text" placeholder="Enter Twitter url" name="twitter_url" value="{{$twitter_url}}" >
                             @if($errors->has('twitter_url')) <p class="error_mes">{{ $errors->first('twitter_url') }}</p> @endif
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