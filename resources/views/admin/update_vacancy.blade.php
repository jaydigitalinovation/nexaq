@extends('admin.layout.header')

@section('content')

 <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               
               <a href=""><span>Update vacancy</span></a>
            </li>
         </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">Update vacancy</h4>
         </div>

         <form  action="{{url('admin/store_update_vacancy')}}/{{$id}}" enctype="multipart/form-data" method="POST" >    

           @csrf     

          <div class="details_main">
           
         
            <div class="details_inner">

                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Position</label>
                     </div>
                     <div class="col-lg-11 data">
                        <input type="text" placeholder="Enter Position" name="position" value="{{$position}}" >
                         @if($errors->has('position')) <p class="error_mes">{{ $errors->first('position') }}</p> @endif
                     </div>
                  </div>   
               </div>

                 <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Job Type</label>
                     </div>
                     <div class="col-lg-11 data">

                        <select name="job_type" value="{{$job_type1}}">
                            <option>select job type</option> 
                            @foreach($job_type as $jb)
                               
                                <option value="{{$jb->id}}"{{$jb->id== $job_type1 ? 'selected' : ''}}>{{$jb->type}}</option> 

                            @endforeach

                      </select>
                      
                     </div>
                  </div>            
               </div>  
               
            </div>


            <div class="details_inner">

                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Experience</label>
                     </div>
                     <div class="col-lg-11 data">
                        <input type="text" placeholder="Enter Experience" name="experience" value="{{$experience}}" >
                         @if($errors->has('experience')) <p class="error_mes">{{ $errors->first('experience') }}</p> @endif
                     </div>
                  </div>   
               </div>

                 <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Whom To Apply</label>
                     </div>
                     <div class="col-lg-11 data">
                        <input type="text" placeholder="Enter Whom To Apply" name="apply" value="{{$apply}}" >
                         @if($errors->has('apply')) <p class="error_mes">{{ $errors->first('apply') }}</p> @endif
                     </div>
                      
                     </div>
                  </div>            
               </div>  

              <div class="details_inner">

               @if( count($location) !=0)

                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Alreday Inserted Location</label>
                     </div>
                     <div class="col-lg-11 data d-flex  ">

                        @foreach($location as $l)

                           <div class="d-flex industry location_{{$l->id}}" >
                             {{$l->location}}

                             <span class="close"><i class="fa-solid fa-xmark" onclick="delete_location({{$l->id}})"></i></span>

                          </div>

                        @endforeach


                    
                     </div>
                  </div>   
               </div>
               @endif
               
                @if(count($technology) !=0)

                   <div class="part">
                     <div class="row">
                       <div class="col-lg-12 label">
                        <label> Alreday Inserted Technology</label>
                     </div>
                     <div class="col-lg-11 data d-flex  ">

                         @foreach($technology as $t)

                           <div class="d-flex industry technology_{{$i->id}}" >
                             {{$t->name}}

                             <span class="close"><i class="fa-solid fa-xmark" onclick="delete_technology({{$t->id}})"></i></span>

                          </div>

                        @endforeach
                        
                     </div>
                      
                     </div>
                  </div>

                  @endif   


                        

               
            <div class="details_inner">

                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Add More Location</label>
                     </div>
                     <div class="col-lg-11 data tagsinput">
                        <input type="text" placeholder="Enter location" name="location" value="" data-role="tagsinput" >
                         @if($errors->has('location')) <p class="error_mes">{{ $errors->first('location') }}</p> @endif
                     </div>
                  </div>   
               </div>


                 <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Add More Industry</label>
                     </div>
                     <div class="col-lg-11 data tagsinput">

                        <input type="text" placeholder="Enter Industry" name="industry" value="" data-role="tagsinput" >
                         @if($errors->has('industry')) <p class="error_mes">{{ $errors->first('industry') }}</p> @endif
                     </div>
                      
                     </div>
                  </div>  


                   <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Technology</label>
                     </div>
                     <div class="col-lg-11 data tagsinput">

                        <input type="text" placeholder="Enter Technology" name="technology" value="" data-role="tagsinput" >
                         @if($errors->has('technology')) <p class="error_mes">{{ $errors->first('technology') }}</p> @endif
                     </div>
                      
                     </div>
                  </div>        
               </div>           
               </div> 

               <div class="details_inner">
                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>About Role</label>
                     </div>
                     <div class="col-lg-11 data tagsinput">
                      <textarea name="about_role" id="summernote" value="{{$about_role}}">{{$about_role}}</textarea>
                         @if($errors->has('about_role')) <p class="error_mes">{{ $errors->first('about_role') }}</p> @endif
                     </div>
                  </div>   
               </div>

                 <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Responsibilities</label>
                     </div>
                     <div class="col-lg-11 data tagsinput">

                       <textarea name="responsibilities" id="summernote" value="{{$responsibilities}}">{{$responsibilities}}</textarea>
                         @if($errors->has('responsibilities')) <p class="error_mes">{{ $errors->first('responsibilities') }}</p> @endif
                     </div>
                      
                     </div>
                  </div>            
               </div>  

               <div class="details_inner">

                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Requirements</label>
                     </div>
                     <div class="col-lg-11 data tagsinput">
                      <textarea name="requirement" id="summernote" value="{{$requirement}}">{{$requirement}}</textarea>
                         @if($errors->has('requirement')) <p class="error_mes">{{ $errors->first('requirement') }}</p> @endif
                     </div>
                  </div>   
               </div>

                 <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Skills Required</label>
                     </div>
                     <div class="col-lg-11 data tagsinput">

                       <textarea name="skill" id="summernote" value="{{$skill}}">{{$skill}}</textarea>
                         @if($errors->has('skill')) <p class="error_mes">{{ $errors->first('skill') }}</p> @endif
                     </div>
                      
                     </div>
                  </div>            
               </div>

               <div class="details_inner">

                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Qualifications</label>
                     </div>
                     <div class="col-lg-11 data tagsinput">
                      <textarea name="qualifications" id="summernote" value="{{$qualifications}}">{{$qualifications}}</textarea>
                         @if($errors->has('qualifications')) <p class="error_mes">{{ $errors->first('qualifications') }}</p> @endif
                     </div>
                  </div>   
               </div>

                 <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>Technical Experience</label>
                     </div>
                     <div class="col-lg-11 data tagsinput">

                       <textarea name="tech_experience" id="summernote" value="{{$tech_experience}}">{{$tech_experience}}</textarea>
                         @if($errors->has('tech_experience')) <p class="error_mes">{{ $errors->first('tech_experience') }}</p> @endif
                     </div>
                      
                     </div>
                  </div>            
               </div>

                  <div class="details_inner">

                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label>It would be awesome if</label>
                     </div>
                     <div class="col-lg-11 data tagsinput">
                      <textarea name="extra_skills" id="summernote" value="{{$position}}"></textarea>
                         @if($errors->has('extra_skills')) <p class="error_mes">{{ $errors->first('extra_skills') }}</p> @endif
                     </div>
                  </div>   
               </div>                          
            </div>  
            
            <div class="uplode-btn">
               <button type="submit" value="submit">update</button>
               <a href="{{url('admin/home')}}">Back to Home?</a>
            </div>
         </div>

     </form>
      
      </div>

      <style type="text/css">



         .industry{

    padding: 10px;
    color: white;
    background: #787474;
    margin-left: 10px;
         }
       
         .data input {
    width: 95%;
   
}
/*.row {
  
     display: block !important; 
 
}*/
 .bootstrap-tagsinput{
        width: 95%;

    }
    .label-info{
        background-color: #17a2b8;

    }

    span.close {
    color: black;
    margin-top: 3px;
    margin-left: 9px;
}
    /*.label {
        display: inline-block;
        padding: .25em .4em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,
        border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }*/

      </style>

         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js" integrity="sha512-VvWznBcyBJK71YKEKDMpZ0pCVxjNuKwApp4zLF3ul+CiflQi6aIJR+aZCP/qWsoFBA28avL5T5HA+RE+zrGQYg==" crossorigin="anonymous"></script>

         <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


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


           function delete_location($id){

                  swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                 
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {

                    var BASE_URL = "{{ url('/') }}";

                    var id = $id;

                          $.ajax({

                                url:BASE_URL+'/admin/delete_location/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){


                                     $('.location_'+id).hide();
         
   
                                     },
 
                            error: function(response) {

                                     alert('error');
          
                                },        
          
                           });



                    
                    } else {
                     
                    }
                  });
        
           }


            function delete_industries($id){

                  swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                 
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {

                    var BASE_URL = "{{ url('/') }}";

                    var id = $id;

                          $.ajax({

                                url:BASE_URL+'/admin/delete_industries/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.industry_'+id).hide();
         
   
                                     },
 
                            error: function(response) {

                                     alert('error');
          
                                },        
          
                           });



                    
                    } else {
                     
                    }
                  });
        
           }


   function delete_technology($id){

                  swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                 
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {

                    var BASE_URL = "{{ url('/') }}";

                    var id = $id;

                          $.ajax({

                                url:BASE_URL+'/admin/delete_technology/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.technology_'+id).hide();
         
   
                                     },
 
                            error: function(response) {

                                     alert('error');
          
                                },        
          
                           });



                    
                    } else {
                     
                    }
                  });
        
           }





</script>

@endsection