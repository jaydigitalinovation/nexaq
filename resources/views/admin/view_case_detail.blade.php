@extends('admin.layout.header')

@section('content')

<style type="text/css">
   .arr_d{
      display: flex;
      flex-wrap: wrap;
   }
   .arr_d1{
      width: 50%;
   }
   .arr_d tr th{
      display: block;
   }
   .table-title{
      font-size: 20px;
      color: #6b6b7a;
   }
   button.clo.btn0 {
       display: block;
       margin-left: auto;
       margin-top: 2%;
       margin-bottom: 2%;
   }
   .btn0 a{
      padding: 10px 12px!important;
   }
   .button-new{
      margin-right: auto;
      margin-left: 5px!important;
   }
</style>

  <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Case studies</span></a>
            </li>
         </ul>
      </div>

      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Case studies detail</h4>
         
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                
               </div>
            </div>
         </div>
         <div class="pro-table">
            <table class="table table-bordered table-striped text">
               <tbody class="arr_d">

            	@foreach($case_studies as $cs)
                        <tr class="w-100">
                          <th>Image</th>
                          <th><img src="/uploads/{{$cs->main_image}}" height="150" width="200"></th>
                        </tr>

                        <tr class="arr_d1">
                          <th>Sub_Title</th>
                          <th class="text">{{$cs->sub_title}}</th>
                        </tr>

                        <tr class="w-100">
                          <th>Title</th>
                          <th class="text">{{$cs->title}}</th>
                        </tr>

                        <tr class="w-100">
                       	   <th>Description</th>
                           <th class="text">{!!$cs->description!!}</th>
                        </tr>


                 @endforeach
               </tbody>
              
            </table>
            
         </div>
      </div>




      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Case Management detail</h4>
         
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                
               </div>
            </div>
         </div>
         <div class="pro-table">
            <table class="table table-bordered table-striped text">
               

               @foreach($case_management as $cs)
               <tbody class="arr_d">
                  <tr class="d-block w-100 table-title">
                     <th>{{$cs->title}}</th>
                  </tr>
                  
                        <tr class="w-50">
                          <th>Image</th>
                          <th><img src="/uploads/{{$cs->image}}" height="150" width="200"></th>
                        </tr>

                        <tr class="w-50">
                          <th>Icon_image</th>
                          <th><img src="/uploads/{{$cs->icon_image}}" height="150" width="200"></th>
                        </tr>

                        <tr class="arr_d1">
                          <th>Title</th>
                          <th class="text">{{$cs->title}}</th>
                        </tr>

                        <tr class="w-100">
                           <th>Description</th>
                           <th class="text">{!!$cs->description!!}</th>
                        </tr>

                  </tbody>
                 @endforeach
               
              
            </table>
            
         </div>
      </div>




      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Case Project detail</h4>
         
         </div>
         <div class="sear-list">
            <div class="row">
               <div class="col-lg-12">
                
               </div>
            </div>
         </div>
         <div class="pro-table">
            <table class="table table-bordered table-striped text">
               <tbody class="arr_d">

               @foreach($case_project as $cs)
                        <tr class="arr_d1">
                          <th>Title</th>
                          <th class="text">{{$cs->title}}</th>
                        </tr>

                        <tr class="w-100">
                           <th>Description</th>
                           <th class="text">{!!$cs->description!!}</th>
                        </tr>
                 @endforeach
               </tbody>
              
            </table>
            
         </div>
      </div>

      <div class="d-flex mx-auto">
         @foreach($case_studies as $cs)
            <button class="clo btn0"><a href="{{url('/admin/add_case_studies')}}/{{$cs->id}}">Update Details</a></button>
         @endforeach
            <button class="clo btn0 button-new"><a href="{{url('/admin/case_studies')}}">Back To Details</a></button>
      </div>




   
       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript">


        $(function() {
                 setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 3000)

             });


      </script> 


@endsection