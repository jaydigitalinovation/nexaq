<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use DB;

class HomeController extends Controller
{

      public function __construct(){

                $this->middleware('auth:admin');
        }

        public function home_banner(){

          $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['admin_name']=$admin[0]->name;

          $banner=DB::table('banner')->paginate(3);
          $data['banner']=$banner;

          $data['industry']=DB::table('industries')->get();

        /*  $more_maintitle=DB::table('more_maintitle')->get();
          $data['more_maintitle']=$more_maintitle;*/

            return view('admin.homepagebanner',$data);
         }


          public function add_home_banner(){

               $id=Auth::id();
               $admin=Admin::where('id',$id)->get();
               $data['admin_name']=$admin[0]->name;

              $data['industry']=DB::table('industries')->get();

           return view('admin.add_home_banner',$data);
 
         }

           public function store_home_banner(Request $request){

            $error=$request->validate([

              'title' => 'required',
              'image' => 'required',
              'heading' => 'required',
               
            ]);
       
                $title=$request->input('title'); 
                $file=$request->file('image');
                $heading=$request->input('heading'); 
                $maintitle=$request->input('short_description');
                $maintitles=$request->input('short_descriptions');

               $imagename='';
        
           if ($file){
          
               $destinationPath='uploads';
               $imagename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$imagename);
       
              }

            DB::table('banner')->insert(['title'=>$title ,'heading'=>$heading ,'image'=>$imagename,'maintitle'=>$maintitle]);

         /*   $last_id = DB::table('banner')->max('id'); 

            $maintitle=$request->input('short_description');

            if($maintitle!=""){

              DB::table('more_maintitle')->insert(['more_maintitle'=>$maintitle,'banner_id'=>$last_id]);

              }

           $maintitles=$request->input('short_descriptions');

            if($maintitles!=null){
            
              for($i=0; $i<count($maintitles); $i++){

                   $maintitles_info=$maintitles[$i];

                   if($maintitles_info!=""){

                   DB::table('more_maintitle')->insert(['more_maintitle'=>$maintitles_info,'banner_id'=>$last_id]);
                }
  
              }
           }*/
           return redirect('admin/home_banner')->with('error',' update banner data succcesfully!!!!');

         }

          public function delete_home_banner($id){

           $banner= DB::table('banner')->where('id', $id)->get();

           if($banner[0]->image!='') {

               unlink(public_path("/uploads/".$banner[0]->image));

               }

           DB::table('banner')->where('id', $id)->delete();

         /*  DB::table('more_maintitle')->where('banner_id', $id)->delete();*/

           return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);

        }


         public function  delete_all_home_banner(Request $request){

                $ids = $request->ids;

                 foreach($ids as $id){

                $banner=DB::table('banner')->where('id',$id)->get();


                  if($banner[0]->image!='') {

                         unlink(public_path("/uploads/".$banner[0]->image));

                      }

                        DB::table('banner')->where('id', $id)->delete();

                 }
  
                return response()->json(['status'=>200]);


               }

               public function update_home_banner($id){


                 $id1=Auth::id();
                 $admin=Admin::where('id',$id1)->get();
                 $data['admin_name']=$admin[0]->name;

                $data['industry']=DB::table('industries')->get();

                 $banner= DB::table('banner')->where('id', $id)->get();
    
                 $data['id']=$banner[0]->id;
                 $data['title']=$banner[0]->title;
                 $data['heading']=$banner[0]->heading;
                 $data['image']=$banner[0]->image;
                 $data['maintitle']=$banner[0]->maintitle;

               /*  $more_maintitle=DB::table('more_maintitle')->where('banner_id', $id)->get();
                 $data['more_maintitle']=$more_maintitle;*/
   
           return view('admin.update_home_banner',$data);

        }

       public function deletemaintitle($id){

          DB::table('more_maintitle')->where('id',$id)->delete();

         return response()->json(['success'=>'maintitle data deleted successfully!!!',]);

        }    

       public function store_update_home_banner(Request $request ,$id){

           $request->validate([

             'title' => 'required',
             'heading' => 'required',
               
           ]);
       
           $title=$request->input('title');
           $file=$request->file('image');
           $heading=$request->input('heading');

           $maintitle=$request->input('short_description');
           
  
           $imagename='';

            if($file){
         
               $destinationPath='uploads';
               $imagename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$imagename);

               DB::table('banner')->where('id', $id)->update(['image'=>$imagename]);

              if($request->input('oldimage')!='') {

                    unlink(public_path("/uploads/".$request->input('oldimage')));  
                 }
              }

            DB::table('banner')->where('id', $id)->update(['title'=>$title ,'heading'=>$heading ,'maintitle'=>$maintitle]);

        /*   if($maintitle!=''){
   
              DB::table('more_maintitle')->insert(['more_maintitle'=>$maintitle,'banner_id'=>$id]);

             }*/
/*
            if($maintitles!=null){
            
              for($i=0; $i<count($maintitles); $i++){

                    $maintitles_info=$maintitles[$i];

                   DB::table('more_maintitle')->insert(['more_maintitle'=>$maintitles_info,'banner_id'=>$id]);
  
                }
            }*/

           return redirect('admin/home_banner')->with('error',' update banner data succcesfully!!!!');
 
          }

          public function achievement(){

          $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['admin_name']=$admin[0]->name;


         $data['industry']=DB::table('industries')->get();

          $achievement=DB::table('achievement')->paginate(10);
          $data['achievement']=$achievement;



      
          return view('admin.achievements',$data);



          }

          public function add_achievement(){

          $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['admin_name']=$admin[0]->name; 

         $data['industry']=DB::table('industries')->get();
   
          return view('admin.add_achievement',$data);


          }

            public function store_achievement(Request $request){

            $error=$request->validate([

              'title' => 'required',
              'number' => 'required',
              'area' => 'required',  
               
            ]);
       
                $title=$request->input('title'); 
                $number=$request->input('number');    
                $area=$request->input('area'); 
         

            DB::table('achievement')->insert(['title'=>$title ,'number'=>$number,'area'=>$area]);

       
           return redirect('admin/achievement')->with('error',' Achievement data insert succcesfully!!!!');

         }

         public function update_achievement($id){

             $id1=Auth::id();
             $admin=Admin::where('id',$id1)->get();
             $data['admin_name']=$admin[0]->name;

             $data['industry']=DB::table('industries')->get();

             $achievement= DB::table('achievement')->where('id', $id)->get();

             $data['id']=$achievement[0]->id;
             $data['title']=$achievement[0]->title;
             $data['number']=$achievement[0]->number;
             $data['area']=$achievement[0]->area;
          
            
           return view('admin.update_achievement',$data);



         }

         public function store_update_achievement(Request $request, $id){


             $error=$request->validate([

              'title' => 'required',
              'number' => 'required',
              'area' => 'required',  
               
            ]);
       
                $title=$request->input('title'); 
                $number=$request->input('number');    
                $area=$request->input('area'); 
         

            DB::table('achievement')->update(['title'=>$title ,'number'=>$number,'area'=>$area]);

       
           return redirect('admin/achievement')->with('error',' Achievement data update succcesfully!!!!');


         }

         public function delete_achievement($id){


           DB::table('achievement')->where('id',$id)->delete();

           return response()->json(['success'=>'achievement data deleted successfully!!!',]);


         }

         public function delete_all_achievement(Request $request){

                 $ids = $request->ids;

                foreach($ids as $id){

                 DB::table('achievement')->where('id',$id)->delete();

                 }
  
               return response()->json(['status'=>200]);

         }


           public function testimonials(){

          $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['admin_name']=$admin[0]->name;

          $data['industry']=DB::table('industries')->get();

          $testimonials=DB::table('testimonials')->paginate(10);
          $data['testimonials']=$testimonials;

      
          return view('admin.testimonials',$data);



          }

          public function add_testimonials(){

          $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['admin_name']=$admin[0]->name;

           $data['industry']=DB::table('industries')->get();
   
          return view('admin.add_testimonials',$data);


          }

          public function store_testimonials(Request $request){


              $error=$request->validate([

            
              'image' => 'required',
              'name' => 'required',
              'description' => 'required',
              'address'=>'required',
               
            ]);
       
           
                $file=$request->file('image');
                $name=$request->input('name'); 
                $description=$request->input('description');
                $address=$request->input('address');
              
               $imagename='';
        
           if ($file){
          
               $destinationPath='uploads';
               $imagename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$imagename);
       
              }

            DB::table('testimonials')->insert(['name'=>$name ,'description'=>$description ,'address'=>$address ,'image'=>$imagename]);

           return redirect('admin/testimonials')->with('error',' Testimonial data insert succcesfully!!!!');

          }

          public function update_testimonials($id){


             $id1=Auth::id();
             $admin=Admin::where('id',$id1)->get();
             $data['admin_name']=$admin[0]->name;

             $data['industry']=DB::table('industries')->get();

             $testimonials= DB::table('testimonials')->where('id', $id)->get();

             $data['id']=$testimonials[0]->id;
             $data['name']=$testimonials[0]->name;
             $data['image']=$testimonials[0]->image;
             $data['description']=$testimonials[0]->description;
             $data['address']=$testimonials[0]->address;
          
            
           return view('admin.update_testimonials',$data);


          }

          public function store_update_testimonials(Request $request,$id){



             $error=$request->validate([
          
             

             
               'name' => 'required',
               'description' => 'required',
               'address' => 'required',
               
            ]);

           
                $file=$request->file('image');
                $name=$request->input('name'); 
                $description=$request->input('description');
                $address=$request->input('address');


                $imagename='';

               if($file){
         
                   $destinationPath='uploads';
                   $imagename=time().'_'.$file->getClientOriginalName();
                   $file->move($destinationPath,$imagename);

                   DB::table('testimonials')->where('id', $id)->update(['image'=>$imagename]);

                  if($request->input('oldimage')!='') {

                        unlink(public_path("/uploads/".$request->input('oldimage')));  
                     }
                  }

             DB::table('testimonials')->where('id', $id)->update(['name'=>$name ,'description'=>$description,'address'=>$address]);

             return redirect('admin/testimonials')->with('error',' Testimonial data updated succcesfully!!!!');

              
          }

          public function delete_testimonials($id){

           $testimonials= DB::table('testimonials')->where('id', $id)->get();

            if($testimonials[0]->image!='') {

               unlink(public_path("/uploads/".$testimonials[0]->image));

             }

           DB::table('testimonials')->where('id', $id)->delete();

           return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);


          }

          public function delete_all_testimonials(Request $request){


                $ids = $request->ids;

                foreach($ids as $id){

                $testimonials=DB::table('testimonials')->where('id',$id)->get();


                  if($testimonials[0]->image!='') {

                         unlink(public_path("/uploads/".$testimonials[0]->image));

                      }

                        DB::table('testimonials')->where('id', $id)->delete();

                 }
  
               return response()->json(['status'=>200]);


          }
          public function our_clients(){


            $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['admin_name']=$admin[0]->name;

         $data['industry']=DB::table('industries')->get();

         $data['clients']=DB::table('clients')->get();
   
          return view('admin.our_clients',$data);


    
          }

           public function add_clients(){


          $id1=Auth::id();
          $admin=Admin::where('id',$id1)->get();
          $data['admin_name']=$admin[0]->name;

          $data['industry']=DB::table('industries')->get();

            return view('admin.add_clients',$data);


          }



            public function store_clients(Request $request){


            $request->validate([
          
             'image' => 'required',
          
               
              ]);


               $file=$request->file('image');
              
                 $filename='';


              if($file !=''){
           
             foreach($file as $key =>$f) {

                 $destinationPath='uploads';
                 $filename=time().'_'.$f->getClientOriginalName();
       
                  $f->move($destinationPath,$filename);

                   DB::table('clients')->insert(['image'=>$filename]);  
                 
               }

                return redirect('admin/our_clients')->with('error','data inserted successfully');  



              }else{

                 return redirect('admin/our_clients');

              }

        

          }



          public function delete_clients($id){


           $clients= DB::table('clients')->where('id', $id)->get();

           if($clients[0]->image!='') {

               unlink(public_path("/uploads/".$clients[0]->image));

               }

           DB::table('clients')->where('id', $id)->delete();

           return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);

            
          }


         


          public function delete_all_clients(Request $request){


                $ids = $request->ids;

                foreach($ids as $id){

                $clients=DB::table('clients')->where('id',$id)->get();


                  if($clients[0]->image!='') {

                         unlink(public_path("/uploads/".$clients[0]->image));

                      }

                        DB::table('clients')->where('id', $id)->delete();

                 }
  
               return response()->json(['status'=>200]);


          }

            public function services(){


         $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();

     $data['service_description']=DB::table('service_description')->get();

     $data['service']=DB::table('service')->get();


        return view('admin.services',$data);


    }

   public function add_service(){

     $id1=Auth::id();
     $admin=Admin::where('id',$id1)->get();
     $data['admin_name']=$admin[0]->name;

    $data['industry']=DB::table('industries')->get();

       return view ('admin.add_service',$data);
   }

   public function store_service(Request $request){

      $request->validate([

             'title' => 'required',
             'image' => 'required',
             'description' => 'required',
               
           ]);


         $title=$request->input('title');
         $description=$request->input('description');
         $file=$request->file('image');

         $imagename='';
        
           if($file){
          
               $destinationPath='uploads';
               $imagename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$imagename);
       
              }

        DB::table('service')->insert(['title'=>$title,'image'=>$imagename,'description'=>$description]); 

        return redirect('admin/services')->with('error','data inserted successfully');  
     
     }

     public function update_service($id){


         $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();


           $service=DB::table('service')->where('id',$id)->get();
            $data['id']=$service[0]->id;
            $data['image']=$service[0]->image;
            $data['title']=$service[0]->title;
            $data['description']=$service[0]->description;

            return view('admin.update_service',$data);


       }

       public function store_update_service(Request $request, $id){


           $request->validate([

             'title' => 'required',
             'description' => 'required',
               
           ]);


         $title=$request->input('title');
         $description=$request->input('description');
         $file=$request->file('image');


          $imagename='';

            if($file){
         
               $destinationPath='uploads';
               $imagename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$imagename);

               DB::table('service')->where('id', $id)->update(['image'=>$imagename]);

              if($request->input('oldimage')!='') {

                    unlink(public_path("/uploads/".$request->input('oldimage')));  
                 }
              }


         DB::table('service')->where('id',$id)->update(['title'=>$title,'description'=>$description]); 

        return redirect('admin/services')->with('error','data updated successfully');  
 
       }

       public function delete_service($id){


           $service= DB::table('service')->where('id', $id)->get();

           if($service[0]->image!='') {

               unlink(public_path("/uploads/".$service[0]->image));

               }

           DB::table('service')->where('id', $id)->delete();

           return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);



       }

       public function update_service_desc($id){


         $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();


           $service_description=DB::table('service_description')->where('id',$id)->get();

           $data['title']=$service_description[0]->title;
           $data['id']=$service_description[0]->id;
           $data['description']=$service_description[0]->description;

           return view('admin.update_service_desc',$data);


       }

       public function store_update_service_desc(Request $request,$id){


           $request->validate([

             'title' => 'required',
             'description' => 'required',
               
           ]);


         $title=$request->input('title');
         $description=$request->input('description');
      


         DB::table('service_description')->where('id',$id)->update(['title'=>$title,'description'=>$description]); 

        return redirect('admin/services')->with('error','data updated successfully'); 



       }


   public function industries (){


         $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

   
      $data['industry']=DB::table('industries')->get();

        $data['industries_desc']=DB::table('industries_desc')->get();

        $data['industries']=DB::table('industries')->get();
  

        return view('admin.industries',$data);


    }


     public function update_industries_desc($id){


         $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

          $data['industry']=DB::table('industries')->get();

           $industries_desc=DB::table('industries_desc')->where('id',$id)->get();

           $data['title']=$industries_desc[0]->title;
           $data['id']=$industries_desc[0]->id;
           $data['description']=$industries_desc[0]->description;

           return view('admin.update_industries_desc',$data);


       }

       public function store_update_industries_desc(Request $request,$id){


           $request->validate([

             'title' => 'required',
             'description' => 'required',
               
           ]);


         $title=$request->input('title');
         $description=$request->input('description');
      


         DB::table('industries_desc')->where('id',$id)->update(['title'=>$title,'description'=>$description]); 

        return redirect('admin/industries')->with('error','data updated successfully'); 



       }

         public function add_industries(){


         $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;     

        $data['industry']=DB::table('industries')->get();


       return view ('admin.add_industries',$data);
   }

   public function store_industries(Request $request){

      $request->validate([

             'title' => 'required',
             'image' => 'required',
             'description' => 'required',
               
           ]);


         $title=$request->input('title');
         $description=$request->input('description');
         $file=$request->file('image');

         $imagename='';
        
           if($file){
          
               $destinationPath='uploads';
               $imagename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$imagename);
       
              }

         DB::table('industries')->insert(['title'=>$title,'image'=>$imagename,'description'=>$description]); 

          $last_id= DB::table('industries')->max('id');

        DB::table('banner_image')->insert(['name'=>$title, 'image'=>'','page_name'=>$title]);  

         DB::table('industry_desc')->insert(['title'=>'What is Lorem Ipsum?','description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.','industry_id'=>$last_id]);  

    

        return redirect('admin/industries')->with('error','data inserted successfully');  
     
     }

        public function update_industries($id){


             $id1=Auth::id();
             $admin=Admin::where('id',$id1)->get();
             $data['admin_name']=$admin[0]->name;

          $data['industry']=DB::table('industries')->get();

           $industries=DB::table('industries')->where('id',$id)->get();
            $data['id']=$industries[0]->id;
            $data['image']=$industries[0]->image;
            $data['title']=$industries[0]->title;
            $data['description']=$industries[0]->description;

            return view('admin.update_industries',$data);


       }

       public function store_update_industries(Request $request, $id){


           $request->validate([

             'title' => 'required',
             'description' => 'required',
               
           ]);


         $title=$request->input('title');
         $description=$request->input('description');
         $file=$request->file('image');


          $imagename='';

            if($file){
         
               $destinationPath='uploads';
               $imagename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$imagename);

               DB::table('industries')->where('id', $id)->update(['image'=>$imagename]);

              if($request->input('oldimage')!='') {

                    unlink(public_path("/uploads/".$request->input('oldimage')));  
                 }
              }


         DB::table('industries')->where('id',$id)->update(['title'=>$title,'description'=>$description]); 

        return redirect('admin/industries')->with('error','data updated successfully');  
 
       }

       public function delete_industries($id){


           $industries= DB::table('industries')->where('id', $id)->get();

           if($industries[0]->image!='') {

               unlink(public_path("/uploads/".$industries[0]->image));

               }

           DB::table('industries')->where('id', $id)->delete();

           return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);

         }


         public function our_partners(){


          $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['admin_name']=$admin[0]->name;

           $data['industry']=DB::table('industries')->get();

           $data['partners']=DB::table('partners')->get();
   
          return view('admin.our_partners',$data);

          }

           public function add_partners(){


             $id1=Auth::id();
             $admin=Admin::where('id',$id1)->get();
             $data['admin_name']=$admin[0]->name;

            $data['industry']=DB::table('industries')->get();

            return view('admin.add_partners',$data);


          }

        public function store_partners(Request $request){


            $request->validate([
          
             'image' => 'required',
          
               
              ]);


               $file=$request->file('image');
              
                 $filename='';


              if($file !=''){
           
             foreach($file as $key =>$f) {

                 $destinationPath='uploads';
                 $filename=time().'_'.$f->getClientOriginalName();
       
                  $f->move($destinationPath,$filename);

                   DB::table('partners')->insert(['image'=>$filename]);  
                 
               }

                return redirect('admin/our_partners')->with('error','data inserted successfully');  


              }else{

                 return redirect('admin/our_partners');

              }

          }

          public function delete_partners($id){


           $partners= DB::table('partners')->where('id', $id)->get();

           if($partners[0]->image!='') {

               unlink(public_path("/uploads/".$partners[0]->image));

               }

           DB::table('partners')->where('id', $id)->delete();

           return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);

            
          }

          public function delete_all_partners(Request $request){


                $ids = $request->ids;

                foreach($ids as $id){

                $partners=DB::table('partners')->where('id',$id)->get();


                  if($partners[0]->image!='') {

                         unlink(public_path("/uploads/".$partners[0]->image));

                      }

                        DB::table('partners')->where('id', $id)->delete();

                 }
  
               return response()->json(['status'=>200]);


          }







    public function home_about(){

        $data['industry']=DB::table('industries')->get();

        $home_about_data=DB::table('home_about')->get();

        $data['home_about_data']=$home_about_data;

        $home_about_description_data=DB::table('home_about_description')->get();

        $data['home_about_description_data']=$home_about_description_data;

        return view('admin.home_about',$data);
    }


    public function update_home_about_description_data($id){

        $data['industry']=DB::table('industries')->get();
        
            $home_about_description=DB::table('home_about_description')->where('id',$id)->get();

            $data['id']=$home_about_description[0]->id;

            $data['description']=$home_about_description[0]->description;
        

        return view('admin.update_home_about_description_data',$data);
    }


    public function store_update_home_about_description_data(Request $request,$id){

        $validated=$request->validate([
            'description'=>'required',
        ]);


            $description=$request->input('description');

            
            DB::table('home_about_description')->where('id',$id)->update(['description'=>$description ]);

            return redirect('/admin/home_about')->with('error','data updated successfully!!');
        
    }


    public function add_home_about_data($id){

        $data['industry']=DB::table('industries')->get();
        
        if($id==0){

            $data['name']='';

            $data['count']='';

            $data['id']=$id;
        }
        else{

            $home_about=DB::table('home_about')->where('id',$id)->get();

            $data['id']=$home_about[0]->id;

            $data['count']=$home_about[0]->count;

            $data['name']=$home_about[0]->name;
        }

        return view('admin.add_home_about_data',$data);
    }


    public function store_add_home_about_data(Request $request,$id){

        $validated=$request->validate([
            'count'=>'required',
            'name'=>'required',
        ]);

        if($id ==0){

            $count=$request->input('count');

            $name=$request->input('name');

            DB::table('home_about')->insert([ 'name'=>$name ,'count'=>$count]);

            return redirect('/admin/home_about')->with('error','data submitted successfully!!');
        }

        else{

            $count=$request->input('count');

            $name=$request->input('name');
            
            DB::table('home_about')->where('id',$id)->update(['name'=>$name ,'count'=>$count]);

            return redirect('/admin/home_about')->with('error','data updated successfully!!');
        }
    }

    

    public function delete_home_about($id){

        DB::table('home_about')->where('id',$id)->delete();

        return response()->json([
            'success'=>'Record has been deleted successfully!',
        ]);
    }




    public function home_insight(){

        $data['industry']=DB::table('industries')->get();

        $home_insight_data=DB::table('home_insight')->get();

        $data['home_insight_data']=$home_insight_data;

        return view('admin.home_insight',$data);
    }

    public function add_home_insight_data($id){

        $data['industry']=DB::table('industries')->get();
        
        if($id==0){

            $data['image']='';

            $data['title']='';

            $data['id']=$id;
        }
        else{

            $home_insight=DB::table('home_insight')->where('id',$id)->get();

            $data['id']=$home_insight[0]->id;

            $data['image']=$home_insight[0]->image;

            $data['title']=$home_insight[0]->title;
        }

        return view('admin.add_home_insight_data',$data);
    }


    public function store_add_home_insight_data(Request $request,$id){

        

        if($id ==0){

            $validated=$request->validate([
                'title'=>'required',
                'image'=>'required',
            ]);

            $title=$request->input('title');

            $file=$request->file('image');

            $imagename='';

            if($file !=''){

                $destination_path='uploads';

                $imagename=time().'_'.$file->getClientOriginalName();

                $file->move($destination_path,$imagename);

            }

            DB::table('home_insight')->insert(['image'=>$imagename,'title'=>$title]);

            return redirect('/admin/home_insight')->with('error','data submitted successfully!!');
        }

        else{

            $validated=$request->validate([
                'title'=>'required',
            ]);

            $title=$request->input('title');

            $file=$request->file('image');

            $oldimage=$request->input('oldimage');

            $imagename='';

            if($file !=''){

                $destination_path='uploads';

                $imagename=time().'_'.$file->getClientOriginalName();

                $file->move($destination_path,$imagename);

                if($oldimage !=''){

                    unlink(public_path('/uploads/'.$oldimage));
                }

                DB::table('home_insight')->where('id',$id)->update(['image'=>$imagename ]);

            }
            
            DB::table('home_insight')->where('id',$id)->update(['title'=>$title]);

            return redirect('/admin/home_insight')->with('error','data updated successfully!!');
        }
    }

    

    public function delete_home_insight($id){

        $userdata=DB::table('home_insight')->where('id',$id)->get();

        $image=$userdata[0]->image;

        if($image !=''){

            unlink(public_path('/uploads/'.$image));
        }

        DB::table('home_insight')->where('id',$id)->delete();

        return response()->json([
            'success'=>'200',
        ]);
    }


       
}
