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
               <a href=""><span>Blog Detail</span></a>
            </li>
         </ul>
      </div>

      <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Blog  detail</h4>
         
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

            	@foreach($about_blog_detail as $ab)
                        <tr class="w-100">
                          <th>Image</th>
                          <th><img src="/uploads/{{$ab->image}}" height="150" width="200"></th>
                        </tr>

                        <tr class="w-100">
                          <th>Date</th>
                          <th class="text">{{$ab->date}}</th>
                        </tr>

                        <tr class="w-100">
                          <th>Title</th>
                          <th class="text">{{$ab->title}}</th>
                        </tr>

                        <tr class="w-100">
                       	   <th>Description</th>
                           <th class="text">{!!$ab->description!!}</th>
                        </tr>

                        <tr class="w-100">
                           <th>Detail_description</th>
                           <th class="text">{!!$ab->detail_description!!}</th>
                        </tr>


                 @endforeach
               </tbody>
              
            </table>
            
         </div>
      </div>

      <div class="d-flex mx-auto">
      @foreach($about_blog_detail as $cs)
         <button class="clo btn0"><a href="{{url('/admin/add_about_blog_detail')}}/{{$cs->id}}">Update Details</a></button>
      @endforeach

      <button class="clo btn0 button-new"><a href="{{url('/admin/about_blog_detail')}}">Back to Details</a></button>
      </div>



   
       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script type="text/javascript">


        $(function() {
                 setTimeout(function() { $("#hideDiv").fadeOut(3000); }, 3000)

             });


      </script> 


@endsection