@extends('admin.layout.header')

@section('content')


 <div class="head-banner">
         <ul class="breadcrumb">
            <li>
               <a href="{{url('admin/home')}}">Home</a>
            </li>
            <li>
               <a href=""><span>Update Industries </span></a>
            </li>
         </ul>
      </div>
      <div class="page mt-4 hosting-page title1 page-with" style="display: block;">
         <div class="list1">
            <h4 class="mb-4">{{$title}}</h4>
         </div>



          <div>
            <h4>Title</h4>
         </div>

         <div class="list1">
            <h5>{{$title}}</h5>
         </div>


          <div>
            <h4>Description</h4>
         </div>

         <div class="list1">
            <h5>{{$description}}</h5>
         </div>

          <div>
            <h4>Images</h4>
         </div>

           <div class="list1">


           @foreach($expertise_image as $ei)  

         <div class="gallery gallery_{{$ei->id}}" style="" >

             <h5>{{$ei->title}}</h5>
            <a target="">
                <img src="/uploads/{{$ei->image}}" alt="Cinque Terre" >
            
              </a>
          </div>

          @endforeach


           </div>





        
      </div>


      

@endsection