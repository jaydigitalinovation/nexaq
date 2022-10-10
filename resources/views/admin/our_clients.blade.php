@extends('admin.layout.header')

@section('content')


 <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Our Clients</span></a>
            </li>
         </ul>
      </div>
      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Our Clients</h4>
            <div class="btn1-main">
                <button class="btn1 delete-btn1">all delete</button>
                <button class="btn1"><a href="{{url('admin/add_clients')}}" style="color:white;">ADD</a></button>
            </div>
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                  <div class="sear-main">
                    <!--  <label><input type="search" class="form-control " placeholder="Find..."></label> -->
                  </div>
               </div>
            </div>
         </div>

      
       @foreach($clients as $c)  

         <div class="gallery gallery_{{$c->id}}" style="" >

            <input type="checkbox" name="ids" class="checkBoxClass" value="{{$c->id}}" />
            <a target="" href="img_5terre.jpg">
                <img src="/uploads/{{$c->image}}" alt="Cinque Terre" >
                <a  class="delete_icon" onclick="delete_client({{$c->id}})"><i class="fas fa-trash-alt"></i></a>
             
                </a>
          </div>

          @endforeach

         

        
      </div>

         <style type="text/css">

      
   .gallery .delete_icon {

  position: absolute;
    transform: translate(-106%, 7%);
    -ms-transform: translate(-50%, -50%);
    background-color: #1b3e41;
    color: #ffffff;
    font-size: 20px;
    padding: 11px 11px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    }

    .gallery .update_icon {

    position: absolute;
    transform: translate(-109%, 15%);
    -ms-transform: translate(-50%, -50%);
    background-color: #fff;
    color: #0e0d0d;
    font-size: 20px;
    padding: 11px 11px;
    border: none;
    cursor: pointer;
    border-radius: 5px;

    }

   input.checkBoxClass {
    position: absolute;
}

.gallery img {
  
    border: 1px solid black;
}



       

    </style>


                  

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
       <script type="text/javascript">

         $(function() {

                   setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 5000)

              });

            function delete_client($id){



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

                                url:BASE_URL+'/admin/delete_clients/'+id,
                                type:'GET',
                                dataType: "json",

                                success: function(response){
        
                                     $('.gallery_'+id).hide();
         
   
                                     },
 
                            error: function(response) {

                                     alert('error');
          
                                },        
          
                           });



                    
                    } else {
                     
                    }
                  });
        
      }


          $(function(e) {

               $('#chkcheckAll').click(function(){

                   $(".checkBoxClass").prop('checked', $(this).prop('checked'));

               });

              $('.delete-btn1').click(function(e){

                 $.ajaxSetup({
                   headers: {
                     'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                    });


                   var BASE_URL = "{{ url('/') }}";

                      e.preventDefault();    

                      var allids=[];

                      $("input:checkbox[name=ids]:checked").each(function(){

                         allids.push($(this).val());

                        
                      });


                 if(allids !=''){


                 swal({
                         title: "Are you sure?",
                            text: "Once deleted, you will not be able to recover this data!",
                          /*  icon: "warning",*/
                            buttons: true,
                            dangerMode: true,
                              })
                          .then((willDelete) => {
                            if (willDelete) {


                                    $.ajax({

                                      url:BASE_URL+'/admin/delete_all_clients',
                                      type:'post',
                                      data:{

                                        ids:allids,
                                         _token: '{!! csrf_token() !!}',
                                    

                                      },

                                      success:function(response){


                                          if(response.status==200){
                                      
                                            $.each(allids,function(key,val){
                  
                                            $('.gallery_'+val).hide();

                                      
                                            });
                                            
                                                                        
                                          }
                                          else{
                                              alert(response.message)
                                          }

                                      }

                                    });

                             
                                } else {
                            
                              }
                          });


                          }

                    });
                

               });



    </script>
 


      @endsection      
