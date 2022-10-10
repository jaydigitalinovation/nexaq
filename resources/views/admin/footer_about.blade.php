@extends('admin.layout.header')

@section('content')


 <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span> Footer About Us</span></a>
            </li>
         </ul>
      </div>
      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Footer About Us</h4>
            <div class="btn1-main">
               <!--  <button class="btn1 delete-btn1">all delete</button>
                <button class="btn1"><a href="{{url('admin/add_home_banner')}}" style="color:white;">ADD</a></button> -->
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
         <div class="pro-table table-responsive">
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                  <!--   <th><input type="checkbox" name="" id="chkcheckAll"/></th> -->
                     <th>Sr.No</th>
                     <th>Image</th>
                  
                     <th>Description</th>
                     <th>Action</th>
                  </tr>
               </thead>

               @foreach($footer_about_us as $key=>$fb)
                 <tbody class="">
                    <tr>
                      <!--   <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{$fb->id}}"/></td> -->
                        <td>{{$key+1}}</td>
                        <td>
                          <img src="/uploads/{{$fb->image}}" width="200" height="200">
                        </td>
                        <td>{{$fb->description}}</td>
                      
                      
                        <td>
                          <a class="icon__1" href="{{url('admin/update_footer_about_us')}}/{{$fb->id}}"><i class="fas fa-edit"></i></a>
                          
                        </td>
                       <!--  <td class="clo">
                           <button class="clo btn0"><a href="#">view</a></button>
                        </td> -->
                    </tr>
                 </tbody>
               @endforeach
              
            </table>

          

         
         </div>
      </div>

                  

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      
       <script type="text/javascript">

         $(function() {

                   setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 5000)

              });


    </script>

      @endsection