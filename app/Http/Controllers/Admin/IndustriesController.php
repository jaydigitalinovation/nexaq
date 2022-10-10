<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class IndustriesController extends Controller
{
     
     public function __construct(){

                $this->middleware('auth:admin');
        }

      
        public function industries_detail($id){


           $data['industry']=DB::table('industries')->get();

           $page_name1=DB::table('industries')->where('id',$id)->get();

           $page_name=$page_name1[0]->title;

           $data['page_name']=$page_name;

           $data['industry_id']=$id;

           $data['aboutus_banner']=DB::table('banner_image')->where('name',$page_name)->get();

           $data['industry_desc']=DB::table('industry_desc')->where('industry_id',$id)->get();

           $data['expertise']=DB::table('expertise')->where('industry_id',$id)->get();

             $data['segments']=DB::table('segments')->where('industry_id',$id)->get();




            return view('admin.industries_detail',$data);
        }

        public function update_industry_desc($id){

           $industry_desc=DB::table('industry_desc')->where('id',$id)->get();
           $data['industry']=DB::table('industries')->get();

           $data['title']=$industry_desc[0]->title;
           $data['id']=$industry_desc[0]->id;
           $data['description']=$industry_desc[0]->description;

           $industry_id=$industry_desc[0]->industry_id;

           $industry=DB::table('industries')->where('id',$industry_id)->get();

           $data['page_name']=$industry[0]->title;


           return view('admin.update_industry_desc',$data);


        }

        public function store_industry_desc(Request $request,$id){


           $request->validate([

             'title' => 'required',
             'description' => 'required',
               
           ]);

         $title=$request->input('title');
         $description=$request->input('description');

         $industry_desc=DB::table('industry_desc')->where('id',$id)->get();
       
         $industry_id=$industry_desc[0]->industry_id;

      
          DB::table('industry_desc')->where('id',$id)->update(['title'=>$title,'description'=>$description]); 

         return redirect('admin/industries_detail/'.$industry_id)->with('error','data updated successfully'); 


        }



         public function add_experties($id){

            $data['industry_id']=$id;
            $data['industry']=DB::table('industries')->get();


           return view('admin.add_expertise',$data);
           
        }

        public function store_experties(Request $request, $id){

          $request->validate([

             'title' => 'required',
             'description' => 'required',
               
           ]);


           $title=$request->input('title');
           $description=$request->input('description');

           DB::table('expertise')->insert(['title'=>$title,'description'=> $description,'industry_id'=>$id]);

        $last_id= DB::table('expertise')->max('id');

           $title1=$request->input('title1');

       $file=$request->file('image');

      

           if($file != '' &&  $title1 !=''){

            $filename='';

            if($file){

                   $destinationPath='uploads';
                   $filename=time().'_'.$file->getClientOriginalName();
                   $file->move($destinationPath,$filename);
      
                }

                DB::table('expertise_image')->insert(['title'=>$title1,'image'=>$filename,'experties_id'=>$last_id]);

           }

            $titles=$request->input('titles');

            $files=$request->file('images');

        if($titles !='' && $files !=''){

            $arr_expertise=[];

            $title_array_size=count($titles);
            $file_array_size=count($files);



            if($title_array_size>0 && $file_array_size>0){

          
             for($i=0; $i<$file_array_size; $i++){

                     $titles1 =$titles[$i];

                         $images = $files[$i];
                     
                         $experties_id=$last_id;

                         $imagename='';
                 
                         if($images !=''){


                        $destinationPath='uploads';
                        $imagename=rand().'_'.$images->getClientOriginalName();
                        $images->move($destinationPath,$imagename);

                       }

                    DB::table('expertise_image')->insert(['title'=>$titles1,'image'=>$imagename,'experties_id'=>$experties_id]);
                   
                 }

                    

              }
           }

             return redirect('/admin/industries_detail/'.$id)->with('error','data inserted successfully');

         }

         public function view_industries_experties($id){

           $data['industry']=DB::table('industries')->get();

           $experties_detail=DB::table('expertise')->where('id',$id)->get();

           $data['title']=$experties_detail[0]->title;

           $data['description']=$experties_detail[0]->description;

           $data['industry_id']=$experties_detail[0]->industry_id;

           $data['expertise_image']=DB::table('expertise_image')->where('experties_id',$id)->get();

           return view('admin.view_industry_experties',$data);

         }

         public function update_experties($id){


          $data['industry']=DB::table('industries')->get();

           $experties_detail=DB::table('expertise')->where('id',$id)->get();

           $data['title']=$experties_detail[0]->title;

           $data['description']=$experties_detail[0]->description;

           $data['industry_id']=$experties_detail[0]->industry_id;

             $data['id']=$experties_detail[0]->id;

           $data['expertise_image']=DB::table('expertise_image')->where('experties_id',$id)->get();

           return view('admin.update_experties',$data);




         }

         public function delete_experties_image($id){


           $expertise_image= DB::table('expertise_image')->where('id', $id)->get();

            if($expertise_image[0]->image!='') {

               unlink(public_path("/uploads/".$expertise_image[0]->image));

             }

           DB::table('expertise_image')->where('id', $id)->delete();

           return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);


         }

         public function update_experties_image($id){

              $data['industry']=DB::table('industries')->get();


            $expertise_image= DB::table('expertise_image')->where('id', $id)->get();

             $data['image']= $expertise_image[0]->image;
             $data['title']= $expertise_image[0]->title;

             $data['id']= $expertise_image[0]->id;


          return view('admin.update_experties_image',$data);


         }

         public function store_experties_image(Request $request, $id){

               $request->validate([

             'title' => 'required',
           
           ]);


         $title=$request->input('title');
         $file=$request->file('image');

           $experties=DB::table('expertise_image')->where('id',$id)->get();

           $experties_id=$experties[0]->experties_id;


          $imagename='';

            if($file){
         
               $destinationPath='uploads';
               $imagename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$imagename);

               DB::table('expertise_image')->where('id', $id)->update(['image'=>$imagename]);

              if($request->input('oldimage')!='') {

                    unlink(public_path("/uploads/".$request->input('oldimage')));  
                 }
              }


         DB::table('expertise_image')->where('id',$id)->update(['title'=>$title]); 

        return redirect('admin/update_experties/'.$experties_id)->with('error','data updated successfully');  


         }

         public function store_update_experties(Request $request, $id){


           $request->validate([

             'title' => 'required',
             'description' => 'required',
               
           ]);

          
           $industry_id1=DB::table('expertise')->where('id',$id)->get();

           $industry_id=$industry_id1[0]->industry_id;


           $title=$request->input('title');
           $description=$request->input('description');

           DB::table('expertise')->where('id',$id)->update(['title'=>$title,'description'=> $description,'industry_id'=>$industry_id]);

  

           $title1=$request->input('title1');

            $file=$request->file('image');

      

           if($file != '' &&  $title1 !=''){

            $filename='';

            if($file){

                   $destinationPath='uploads';
                   $filename=time().'_'.$file->getClientOriginalName();
                   $file->move($destinationPath,$filename);
      
                }

                DB::table('expertise_image')->insert(['title'=>$title1,'image'=>$filename,'experties_id'=>$id]);

           }

            $titles=$request->input('titles');

            $files=$request->file('images');

          if($titles !='' && $files !=''){

            $arr_expertise=[];

          $title_array_size=count($titles);
            $file_array_size=count($files);



            if($title_array_size>0 && $file_array_size>0){

          
            for($i= 0; $i<$title_array_size; $i++){

                       $titles1 =$titles[$i];
                       $images = $files[$i];

                     
                         $experties_id=$id;

                         $imagename='';

                         if($images !=''){


                        $destinationPath='uploads';
                        $imagename=rand().'_'.$images->getClientOriginalName();
                        $images->move($destinationPath,$imagename);

                       }

                   DB::table('expertise_image')->insert(['title'=>$titles1,'image'=>$imagename,'experties_id'=>$id]);
                   
                 }

              }
           }

             return redirect('/admin/industries_detail/'. $industry_id)->with('error','data updated successfully');

         }

         public function delete_experties($id){

              $image=DB::table('expertise_image')->where('experties_id',$id)->get();

              if($image !=''){

              foreach ($image as $key => $i) {


                 if($i->image !=''){
           
                      unlink(public_path("/uploads/".$i->image));

                 }

               
               }  

            }

            DB::table('expertise_image')->where('experties_id',$id)->delete();

            DB::table('expertise')->where('id',$id)->delete();

             return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);


         }

         public function add_segment($id){

            $data['industry_id']=$id;

              $data['industry']=DB::table('industries')->get();

           return view('admin.add_segment',$data);

         }

         public function store_segment(Request $request,$id){

                 $industry_id=$id;

            $request->validate([

             'name' => 'required',
             'image' => 'required',
          
               
           ]);


         $name=$request->input('name');
         $file=$request->file('image');

         $imagename='';
        
           if($file){
          
               $destinationPath='uploads';
               $imagename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$imagename);
       
              }

        DB::table('segments')->insert(['name'=>$name,'image'=>$imagename,'industry_id'=>$industry_id]); 

        return redirect('admin/industries_detail/'.$industry_id)->with('error','data inserted successfully');  



         }

         public function update_segment($id){

            $segment=DB::table('segments')->where('id',$id)->get();
             $data['industry']=DB::table('industries')->get();

            $data['image']=$segment[0]->image;
            $data['name']=$segment[0]->name;
            $data['industry_id']=$segment[0]->industry_id;
           $data['segment_id']=$segment[0]->id;


            return view('admin.update_segment',$data);





         }

         public function store_update_segment(Request $request, $id){

                  $segments_id=$id;

            $request->validate([

             'name' => 'required',
          
          
               
           ]);


         $name=$request->input('name');
         $file=$request->file('image');
         $industry_id=$request->input('industry_id');

         $imagename='';
        
           if($file){
          
               $destinationPath='uploads';
               $imagename=time().'_'.$file->getClientOriginalName();
               $file->move($destinationPath,$imagename);

               DB::table('segments')->where('id',  $segments_id)->update(['image'=>$imagename]);

              if($request->input('oldimage')!='') {

                    unlink(public_path("/uploads/".$request->input('oldimage')));  
                 }
       
              }

        DB::table('segments')->where('id',$segments_id)->update(['name'=>$name,'industry_id'=>$industry_id]); 

        return redirect('admin/industries_detail/'.$industry_id)->with('error','data updated successfully');  


         }

         public function delete_segment($id){

          $segments= DB::table('segments')->where('id', $id)->get();

             if($segments[0]->image!=''){

                unlink(public_path("/uploads/".$segments[0]->image));

              }

            DB::table('segments')->where('id', $id)->delete();

           return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);


         }


}
