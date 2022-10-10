@extends('admin.layout.header')

@section('content')


 <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               @if($id==0)
               <a href=""><span>Add new Service</span></a>
               @else
               <a href=""><span>Update Service</span></a>
               @endif
            </li>
         </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
           @if($id==0)
            <h4 class="mb-4">Add new Service</h4>
          @else
              <h4 class="mb-4">Update Service</h4>
            @endif
         </div>
         <form action="{{url('admin/store_main_service')}}/{{$id}}" method="post" enctype="multipart/form-data">
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
                        <input type="hidden" name="oldimage"  value="{{$image}}" >
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
                           <input type="text" placeholder="Enter Name" name="name" value="{{$name}}" >
                             @if($errors->has('name')) <p class="error_mes">{{ $errors->first('name') }}</p> @endif
                        </div>
                     </div>   
                  </div>   
               </div>

                  <div class="part">
                  <div class="row">
                     <div class="col-lg-2 label">
                        <label>Service Type</label>
                     </div>
                     <div class="col-lg-10 data">

                        <select name="type">
                            <option>Select Service type</option> 
                            @foreach($service_type as $st)

                             <!-- <option value="{{$st->id}}">{{$st->name}}</option> -->
                               
                                <option value="{{$st->id}}"{{$st->id== $type ? 'selected' : ''}}>{{$st->name}}</option>  

                            @endforeach

                              @if($errors->has('type')) <p class="error_mes">{{ $errors->first('type') }}</p> @endif

                      </select>
                      
                     </div>
                  </div>            
               </div>  
                         
               <div class="details_inner">
                  <div class="part part1">
                     <div class="row">
                        <div class="col-lg-12 label">
                           <label>Short Description</label>
                        </div>
                        <div class="col-lg-12 data">
                           <textarea placeholder="Enter text.." name="short_description" value="{{$short_description}}" spellcheck="false">{{$short_description}}</textarea>
                             @if($errors->has('short_description')) <p class="error_mes">{{ $errors->first('short_description') }}</p> @endif
                        </div> 
                     </div>  
                  </div>
               </div>

                <div class="details_inner">
                  <div class="part part1">
                     <div class="row">
                        <div class="col-lg-12 label">
                           <label>Capabilites</label>
                        </div>
                        <div class="col-lg-12 data">
                           <textarea placeholder="Enter text.." name="capabilities" value="{{$capabilities}}" id="summernote" spellcheck="false">{{$capabilities}}</textarea>
                             @if($errors->has('capabilities')) <p class="error_mes">{{ $errors->first('capabilities') }}</p> @endif
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
                           <textarea placeholder="Enter text.." name="description" value="{{$description}}" id="summernote" spellcheck="false">{{$description}}</textarea>
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

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>

          <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>


   <script type="text/javascript">
       
         $('textarea#summernote').summernote({
        placeholder: 'Hello bootstrap 4',
        tabsize: 2,
        height: 100,
  toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'italic', 'underline', 'clear']],
        // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
        //['fontname', ['fontname']],
       // ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'hr']],
        //['view', ['fullscreen', 'codeview']],
        ['help', ['help']]
      ],
      });


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