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
                   <a href=""><span>Add Case Management detail</span></a>
                   @else
                   <a href=""><span>Update Case Management Detail</span></a>
                   @endif
              </li>
          </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            @if($id==0)
            <h4 class="mb-4">Add Case Management detail</h4>
            @else
              <h4 class="mb-4">Update Case Management Detail</h4>
            @endif
            
         </div>
         <div class="detail table-responsive">

           <form  action="{{url('admin/store_add_solution_team_data')}}/{{$id}}" enctype="multipart/form-data" method="POST">
                @csrf


            <div class="details_main">

                  <div class="part">
                   <div class="col-md-12 label">
                     <label>Title</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Case Title" name="title" value="{{$title}}">
                       @if($errors->has('title')) <p class="error_mes">{{ $errors->first('title') }}</p> @endif
                 </div>   
               </div>

                  <div class="part part">
                  <div class="col-md-12 label">
                     <label>Description</label>
                  </div>
                  <div class="col-md-12 data data1">
                     <div class="days data1">
                       <textarea type="text" name="description">{{$description}}</textarea>   
                     </div>
                  </div>
               </div>

               <div class="d-block w-100 my-5 TextBoxContainer">
                            <div class="w-75 mx-auto">

                            <div class="part mx-auto w-75">
                                <div class="col-md-12 label">
                                    <label>team_description</label>
                                </div>
                                <div class="col-md-12 data">
                                    <textarea type="text" name="team_description" class="summernote1"></textarea>
                                    @if($errors->has('team_description')) <p class="error_mes">{{ $errors->first('team_description') }}</p> @endif
                                </div>
                            </div>

                            <a class="btnRemove add_section remove_section mx-end" href="">Remove</a>
                            <a class="add_section btnAdd" href="">Add More</a>
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



    $(document).ready(function(){

  $(document).on('click' , '.btnAdd', function(e) {

        e.preventDefault();

          $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          }
        });

        $.ajax({

        type: "get",
        url: "/admin/add_section",
        datatype: "json",
         success:function(response) {
          
          var div = $("<div />");
        div.html(GetDynamicTextBox(""));
        $(".TextBoxContainer").append(div);
        },

        
        error:function (response) {

          alert(22);
      },
      
      });
    });


  });


  $(document).ready(function(){

  $(document).on('click' , '.btnRemove', function(e) {

        e.preventDefault();

          $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          }
        });

        $.ajax({

        type: "get",
        url: "/admin/remove_section",
        datatype: "json",
         success:function(response) {
          
          $(".btnRemove:last").closest("div").remove();

        },
        error:function (response) {

          alert(22);
      },
      
      });
    });


  });

  function GetDynamicTextBox(value) {

    return '<div class="w-75 mx-auto"><div class="part mx-auto w-75"><div class="part mx-auto w-75"><div class="col-md-12 label"><label>team_description</label></div><div class="col-md-12 data"><textarea type="text" name="team_descriptions[]" class="summernote1"></textarea>@if($errors->has('team_description')) <p class="error_mes">{{ $errors->first('team_description') }}</p> @endif</div></div><a class="add_section remove_section mx-end btnRemove" href="">Remove</a><a class="add_section btnAdd" href="">Add More</a></div>'
}



    </script>

   @endsection



 