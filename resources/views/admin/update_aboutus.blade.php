@extends('admin.layout.header')

@section('content')


 <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>About us </span></a>
            </li>
         </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">Update About us </h4>
         </div>
         <form action="{{url('admin/store_update_aboutus')}}/{{$id}}" method="post" enctype="multipart/form-data">
         	@csrf
         <div class="detail table-responsive">
            <div class="details_main">
               <div class="details_inner">
                  <div class="part-1">
                     <div class="col-lg-2 label">
                           <label>Image</label>
                        </div>
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
                  <div class="part-1">

                     <div class="col-lg-2 label">
                           <label>Image1</label>
                        </div>
                     <div class="details_image">
                        <img src="/uploads/{{$image1}}" id="blah1">
                     </div>
                     <div class="details_sub">
                        <input type="file" name="image1" onchange="readURL1(this);" >
                           <input type="hidden" name="oldimage1" value="{{$image1}} "/>
                          @if($errors->has('image1')) <p class="error_mes">{{ $errors->first('image1') }}</p> @endif
                      <!--   <img id="blah" src="#" alt="">  -->
                     </div>  
                  </div>            
               </div>
               <div class="details_inner">
                  <div class="part">
                     <div class="row">
                        <div class="col-lg-2 label">
                           <label>Title</label>
                        </div>
                        <div class="col-lg-10 data">
                           <input type="text" placeholder="Enter Title" name="title" value="{{$title}}" >
                             @if($errors->has('title')) <p class="error_mes">{{ $errors->first('title')}}</p> @endif
                        </div>
                     </div>   
                  </div>
              
               </div>

                <div class="details_inner">
                  <div class="part">
                     <div class="row">
                        <div class="col-lg-2 label">
                           <label>Experience</label>
                        </div>
                        <div class="col-lg-10 data">
                           <input type="text" placeholder="Enter Title" name="experience" value="{{$experience}}" >
                             @if($errors->has('experience')) <p class="error_mes">{{ $errors->first('experience')}}</p> @endif
                        </div>
                     </div>   
                  </div>
              
               </div>
            
               <div class="details_inner">
                  <div class="part part1">
                     <div class="row">
                        <div class="col-lg-12 label">
                           <label>Description</label>
                        </div>
                        <div class="col-lg-12 data">
                           <textarea placeholder="Enter text.." name="description" value="{{$description}}" spellcheck="false">{{$description}}</textarea>
                             @if($errors->has('description')) <p class="error_mes">{{ $errors->first('description') }}</p> @endif
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


         function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah1')
                        .attr('src', e.target.result)
                        .width(130)
                        .height(130);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

</script>

@endsection