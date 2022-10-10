<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\Models\Admin; 

class AboutusController extends Controller
{
    
      public function __construct(){

                $this->middleware('auth:admin');
        }

        public function aboutus_banner(){

          $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['admin_name']=$admin[0]->name;

           $data['industry']=DB::table('industries')->get();

          $data['aboutus_banner']=DB::table('banner_image')->where('name','About Us')->get();

            return view('admin.aboutus_banner',$data);

       }

         public function update_banner_image($id){

          $aboutus_banner=DB::table('banner_image')->where('id',$id)->get();

         $data['industry']=DB::table('industries')->get();


          $data['image']=$aboutus_banner[0]->image;
          $data['name']=$aboutus_banner[0]->name;
          $data['page_name']=$aboutus_banner[0]->page_name;
          $data['id']=$aboutus_banner[0]->id;

           return view('admin.update_banner_image',$data);


       }

       public function store_banner_image(Request $request, $id){


          $error=$request->validate([

              'name' => 'required',
            
               
            ]);


              $file=$request->file('image');
              $name=$request->input('name');

            echo  $page_name=$request->input('page_name');

             $title='';

             $index=DB::table('industries')->where('title',$page_name)->get();

             if(count($index)>0){

              $title=$index[0]->title;

              $id_ins=$index[0]->id;

               }


            $service_index=DB::table('main_services')->where('name',$page_name)->get();

             if(count($service_index)>0){

              $service_title=$service_index[0]->name;

              $service_id=$service_index[0]->id;

               }


          
           $imagename='';

            if($file){
         
               $destinationPath='uploads';
               $imagename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$imagename);

               DB::table('banner_image')->where('id', $id)->update(['image'=>$imagename]);

              if($request->input('oldimage')!='') {

                    unlink(public_path("/uploads/".$request->input('oldimage')));  
                 }
              }

            DB::table('banner_image')->where('id', $id)->update(['page_name'=>$name]);

                if($page_name=='About Us'){

               return redirect('admin/aboutus_banner')->with('error',' update banner data succcesfully!!!!');

            }else if($page_name=='Career'){

                 return redirect('admin/career_banner')->with('error',' update banner data succcesfully!!!!');

            }else if($page_name=='Talent Areas'){

                 return redirect('admin/talent_area')->with('error',' update banner data succcesfully!!!!');


            }else if($page_name=='Hiring Process'){

                 return redirect('admin/hiring_process')->with('error',' update banner data succcesfully!!!!');


            }else if($page_name=='Services'){

              return redirect('admin/service_type')->with('error',' update banner data succcesfully!!!!');   

            }else if(strcasecmp($page_name,$title) ==0){

              return redirect('admin/industries_detail/'.$id_ins)->with('error',' update banner data succcesfully!!!!');

            }else if(strcasecmp($page_name,$service_title) ==0){

              return redirect('admin/sub_service/'.$service_id)->with('error',' update banner data succcesfully!!!!');

            }
       }

       public function aboutus(){
                
         $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();


         $data['aboutus']=DB::table('aboutus')->get();

            return view('admin.aboutus',$data);

       }

       public function update_aboutus($id){

           $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();



         $aboutus=DB::table('aboutus')->where('id',$id)->get();

         $data['id']=$aboutus[0]->id;
         $data['image']=$aboutus[0]->image;
         $data['image1']=$aboutus[0]->image1;
         $data['title']=$aboutus[0]->title;
         $data['experience']=$aboutus[0]->experience;
         $data['description']=$aboutus[0]->description;

         return view('admin.update_aboutus',$data);



       }

       public function store_update_aboutus(Request $request, $id){

          $error=$request->validate([

              'title' => 'required',
              'experience' => 'required',
              'description' => 'required',
                   
            ]);

            $title=$request->input('title');
            $experience=$request->input('experience');
            $description=$request->input('description');

            $file1=$request->file('image');
            $file2=$request->file('image1');

            $filename1='';

              if($file1){
         
               $destinationPath='uploads';
               $filename1=time().'_'.$file1->getClientOriginalName();
               $file1->move($destinationPath,$filename1);

               DB::table('aboutus')->where('id', $id)->update(['image'=>$filename1]);

              if($request->input('oldimage')!='') {

                    unlink(public_path("/uploads/".$request->input('oldimage')));  
                 }
              }


                $filename2='';

              if($file2){
         
               $destinationPath='uploads';
               $filename2=time().'_'.$file2->getClientOriginalName();
               $file2->move($destinationPath,$filename2);

               DB::table('aboutus')->where('id', $id)->update(['image1'=>$filename2]);

              if($request->input('oldimage1')!='') {

                    unlink(public_path("/uploads/".$request->input('oldimage1')));  
                 }
              }


              DB::table('aboutus')->where('id', $id)->update(['title'=>$title,'experience'=>$experience,'description'=>$description]);

              return redirect('admin/aboutus')->with('error',' update data succcesfully!!!!');


       }

       public function  mission_vision(){

           $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();


          $data['mission_vision']=DB::table('mission_vision')->get();

          return view('admin.mission_vision',$data);


       }

       public function update_mission_vision($id){

           $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();


        $mission_vision=DB::table('mission_vision')->where('id',$id)->get();

         $data['id']=$mission_vision[0]->id;
        
         $data['title']=$mission_vision[0]->title;

         $data['description']=$mission_vision[0]->description;

         return view('admin.update_mission_vision',$data);


       }


         public function store_mission_vision(Request $request, $id){



          $error=$request->validate([

              'title' => 'required',
   
              'description' => 'required',
            
               
            ]);

            $title=$request->input('title');

            $description=$request->input('description');


              DB::table('mission_vision')->where('id', $id)->update(['title'=>$title,'description'=>$description]);

              return redirect('admin/mission_vision')->with('error','data updated succcesfully!!!!');


       }

       public function solutions(){

           $id1=Auth::id();
           $admin=Admin::where('id',$id1)->get();
           $data['admin_name']=$admin[0]->name;
   
           $data['industry']=DB::table('industries')->get();

           $data['solutions_desc']=DB::table('solution_desc')->get();

           $data['solutions']=DB::table('solutions')->get();


          return view('admin.solutions',$data);



       }

          public function update_solutions_desc($id){

            $id1=Auth::id();
           $admin=Admin::where('id',$id1)->get();
           $data['admin_name']=$admin[0]->name;

          $data['industry']=DB::table('industries')->get();

           $solutions_desc=DB::table('solution_desc')->where('id',$id)->get();

           $data['title']=$solutions_desc[0]->title;
           $data['id']=$solutions_desc[0]->id;
           $data['description']=$solutions_desc[0]->description;

           return view('admin.update_solutions_desc',$data);


       }

       public function store_solutions_desc(Request $request,$id){


           $request->validate([

             'title' => 'required',
             'description' => 'required',
               
           ]);


         $title=$request->input('title');
         $description=$request->input('description');
      

         DB::table('solution_desc')->where('id',$id)->update(['title'=>$title,'description'=>$description]); 

        return redirect('admin/solutions')->with('error','data updated successfully'); 

       }

       public function add_solutions($id){

           $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();


            if($id==0){

                $data['title']='';
                $data['description']='';

                $data['id']=0;

              }else{

                $solutions=DB::table('solutions')->where('id',$id)->get();
                $data['title']=$solutions[0]->title;
                $data['description']=$solutions[0]->description;

                $data['id']=$solutions[0]->id;

              } 

         return view('admin.add_solutions',$data);

       }

       public function store_solutions(Request $request,$id){


          $request->validate([

             'title' => 'required',
             'description' => 'required',
               
           ]);


         $title=$request->input('title');
         $description=$request->input('description');

         if($id==0){

             DB::table('solutions')->insert(['title'=>$title,'description'=>$description]); 

              return redirect('admin/solutions')->with('error','data insert successfully'); 


           }else{


             DB::table('solutions')->where('id',$id)->update(['title'=>$title,'description'=>$description]); 

             return redirect('admin/solutions')->with('error','data updated successfully'); 

           }
      

       }

       public function delete_solutions($id){

        
           DB::table('solutions')->where('id', $id)->delete();

           return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);


       }

       public function features(){

           $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();


        $data['features_desc']=DB::table('features_desc')->get();

        $data['features']=DB::table('features')->get();

        return view('admin.features',$data);


       }


          public function update_features_desc($id){

               $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();



           $features_desc=DB::table('features_desc')->where('id',$id)->get();

           $data['title']=$features_desc[0]->title;
            $data['image']=$features_desc[0]->image;
           $data['id']=$features_desc[0]->id;
           $data['description']=$features_desc[0]->description;

           return view('admin.update_features_desc',$data);


       }


       public function store_features_desc(Request $request,$id)
         {

           $error=$request->validate([

              'title' => 'required',
              'description' => 'required',
            
               
            ]);

            $title=$request->input('title');
            $description=$request->input('description');

            $file=$request->file('image');
         
            $filename='';

              if($file){
         
               $destinationPath='uploads';
               $filename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$filename);

               DB::table('features_desc')->where('id', $id)->update(['image'=>$filename]);

              if($request->input('oldimage')!='') {

                    unlink(public_path("/uploads/".$request->input('oldimage')));  
                 }
              }

              DB::table('features_desc')->where('id', $id)->update(['title'=>$title,'description'=>$description]);

              return redirect('admin/features')->with('error',' update data succcesfully!!!!');


         }

         public function add_features($id){

               $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();



             if($id==0){

                $data['title']='';
                $data['icon']='';
                $data['description']='';

                $data['id']=0;

              }else{


                $features=DB::table('features')->where('id',$id)->get();

                $data['title']=$features[0]->title;
                $data['description']=$features[0]->description;
                $data['icon']=$features[0]->icon;
                $data['id']=$features[0]->id;

              } 

            return view('admin.add_features',$data);



         }

         public function store_features(Request $request,$id){

                 $request->validate([

                   'title' => 'required',
                    'icon' => 'required',
                   'description' => 'required',
                     
                 ]);


               $title=$request->input('title');
                $icon=$request->input('icon');
               $description=$request->input('description');

               if($id==0){

                   DB::table('features')->insert(['icon'=>$icon,'title'=>$title,'description'=>$description]); 

                    return redirect('admin/features')->with('error','data insert successfully'); 


                 }else{


                   DB::table('features')->where('id',$id)->update(['icon'=>$icon,'title'=>$title,'description'=>$description]); 

                   return redirect('admin/features')->with('error','data updated successfully'); 

                 }


          }

          public function delete_features($id){

            DB::table('features')->where('id',$id)->delete();


               return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);



          }

          public function team(){

               $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();


            $data['team_desc']=DB::table('team_desc')->get();

            $data['team']=DB::table('team')->get();

            return view('admin.team',$data);


          }


           public function update_team_desc($id){

               $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();



           $team_desc=DB::table('team_desc')->where('id',$id)->get();

           $data['title']=$team_desc[0]->title;
           $data['id']=$team_desc[0]->id;
           $data['description']=$team_desc[0]->description;

           return view('admin.update_team_desc',$data);


       }


       public function store_team_desc(Request $request,$id)
         {

           $error=$request->validate([

              'title' => 'required',
              'description' => 'required',
            
               
            ]);

            $title=$request->input('title');
            $description=$request->input('description');

           
              DB::table('team_desc')->where('id', $id)->update(['title'=>$title,'description'=>$description]);

              return redirect('admin/team')->with('error',' update data succcesfully!!!!');


         }

         public function add_team($id){

               $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();



             if($id==0){

                $data['image']='';
                $data['name']='';
                $data['occupation']='';
                $data['fb_url']='';
                $data['insta_url']='';
                $data['twitter_url']='';
                

                $data['id']=0;

              }else{


                $team=DB::table('team')->where('id',$id)->get();

                $data['image']=$team[0]->image;
                $data['name']=$team[0]->name;
                $data['occupation']=$team[0]->occupation;
                $data['fb_url']=$team[0]->fb_url;
                $data['insta_url']=$team[0]->insta_url;
                $data['twitter_url']=$team[0]->twitter_url;
                $data['id']=$team[0]->id;

              } 

            return view('admin.add_team',$data);

         }

         public function store_team(Request $request,$id){



               $name=$request->input('name');
               $occupation=$request->input('occupation');
               $file=$request->file('image');

               $fb_url=$request->input('fb_url');
               $insta_url=$request->input('insta_url');
               $twitter_url=$request->input('twitter_url');
           

               if($id==0){

               $request->validate([

                    'name' => 'required',
                    'occupation' => 'required',
                    'image' => 'required',
                     
                 ]);


                 $imagename='';
         
                if($file){
          
                   $destinationPath='uploads';
                   $imagename=time().'_'.$file->getClientOriginalName();
                   $file->move($destinationPath,$imagename);
       
                  }

                DB::table('team')->insert(['image'=>$imagename,'name'=>$name,'occupation'=>$occupation,'fb_url'=>$fb_url,'insta_url'=>$insta_url,'twitter_url'=>$twitter_url]); 

                    return redirect('admin/team')->with('error','data insert successfully'); 


                 }else{


                   $request->validate([

                    'name' => 'required',
                    'occupation' => 'required',
                   
                     
                 ]);


                $imagename='';

               if($file){
         
                   $destinationPath='uploads';
                   $imagename=time().'_'.$file->getClientOriginalName();
                   $file->move($destinationPath,$imagename);

                   DB::table('team')->where('id', $id)->update(['image'=>$imagename]);

                  if($request->input('oldimage')!='') {

                        unlink(public_path("/uploads/".$request->input('oldimage')));  
                     }
                  }


                   DB::table('team')->where('id',$id)->update(['name'=>$name,'occupation'=>$occupation,'fb_url'=>$fb_url,'insta_url'=>$insta_url,'twitter_url'=>$twitter_url]);  

                   return redirect('admin/team')->with('error','data updated successfully'); 

                 }

         }

         public function delete_team($id)
         {
            $team= DB::table('team')->where('id', $id)->get();

            if($team[0]->image!='') {

               unlink(public_path("/uploads/".$team[0]->image));

             }

           DB::table('team')->where('id', $id)->delete();

           return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);


         }

         
//new         new         new         new         new         new         new         new         new         new         new         new         new         new         new         new         new         new         new   






         public function aboutus_service(){

            $data['industry']=DB::table('industries')->get();

            $aboutus_service_data=DB::table('aboutus_service')->get();

            $data['aboutus_service_data']=$aboutus_service_data;

            $aboutus_service_description_data=DB::table('aboutus_service_description')->get();

            $data['aboutus_service_description_data']=$aboutus_service_description_data;

            return view('admin.aboutus_service',$data);
        }


        public function update_aboutus_service_description_data($id){

            $data['industry']=DB::table('industries')->get();
            
                $aboutus_service_description=DB::table('aboutus_service_description')->where('id',$id)->get();

                $data['id']=$aboutus_service_description[0]->id;

                $data['title']=$aboutus_service_description[0]->title;

                $data['description']=$aboutus_service_description[0]->description;
            

            return view('admin.update_aboutus_service_description_data',$data);
        }


        public function store_update_aboutus_service_description_data(Request $request,$id){

            $validated=$request->validate([
                'title'=>'required',
                'description'=>'required',
            ]);


                $title=$request->input('title');

                $description=$request->input('description');

                
                DB::table('aboutus_service_description')->where('id',$id)->update(['description'=>$description ,'title'=>$title]);

                return redirect('/admin/aboutus_service')->with('error','data updated successfully!!');
            
        }


        public function add_aboutus_service_data($id){

            $data['industry']=DB::table('industries')->get();
            
            if($id==0){

                $data['image']='';

                $data['description']='';

                $data['title']='';

                $data['id']=$id;
            }
            else{

                $aboutus_service=DB::table('aboutus_service')->where('id',$id)->get();

                $data['id']=$aboutus_service[0]->id;

                $data['image']=$aboutus_service[0]->image;

                $data['title']=$aboutus_service[0]->title;

                $data['description']=$aboutus_service[0]->description;
            }

            return view('admin.add_aboutus_service_data',$data);
        }


        public function store_add_aboutus_service_data(Request $request,$id){

            $validated=$request->validate([
                'title'=>'required',
                'description'=>'required',
            ]);

            if($id ==0){

                $title=$request->input('title');

                $description=$request->input('description');

                $file=$request->file('image');

                $imagename='';

                if($file !=''){

                    $destination_path='uploads';

                    $imagename=time().'_'.$file->getClientOriginalName();

                    $file->move($destination_path,$imagename);

                }

                DB::table('aboutus_service')->insert(['image'=>$imagename, 'description'=>$description ,'title'=>$title]);

                return redirect('/admin/aboutus_service')->with('error','data submitted successfully!!');
            }

            else{

                $title=$request->input('title');

                $description=$request->input('description');

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

                    DB::table('aboutus_service')->where('id',$id)->update(['image'=>$imagename ]);

                }
                
                DB::table('aboutus_service')->where('id',$id)->update(['description'=>$description ,'title'=>$title]);

                return redirect('/admin/aboutus_service')->with('error','data updated successfully!!');
            }
        }

        

        public function delete_aboutus_service($id){

            $userdata=DB::table('aboutus_service')->where('id',$id)->get();

            $image=$userdata[0]->image;

            if($image !=''){

                unlink(public_path('/uploads/'.$image));
            }

            DB::table('aboutus_service')->where('id',$id)->delete();

            return response()->json([
                'success'=>'200',
            ]);
        }

}
