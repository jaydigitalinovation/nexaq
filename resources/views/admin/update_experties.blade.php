@extends('admin.layout.header')

@section('content')

 <div class="head-banner">
          <ul class="breadcrumb">
              <li>
                  <a href="{{url('admin/home')}}">Home</a>
              </li>
              <li>
                  <a href="#"><span>Update Experties</span></a>
              </li>
          </ul>
      </div>


         <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-0"> Aleardy Inserted Images</h4>
         
         </div>
        
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                    <th>Image</th>   
                     <th>Title</th>           
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($expertise_image as $ei)
               <tbody class="image_{{$ei->id}}">
                    <tr>
                    
                        <td><img src="/uploads/{{$ei->image}}" width="120" height="120"></td>
                        <td>{{$ei->title}}</td>
                       
                         <td>
                          <a class="icon__1" href="{{url('admin/update_experties_image')}}/{{$ei->id}}"><i class="fas fa-edit"></i></a>
                            <a class="icon__2" onclick="delete_image({{$ei->id}})"><i class="fas fa-trash-alt"></i></a>    
                        </td>
                        
                    </tr>
               </tbody>

               @endforeach
              

            </table>
            
         </div>
      </div>




      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">Update Experties</h4>
         </div>
         <div class="detail table-responsive">

           <form  action="{{url('admin/store_update_experties')}}/{{$id}}" enctype="multipart/form-data" method="POST" >
                @csrf

            <div class="details_main">
             
            
                 <div class="part">
                   <div class="col-md-12 label">
                     <label>Title</label>
                   </div>
                  <div class="col-md-12 data">
                     <input type="text" placeholder="Enter Title" name="title" value="{{$title}}">
                       @if($errors->has('title')) <p class="error_mes">{{ $errors->first('title') }}</p> @endif
                 </div>   
               </div>

                <div class="part">
                   <div class="col-md-12 label">
                     <label>Description</label>
                   </div>
                  <div class="col-md-12 data">
                     <textarea  type="text" placeholder="Enter Description" name="description" value="{{$description}}">{{$description}}</textarea>
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
            </form>
         </div>
       
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
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <script type="text/javascript">

     


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

         function delete_image($id){


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

                                url:BASE_URL+'/admin/delete_experties_image/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.image_'+id).hide();
         
   
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
 