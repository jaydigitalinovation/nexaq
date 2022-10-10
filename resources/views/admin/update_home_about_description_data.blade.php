@extends('admin.layout.header')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css">
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
                   @if($id==0)
                   <a href=""><span>Add Who We Are detail</span></a>
                   @else
                   <a href=""><span>Update Who We Are Detail</span></a>
                   @endif
              </li>
          </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            @if($id==0)
            <h4 class="mb-4">Add Who We Are detail</h4>
            @else
              <h4 class="mb-4">Update Who We Are Detail</h4>
            @endif
            
         </div>
         <div class="detail table-responsive">

           <form  action="{{url('admin/store_update_home_about_description_data')}}/{{$id}}" enctype="multipart/form-data" method="POST">
                @csrf


            <div class="details_main">

                  <div class="part part">
                  <div class="col-md-12 label">
                     <label>Description</label>
                  </div>
                  <div class="col-md-12 data data1">
                     <div class="days data1">
                       <textarea type="text" name="description" id="summernote">{{$description}}</textarea>   
                     </div>
                  </div>
               </div>

               
              
               <div class="uplode-btn">
                  <button>Submit</button>
                  <a href="{{url('admin/home')}}">Back to Home?</a>
               </div>
            </div>
         
       </form>
      </div>
    </div>

    <style type="text/css">
  .remove_section{
    display: block;
    margin-bottom: 1%;
    margin-left: 66%!important;
  }
  .add_section{
    width: 130px;
    height: 50px;
    display: inline-block;
    background-color: #029e9d;
    margin-left: 14%;
  }
  .add_section:hover{
    background-color: black;
    text-decoration: none;
  }
  .add_section{
    color: white;
    text-decoration: none;
    text-align: center;
    line-height: 3;
  }
</style>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script type="text/javascript">


    $(function() {
                 setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 3000)

             });

      

    $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 100,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
      });



   



    </script>

   @endsection



 