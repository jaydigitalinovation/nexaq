@extends('admin.layout.header')

@section('content')


 <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Update Career Description</span></a>
            </li>
         </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">Update Career Description</h4>
         </div>
         <form action="{{url('admin/store_career_desc')}}/{{$id}}" method="post">
         	@csrf
         <div class="detail table-responsive">
            <div class="details_main">
             
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
                  <div class="part part1">
                     <div class="row">
                        <div class="col-lg-12 label">
                           <label>Description</label>
                        </div>
                        <div class="col-lg-12 data">
                           <textarea placeholder="Enter text.." name="description" value="{{$description}}" spellcheck="false" id="summernote">{{$description}}</textarea>
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


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
   </script>

  



      
@endsection

