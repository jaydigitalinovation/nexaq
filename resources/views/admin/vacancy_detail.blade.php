@extends('admin.layout.header')

@section('content')

 
        <div class="page mt-4 hosting-page title1" style="display: block;">
         <div class="list1">
            <h4 class="mb-0">Vacancy Details</h4>
           
         </div>

         <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <label></label>
                     </div>
                     <div class="col-lg-11 data">
                       
                     </div>
                  </div>   
               </div>

            <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>Position</h5>
                     </div>
                     <div class="col-lg-11 data">

                           <h6>{{$position}}</h6>
                       
                     </div>
                  </div>   
               </div>

                 <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>Job Type</h5>
                     </div>
                     <div class="col-lg-11 data">

                         @foreach($job_type as $jt)

                         @if($jt->id==$job_type1)

                           <h6>{{$jt->type}} </h6>

                         @endif

                       @endforeach
 
                     </div>
                  </div>   
               </div>

                 @if($experience !='')

                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>Experience</h5>
                     </div>
                     <div class="col-lg-11 data">

                           <h6>{{$experience}}</h6>
                       
                     </div>
                  </div>   
               </div>

               @endif

                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>Whom To Apply</h5>
                     </div>
                     <div class="col-lg-11 data">

                           <h6>{{$apply}}</h6>
                       
                     </div>
                  </div>   
               </div>

               @if(count($location) !=0)

                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>Job Location</h5>
                     </div>
                     <div class="col-lg-11 data">

                            @foreach($location as $l)

                           <div class="d-flex industry location_{{$l->id}}" >
                             {{$l->location}}

                          </div>

                        @endforeach
   
                     </div>
                  </div>   
               </div>

               @endif

                 @if(count($industries) !=0)

                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>Industry</h5>
                     </div>
                      @foreach($industries as $i)

                           <div class="d-flex industry  " >
                             {{$i->industry}} 
                          </div>

                        @endforeach
                  </div>   
               </div>

            @endif

                @if(count($technology)!=0)

                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>Technology</h5>
                     </div>
                      @foreach($technology as $t)

                           <div class="d-flex industry  " >
                             {{$t->name}} 
                          </div>

                        @endforeach
                  </div>   
               </div>

            @endif

             @if($about_role !='')
                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>About Role</h5>
                     </div>
                     <div class="col-lg-11 data">

                           <h6>{!!$about_role!!}</h6>
                       
                     </div>
                  </div>   
               </div>

            @endif

             @if($responsibilities !='')
                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>Responsibilities</h5>
                     </div>
                     <div class="col-lg-11 data">

                           <h6>{!!$responsibilities!!}</h6>
                       
                     </div>
                  </div>   
               </div>

            @endif

                @if($requirement !='')
                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>Requirements</h5>
                     </div>
                     <div class="col-lg-11 data">

                           <h6>{!!$requirement!!}</h6>
                       
                     </div>
                  </div>   
               </div>

            @endif


              @if($skill !='')
                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>Skills Required</h5>
                     </div>
                     <div class="col-lg-11 data">

                           <h6>{!!$skill!!}</h6>
                       
                     </div>
                  </div>   
               </div>

            @endif

             @if($qualifications !='')
                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>Qualifications</h5>
                     </div>
                     <div class="col-lg-11 data">

                           <h6>{!!$qualifications!!}</h6>
                       
                     </div>
                  </div>   
               </div>

            @endif

              @if($tech_experience !='')
                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>Technical Experience</h5>
                     </div>
                     <div class="col-lg-11 data">

                           <h6>{!!$tech_experience!!}</h6>
                       
                     </div>
                  </div>   
               </div>

            @endif

              @if($extra_skills !='')
                <div class="part">
                  <div class="row">
                     <div class="col-lg-12 label">
                        <h5>It would be awesome if</h5>
                     </div>
                     <div class="col-lg-11 data">

                           <h6>{!!$extra_skills!!}</h6>
                       
                     </div>
                  </div>   
               </div>

            @endif



               
        
       
    
      





     
       <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
       <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

       <style type="text/css">
          
          h5{
           
               color: #bb0a1d; 
          }

             .industry{


             width: 11%;
 
             text-align: center;

    padding: 10px;
    color: white;
    background: #787474;
    margin-left: 10px;
         }
       </style>
      
     


@endsection