@extends('admin.layout.header')

@section('content')

 <div class="head-banner">
          <ul class="breadcrumb">
              <li>
                  <a href="{{url('admin/home')}}">Home</a>
              </li>
              <li>
                  <a href="#"><span>Add Experties</span></a>
              </li>
          </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">Add Experties</h4>
         </div>
         <div class="detail table-responsive">

           <form  action="{{url('admin/store_experties')}}/{{$industry_id}}" enctype="multipart/form-data" method="POST" >
                @csrf

            <div class="details_main">
             
            
                 <div class="part">
                   <div class="col-md-12 label">
                     <label>Title</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Title" name="title" value="">
                       @if($errors->has('title')) <p class="error_mes">{{ $errors->first('title') }}</p> @endif
                 </div>   
               </div>

                <div class="part">
                   <div class="col-md-12 label">
                     <label>Description</label>
                   </div>
                  <div class="col-md-12 data">
                     <textarea  type="text" placeholder="Enter Description" name="description" value=""></textarea>
                       @if($errors->has('description')) <p class="error_mes">{{ $errors->first('description') }}</p> @endif
                 </div>   
               </div>
               <div class="part part">
                  <div class="col-md-12 label">
                     <label>Image</label>
                  </div>
                  <div class="col-md-12 data data1">
                     <div class="days data1 ">

                         <input type="file" name="image" value="">

                       
                            <div class="col-md-12 label">
                            <label class="text12">Image Title</label>
                           </div>
                        

                         <input type="text" name="title1" value="">
                       
                        <button id="removeRow" type="button" class="btn-remove">Remove</button>
                     </div>
                     <div id="newRow"></div>
                     <button id="addRow1" type="button" class="btn-remove btn-add1">Add more</button>
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

   <style type="text/css">
       
       label.text12 {
    margin-top: 17px;
    margin-left: -14px;
}
   </style>


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



      $(document).on('click', '#addRow1', function () {
           var html = '';
           
            html += '<div class="col-md-12 label">  <label class="text12">Image</label></div><div class="days">';
           html += ' <input type="file" name="images[]">';
              html += '<div class="col-md-12 label">  <label class="text12">ImageTitle</label></div>';
           html += ' <input type="text" name="titles[]">';
            html += '<button id="removeRow" type="button" class="btn-remove">Remove</button>';
            html += '</div>';
           

            $('#newRow').append(html);
        });

     
        $(document).on('click', '#removeRow', function () {
            $(this).closest('.days').remove()
        });


    
    </script>
 