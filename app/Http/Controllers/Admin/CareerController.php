<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\Models\Admin; 

class CareerController extends Controller
{
     public function __construct(){

                $this->middleware('auth:admin');
        }

        public function career_banner(){

          $id=Auth::id();
          $admin=Admin::where('id',$id)->get();
          $data['admin_name']=$admin[0]->name;

         $data['industry']=DB::table('industries')->get();


         $aboutus_banner=DB::table('banner_image')->where('name','Career')->get();

         $data['aboutus_banner']=$aboutus_banner;


          return view('admin.career_banner',$data);

       }

       public function Career(){

           $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();

          $data['career_desc']=DB::table('career_desc')->get();

           $data['career_aboutus']=DB::table('career_aboutus')->get();

           return view('admin.career',$data);

        
       }

       public function update_career_desc($id){

           $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();


          $career_desc=DB::table('career_desc')->where('id',$id)->get();


           $data['title']=$career_desc[0]->title;
           $data['id']=$career_desc[0]->id;
           $data['description']=$career_desc[0]->description;

           return view('admin.update_career_desc',$data);



       }

          public function store_career_desc(Request $request,$id){


           $request->validate([

             'title' => 'required',
             'description' => 'required',
               
           ]);


         $title=$request->input('title');
         $description=$request->input('description');
      

         DB::table('career_desc')->where('id',$id)->update(['title'=>$title,'description'=>$description]); 

         return redirect('admin/career')->with('error','data updated successfully'); 

       }

       public function add_career_aboutus($id){

           $id1=Auth::id();
         $admin=Admin::where('id',$id1)->get();
         $data['admin_name']=$admin[0]->name;

        $data['industry']=DB::table('industries')->get();


            if($id==0){

                $data['title']='';
                $data['image']='';

                $data['id']=0;

              }else{

                  $career_aboutus=DB::table('career_aboutus')->where('id',$id)->get();
                  $data['title']=$career_aboutus[0]->title;
                  $data['image']=$career_aboutus[0]->image;

                  $data['id']=$career_aboutus[0]->id;

              } 

           return view('admin.add_career_aboutus',$data);

        }

      public function store_career_aboutus(Request $request,$id){



               $title=$request->input('title');
               $file=$request->file('image');          

               if($id==0){

               $request->validate([

                    'title' => 'required',
                    'image' => 'required',
                     
                 ]);


                 $imagename='';
         
                if($file){
          
                   $destinationPath='uploads';
                   $imagename=time().'_'.$file->getClientOriginalName();
                   $file->move($destinationPath,$imagename);
       
                  }

                DB::table('career_aboutus')->insert(['image'=>$imagename,'title'=>$title]); 

                    return redirect('admin/career')->with('error','data insert successfully'); 


                 }else{


                   $request->validate([

                    'title' => 'required',   
                     
                 ]);


                $imagename='';

               if($file){
         
                   $destinationPath='uploads';
                   $imagename=time().'_'.$file->getClientOriginalName();
                   $file->move($destinationPath,$imagename);

                   DB::table('career_aboutus')->where('id', $id)->update(['image'=>$imagename]);

                  if($request->input('oldimage')!='') {

                        unlink(public_path("/uploads/".$request->input('oldimage')));  
                     }
                  }

                DB::table('career_aboutus')->where('id',$id)->update(['title'=>$title]);  

                  return redirect('admin/career')->with('error','data updated successfully'); 

                 }


         }

         public function delete_career_aboutus($id){


            $career_aboutus= DB::table('career_aboutus')->where('id', $id)->get();

            if($career_aboutus[0]->image!='') {

               unlink(public_path("/uploads/".$career_aboutus[0]->image));

             }

           DB::table('career_aboutus')->where('id', $id)->delete();

           return response()->json([
            'success' => 'Record has been deleted successfully!'
            ]);


          }

          public function employee_opinion(){

               $id1=Auth::id();
               $admin=Admin::where('id',$id1)->get();
               $data['admin_name']=$admin[0]->name;
               $data['industry']=DB::table('industries')->get();

               $data['employee_opinion']=DB::table('employee_opinion')->get();


             return view('admin.employee_opinion',$data);


          }

           public function add_employee_opinion($id)
           {

               $id1=Auth::id();
               $admin=Admin::where('id',$id1)->get();
               $data['admin_name']=$admin[0]->name;

               $data['industry']=DB::table('industries')->get();

               if($id==0){

                $data['name']='';
                $data['image']='';
                $data['occupation']='';
                $data['description']='';

                $data['id']=0;

              }else{

                  $employee_opinion=DB::table('employee_opinion')->where('id',$id)->get();

                $data['name']=$employee_opinion[0]->name;
                $data['image']=$employee_opinion[0]->image;
                $data['occupation']=$employee_opinion[0]->occupation;
                $data['description']=$employee_opinion[0]->description;

                $data['id']=$employee_opinion[0]->id;


              } 

           return view('admin.add_employee_opinion',$data);
           }

           public function store_employee_opinion(Request $request, $id)
           {


               $name=$request->input('name');
               $occupation=$request->input('occupation');
               $description=$request->input('description');
               $file=$request->file('image');          

               if($id==0){

               $request->validate([

                    'name' => 'required',
                    'image' => 'required',
                     'occupation' => 'required',
                     'description' => 'required',
                     
                 ]);


                 $imagename='';
         
                if($file){
          
                   $destinationPath='uploads';
                   $imagename=time().'_'.$file->getClientOriginalName();
                   $file->move($destinationPath,$imagename);
       
                  }

                DB::table('employee_opinion')->insert(['image'=>$imagename,'name'=>$name,'occupation'=>$occupation,'description'=>$description]); 

                    return redirect('admin/employee_opinion')->with('error','data insert successfully'); 


                 }else{


                   $request->validate([

                     'name' => 'required',
                 
                     'occupation' => 'required',
                     'description' => 'required',  
                     
                 ]);


                $imagename='';

                 if($file){
         
                   $destinationPath='uploads';
                   $imagename=time().'_'.$file->getClientOriginalName();
                   $file->move($destinationPath,$imagename);

                   DB::table('employee_opinion')->where('id', $id)->update(['image'=>$imagename]);

                  if($request->input('oldimage')!='') {

                        unlink(public_path("/uploads/".$request->input('oldimage')));  
                     }
                  }

                DB::table('employee_opinion')->where('id',$id)->update(['name'=>$name,'occupation'=>$occupation,'description'=>$description]);  

                  return redirect('admin/employee_opinion')->with('error','data updated successfully'); 

                 }

            
           }

           public function delete_employee_opinion($id)
             {

               $employee_opinion= DB::table('employee_opinion')->where('id', $id)->get();

            if($employee_opinion[0]->image!='') {

               unlink(public_path("/uploads/".$employee_opinion[0]->image));

             }

             DB::table('employee_opinion')->where('id', $id)->delete();

             return response()->json([
            'success' => 'Record has been deleted successfully!'
            ]);

             
         }

         public function talent_area(){

             $id1=Auth::id();
               $admin=Admin::where('id',$id1)->get();
               $data['admin_name']=$admin[0]->name;

               $data['industry']=DB::table('industries')->get();

         $data['aboutus_banner']=DB::table('banner_image')->where('name','Talent Areas')->get();

          $data['hiring_desc']=DB::table('hiring_desc')->get();

          $data['vacancies']=DB::table('vacancies')->get();

          $data['job_location']=DB::table('job_location')->get();

          $data['industries']=DB::table('industries')->get();
          $data['job_type']=DB::table('job_type')->get();

             
         /*$data['vacancy']=DB::table('vacancy')->orderBy('id', 'DESC')->get();*/




           return view('admin.talent_area',$data);

         }

         public function update_hiring_desc($id){

             $id1=Auth::id();
               $admin=Admin::where('id',$id1)->get();
               $data['admin_name']=$admin[0]->name;

               $data['industry']=DB::table('industries')->get();


        $hiring_desc=DB::table('hiring_desc')->where('id',$id)->get();

            $data['title']=$hiring_desc[0]->title;
           $data['id']=$hiring_desc[0]->id;
           $data['description']=$hiring_desc[0]->description;



          return view('admin.update_hiring_desc',$data);



         }


          public function store_hiring_desc(Request $request,$id){


           $request->validate([

             'title' => 'required',
             'description' => 'required',
               
           ]);


         $title=$request->input('title');
         $description=$request->input('description');
      

         DB::table('hiring_desc')->where('id',$id)->update(['title'=>$title,'description'=>$description]); 

         return redirect('admin/talent_area')->with('error','data updated successfully'); 

       }

       public function add_vacancy(){

       $id1=Auth::id();
       $admin=Admin::where('id',$id1)->get();
       $data['admin_name']=$admin[0]->name;

       $data['industry']=DB::table('industries')->get();



        $data['job_type']=DB::table('job_type')->get();
   

          return view('admin.add_vacancy',$data);
 
       }

       public function store_vacancy(Request $request){


         $request->validate([

             'position' => 'required',
             'job_type' => 'required',
             'apply' => 'required',
            'about_role'=> 'required',
               
           ]);


          $position=$request->input('position');
          $job_type=$request->input('job_type');
          $experience=$request->input('experience');
          $apply=$request->input('apply');
          $about_role=$request->input('about_role');
          $responsibilities=$request->input('responsibilities');
          $requirement=$request->input('requirement');
          $skill=$request->input('skill');
          $qualifications=$request->input('qualifications');
          $tech_experience=$request->input('tech_experience');
          $extra_skills=$request->input('extra_skills');

          

          $location=$request->input('location');
          $industry=$request->input('industry');
          $technology=$request->input('technology');



        DB::table('vacancies')->insert(['position'=>$position,'job_type'=>$job_type,'experience'=>$experience,'apply'=>$apply,'about_role'=>$about_role,'responsibilities'=>$responsibilities,'requirement'=>$requirement,'skill'=>$skill,'qualifications'=>$qualifications,'tech_experience'=>$tech_experience,'extra_skills'=>$extra_skills]);


             $max_id = DB::table('vacancies')->max('id'); 


             $location1 = explode(",", $location);
             $industry1 = explode(",", $industry);
             $technology1 = explode(",", $technology);

             if($location !=''){

           foreach ($location1 as $key =>$l) {

             DB::table('job_location')->insert(['location'=>$l, 'vacancy_id'=>$max_id]);
        
            }
          }

           if($technology !=''){

           foreach ($technology1 as $key =>$t) {

             DB::table('technology')->insert(['name'=>$t, 'vacancy_id'=>$max_id]);
        
            }
          }


          if($industry !=''){

            foreach ($industry1 as $key =>$i) {

             DB::table('industry')->insert(['industry'=>$i, 'vacancy_id'=>$max_id]);
        
            }
        }

            return redirect('admin/talent_area')->with('error','data inserted successfully'); 


       }

       public function update_vacancy($id){

           $id1=Auth::id();
               $admin=Admin::where('id',$id1)->get();
               $data['admin_name']=$admin[0]->name;

               $data['industry']=DB::table('industries')->get();


         $data['job_type']=DB::table('job_type')->get();

          $vacancies=DB::table('vacancies')->where('id',$id)->get();

         $data['position']=$vacancies[0]->position;
         $data['job_type1']=$vacancies[0]->job_type;
         $data['experience']=$vacancies[0]->experience;
         $data['apply']=$vacancies[0]->apply;
         $data['about_role']=$vacancies[0]->about_role;
         $data['responsibilities']=$vacancies[0]->responsibilities;
         $data['requirement']=$vacancies[0]->requirement;
         $data['skill']=$vacancies[0]->skill;
         $data['qualifications']=$vacancies[0]->qualifications;
         $data['tech_experience']=$vacancies[0]->tech_experience;
         $data['extra_skills']=$vacancies[0]->extra_skills;
         $data['id']=$vacancies[0]->id;



          $data['industries']=DB::table('industry')->where('vacancy_id',$id)->get();
          $data['location']=DB::table('job_location')->where('vacancy_id',$id)->get();

           $data['technology']=DB::table('technology')->where('vacancy_id',$id)->get();


        return view('admin.update_vacancy',$data);



       }

       public function delete_location($id){

         DB::table('job_location')->where('id', $id)->delete();

             return response()->json([
            'success' => 'Record has been deleted successfully!'
            ]);

       }

       public function delete_industries($id){

         DB::table('industry')->where('id', $id)->delete();

             return response()->json([
            'success' => 'Record has been deleted successfully!'
            ]);



       }

          public function delete_technology($id){

         DB::table('technology')->where('id', $id)->delete();

             return response()->json([
            'success' => 'Record has been deleted successfully!'
            ]);



       }

       

       public function store_update_vacancy(Request $request,$id){


         $request->validate([

             'position' => 'required',
             'job_type' => 'required',
             'apply' => 'required',
            'about_role'=> 'required',
               
           ]);


          $position=$request->input('position');
          $job_type=$request->input('job_type');
          $experience=$request->input('experience');
          $apply=$request->input('apply');
          $about_role=$request->input('about_role');
          $responsibilities=$request->input('responsibilities');
          $requirement=$request->input('requirement');
          $skill=$request->input('skill');
          $qualifications=$request->input('qualifications');
          $tech_experience=$request->input('tech_experience');
          $extra_skills=$request->input('extra_skills');

          

          $location=$request->input('location');
          $industry=$request->input('industry');

          $technology=$request->input('technology');



        DB::table('vacancies')->where('id',$id)->update(['position'=>$position,'job_type'=>$job_type,'experience'=>$experience,'apply'=>$apply,'about_role'=>$about_role,'responsibilities'=>$responsibilities,'requirement'=>$requirement,'skill'=>$skill,'qualifications'=>$qualifications,'tech_experience'=>$tech_experience,'extra_skills'=>$extra_skills]);


        

             $location1 = explode(",", $location);
             $industry1 = explode(",", $industry);
            $technology1 = explode(",", $technology);

            if($location !=''){

           foreach ($location1 as $key =>$l) {

             DB::table('job_location')->insert(['location'=>$l, 'vacancy_id'=>$id]);
        
            }
          }

            if($technology !=''){

           foreach ($technology1 as $key =>$t) {

             DB::table('technology')->insert(['name'=>$t, 'vacancy_id'=>$id]);
        
            }
          }

          if($industry !=''){

            foreach ($industry as $key =>$i) {

             DB::table('industry')->insert(['industry'=>$i, 'vacancy_id'=>$id]);
        
            }
        }

            return redirect('admin/talent_area')->with('error','data updated successfully'); 

       }


       public function delete_vacancy($id){


            DB::table('job_location')->where('id', $id)->delete();

            DB::table('industry')->where('id', $id)->delete();

            DB::table('vacancies')->where('id',$id)->delete();

            DB::table('technology')->where('id', $id)->delete();

              return response()->json([
            'success' => 'Record has been deleted successfully!'
            ]);

       }

       public function view_vacancy($id){

           $id1=Auth::id();
               $admin=Admin::where('id',$id1)->get();
               $data['admin_name']=$admin[0]->name;

               $data['industry']=DB::table('industries')->get();



         $data['job_type']=DB::table('job_type')->get();

         $vacancies=DB::table('vacancies')->where('id',$id)->get();

         $data['position']=$vacancies[0]->position;
         $data['job_type1']=$vacancies[0]->job_type;
         $data['experience']=$vacancies[0]->experience;
         $data['apply']=$vacancies[0]->apply;
         $data['about_role']=$vacancies[0]->about_role;
         $data['responsibilities']=$vacancies[0]->responsibilities;
         $data['requirement']=$vacancies[0]->requirement;
         $data['skill']=$vacancies[0]->skill;
         $data['qualifications']=$vacancies[0]->qualifications;
         $data['tech_experience']=$vacancies[0]->tech_experience;
         $data['extra_skills']=$vacancies[0]->extra_skills;
         $data['id']=$vacancies[0]->id;

         $data['industries']=DB::table('industry')->where('vacancy_id',$id)->get();
         $data['location']=DB::table('job_location')->where('vacancy_id',$id)->get();
         $data['technology']=DB::table('technology')->where('vacancy_id',$id)->get();


        return view('admin.vacancy_detail',$data);

       }

       public function hiring_process(){

           $id1=Auth::id();
               $admin=Admin::where('id',$id1)->get();
               $data['admin_name']=$admin[0]->name;

               $data['industry']=DB::table('industries')->get();



        $data['aboutus_banner']=DB::table('banner_image')->where('name','Hiring Process')->get();

        $data['hiring_process_desc']=DB::table('hiring_process_desc')->get();

       $data['hiring_step']=DB::table('hiring_step')->get();
 

        return view('admin.hiring_process',$data);
       }

          public function update_hiring_process_desc($id){


        $hiring_desc=DB::table('hiring_process_desc')->where('id',$id)->get();

            $data['title']=$hiring_desc[0]->title;
           $data['id']=$hiring_desc[0]->id;
           $data['description']=$hiring_desc[0]->description;



          return view('admin.update_hiring_process_desc',$data);



         }


          public function store_hiring_process_desc(Request $request,$id){


           $request->validate([

             'title' => 'required',
             'description' => 'required',
               
           ]);


         $title=$request->input('title');
         $description=$request->input('description');
      

         DB::table('hiring_process_desc')->where('id',$id)->update(['title'=>$title,'description'=>$description]); 

         return redirect('admin/hiring_process')->with('error','data updated successfully'); 

       }

       public function add_hiring_step($id){

               $id1=Auth::id();
               $admin=Admin::where('id',$id1)->get();
               $data['admin_name']=$admin[0]->name;

               $data['industry']=DB::table('industries')->get();


         if($id==0){

                $data['title']='';
                
                $data['description']='';

                $data['id']=0;

              }else{

             
                $hiring_step=DB::table('hiring_step')->where('id',$id)->get();

                $data['title']=$hiring_step[0]->title;              
                $data['description']=$hiring_step[0]->description;
                $data['id']=$hiring_step[0]->id;


              } 


           return view('admin.add_hiring_step',$data);


       }


         public function store_hiring_step(Request $request, $id)
           {


             $request->validate([

                    'title' => 'required',
                     'description' => 'required',
                     
                 ]);


               $title=$request->input('title');
               $description=$request->input('description');
                  

               if($id==0){

            

                DB::table('hiring_step')->insert(['title'=>$title,'description'=>$description]); 

                    return redirect('admin/hiring_process')->with('error','data insert successfully'); 


                 }else{


                DB::table('hiring_step')->where('id',$id)->update(['title'=>$title,'description'=>$description]); 

                  return redirect('admin/hiring_process')->with('error','data updated successfully'); 

                 }

            
           }

           public function delete_hiring_step($id){


            DB::table('hiring_step')->where('id', $id)->delete();

              return response()->json([
            'success' => 'Record has been deleted successfully!'
            ]);



           }

         

}
