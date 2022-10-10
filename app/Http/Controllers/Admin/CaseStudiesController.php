<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use Illuminate\Session\Store;

use DB;

class CaseStudiesController extends Controller
{
    public function case_studies(){

        $data['industry']=DB::table('industries')->get();

        $case_studies=DB::table('case_studies')->get();

        $data['case_studies']=$case_studies;

        return view('admin.case_studies',$data);
    }

    public function add_case_studies($id){

        if($id==0){

                $data['sub_title']='';
                $data['title']='';
                $data['image']='';
                $data['description']='';

                $data['id']=0;
                $data['industry']=DB::table('industries')->get();

              }else{

                  $case_studies=DB::table('case_studies')->where('id',$id)->get();

                $data['sub_title']=$case_studies[0]->sub_title;
                $data['title']=$case_studies[0]->title;
                $data['image']=$case_studies[0]->main_image;
                $data['description']=$case_studies[0]->description;

                $data['id']=$case_studies[0]->id;
                $data['industry']=DB::table('industries')->get();


              } 

           return view('admin.add_case_studies',$data);
    }

    public function store_case_studies(Request $request,$id){

        if($id==0){

            $validated=$request->validate([
                'sub_title'=>'required',
                'title'=>'required',
                'description'=>'required',
            ]);

            $sub_title=$request->input('sub_title');

            $title=$request->input('title');

            $description=$request->input('description');

            $file=$request->file('image');

            $imagename='';

            if($file){

                $destination_path='uploads';

                $imagename=time().'_'.$file->getClientOriginalName();

                $file->move($destination_path,$imagename);
            }

            DB::table('case_studies')->insert(['sub_title'=>$sub_title,'title'=>$title,'description'=>$description,'main_image'=>$imagename]);

            $case_id=DB::table('case_studies')->max('id');

            return redirect('/admin/add_case_management/'.$id);
        }else{

            $validated=$request->validate([
                'sub_title'=>'required',
                'title'=>'required',
                'description'=>'required',
            ]);

            $sub_title=$request->input('sub_title');

            $title=$request->input('title');

            $description=$request->input('description');

            $file=$request->file('image');

            $oldimage=$request->input('oldimage');

            $imagename='';

            if($file){

                $destination_path='uploads';

                $imagename=time().'_'.$file->getClientOriginalName();

                $file->move($destination_path,$imagename);

                if($oldimage){

                    unlink(public_path('/uploads/'.$oldimage));
                }

                DB::table('case_studies')->where('id',$id)->update(['main_image'=>$imagename]);
            }

            DB::table('case_studies')->where('id',$id)->update(['sub_title'=>$sub_title,'title'=>$title,'description'=>$description]);

            return redirect('/admin/add_case_management/'.$id)->with('error','data updated successfully!!!');
        }
    }


    public function delete_case_studies($id){

        $userdata=DB::table('case_studies')->where('id', $id)->get();

        $image=$userdata[0]->main_image;

        if($image){

           unlink(public_path('/uploads/'.$image));

            
        }


        $cs_banner=DB::table('cs_banner')->where('case_id', $id)->get();

        $image=$cs_banner[0]->image;

        if($image){

           unlink(public_path('/uploads/'.$image));

            
        }

        $cs_expertise=DB::table('cs_expertise')->where('case_id', $id)->get();

        $image=$cs_expertise[0]->image;

        if($image){

           unlink(public_path('/uploads/'.$image));

            
        }

        $cs_inner_detail=DB::table('cs_inner_detail')->where('case_id', $id)->get();

        $inner_id=$cs_inner_detail[0]->id;
        

        DB::table('cs_banner')->where('case_id', $id)->delete();

        DB::table('cs_banner_list')->where('case_id', $id)->delete();

        DB::table('cs_challenge')->where('case_id', $id)->delete();

        DB::table('cs_challenge_des')->where('case_id', $id)->delete();

        DB::table('cs_expertise')->where('case_id', $id)->delete();

        DB::table('cs_expertise_list')->where('case_id', $id)->delete();

        DB::table('cs_solution')->where('case_id', $id)->delete();

        DB::table('cs_inner_detail')->where('case_id', $id)->delete();

        DB::table('cs_inner_detail_des')->where('list_id', $inner_id)->delete();

        DB::table('cs_result')->where('case_id', $id)->delete();

        DB::table('cs_result_des')->where('case_id', $id)->delete();

        DB::table('case_studies')->where('id', $id)->delete();



        return response()->json([
         'success' => 'Record has been deleted successfully!'
        ]);

    }


    public function  delete_all_case_studies(Request $request){

            $ids = $request->ids;

             foreach($ids as $id){

                $userdata=DB::table('case_studies')->where('id', $id)->get();

                $image=$userdata[0]->main_image;

                if($image){
                    unlink(public_path('/uploads/'.$image));
                }

                    DB::table('case_studies')->where('id', $id)->delete();

             }

            return response()->json(['status'=>200]);


    }


    public function case_management(){

        $data['industry']=DB::table('industries')->get();

        $case_studies=DB::table('case_studies')->get();

        $data['case_studies']=$case_studies;

        $case_management=DB::table('case_management')->get();

        $data['case_management']=$case_management;

        return view('admin.case_management',$data);
    }

    public function add_case_management($id){

        if($id==0){

                $data['image']='';
                $data['icon_image']='';
                $data['title']='';
                $data['description']='';

                $case_id=DB::table('case_studies')->max('id');

                $data['case_id']=$case_id;

                $data['id']=0;
                $data['industry']=DB::table('industries')->get();

              }else{

                  $case_management=DB::table('case_management')->where('case_id',$id)->get();

                $data['image']=$case_management[0]->image;
                $data['icon_image']=$case_management[0]->icon_image;
                $data['title']=$case_management[0]->title;
                $data['description']=$case_management[0]->description;

                $data['case_id']=$id;
                $data['id']=$case_management[0]->id;
                $data['industry']=DB::table('industries')->get();
              } 

           return view('admin.add_case_management',$data);
    }

    public function store_case_management(Request $request,$id){


        if($id==0){

            $validated=$request->validate([
                'title'=>'required',
                'description'=>'required',
            ]);

            $title=$request->input('title');

            $description=$request->input('description');

            $case_id=$request->input('case_id');

            $file=$request->file('image');

            $imagename='';

            if($file){

                $destination_path='uploads';

                $imagename=time().'_'.$file->getClientOriginalName();

                $file->move($destination_path,$imagename);
            }


            $file1=$request->file('icon_image');

            $imagename1='';

            if($file1){

                $destination_path='uploads';

                $imagename1=time().'__'.$file1->getClientOriginalName();

                $file1->move($destination_path,$imagename1);
            }

            DB::table('case_management')->insert(['image'=>$imagename,'icon_image'=>$imagename1,'title'=>$title,'description'=>$description,'case_id'=>$case_id]);

            return redirect('/admin/add_case_project/'.$id);
        }else{

            $validated=$request->validate([
                'title'=>'required',
                'description'=>'required',
            ]);

            $title=$request->input('title');

            $case_id=$request->input('case_id');

            $description=$request->input('description');

            $file=$request->file('image');

            $userdata=DB::table('case_management')->where('case_id',$case_id)->get();

            $cm_id=$userdata[0]->id;

            $oldimage=$request->input('oldimage');

            $imagename='';

            if($file){

                $destination_path='uploads';

                $imagename=time().'_'.$file->getClientOriginalName();

                $file->move($destination_path,$imagename);

                if($oldimage){

                    unlink(public_path('/uploads/'.$oldimage));
                }

                DB::table('case_management')->where('id',$cm_id)->update(['image'=>$imagename]);
            }


            $file1=$request->file('icon_image');

            $oldicon_image=$request->input('oldicon_image');

            $imagename1='';

            if($file1){

                $destination_path='uploads';

                $imagename1=time().'__'.$file1->getClientOriginalName();

                $file1->move($destination_path,$imagename1);

                if($oldicon_image){

                    unlink(public_path('/uploads/'.$oldicon_image));
                }

                DB::table('case_management')->where('id',$cm_id)->update(['icon_image'=>$imagename1]);
            }


            DB::table('case_management')->where('id',$cm_id)->update(['title'=>$title,'case_id'=>$case_id,'description'=>$description]);

            return redirect('/admin/add_case_project/'.$case_id)->with('error','data updated successfully!!!');
        }
    }


    public function delete_case_management($id){

        $userdata=DB::table('case_management')->where('id', $id)->get();

        $image=$userdata[0]->image;

        if($image){
            unlink(public_path('/uploads/'.$image));
        }

        $icon_image=$userdata[0]->icon_image;

        if($icon_image){
            unlink(public_path('/uploads/'.$icon_image));
        }

        DB::table('case_management')->where('id', $id)->delete();

        return response()->json([
         'success' => 'Record has been deleted successfully!'
        ]);

    }


    public function  delete_all_case_management(Request $request){

            $ids = $request->ids;

             foreach($ids as $id){

                $userdata=DB::table('case_management')->where('id', $id)->get();

                $image=$userdata[0]->image;

                if($image){
                    unlink(public_path('/uploads/'.$image));
                }

                $icon_image=$userdata[0]->icon_image;

                if($icon_image){
                    unlink(public_path('/uploads/'.$icon_image));
                }

                    DB::table('case_management')->where('id', $id)->delete();

             }

            return response()->json(['status'=>200]);


    }



    public function case_project(){

        $data['industry']=DB::table('industries')->get();

        $case_project=DB::table('case_project')->get();

        $data['case_project']=$case_project;

        return view('admin.case_project',$data);
    }

    public function add_case_project($id){

        if($id==0){

                $data['title']='';
                $data['description']='';

                $case_id=DB::table('case_studies')->max('id');

                $data['case_id']=$case_id;

                $data['id']=0;

                $data['industry']=DB::table('industries')->get();

              }else{

                  $case_project=DB::table('case_project')->where('id',$id)->get();

                $data['title']=$case_project[0]->title;
                $data['description']=$case_project[0]->description;

                $data['case_id']=$id;

                $data['id']=$case_project[0]->id;

                $data['industry']=DB::table('industries')->get();


              } 

           return view('admin.add_case_project',$data);
    }

    public function store_case_project(Request $request,$id){

        if($id==0){

            $validated=$request->validate([
                'title'=>'required',
                'description'=>'required',
            ]);

            $title=$request->input('title');

            $case_id=$request->input('case_id');

            $description=$request->input('description');

            DB::table('case_project')->insert(['title'=>$title,'case_id'=>$case_id ,'description'=>$description]);

            return redirect('/admin/case_studies')->with('error','data submitted successfully!!!');
        }else{

            $validated=$request->validate([
                'title'=>'required',
                'description'=>'required',
            ]);

            $title=$request->input('title');

            $case_id=$request->input('case_id');

            $description=$request->input('description');

            DB::table('case_project')->where('case_id',$id)->update(['title'=>$title,'case_id'=>$case_id ,'description'=>$description]);

            return redirect('/admin/case_studies')->with('error','data updated successfully!!!');
        }
    }


    public function delete_case_project($id){

        DB::table('case_project')->where('id', $id)->delete();

        return response()->json([
         'success' => 'Record has been deleted successfully!'
        ]);

    }


    public function  delete_all_case_project(Request $request){

            $ids = $request->ids;

             foreach($ids as $id){

                    DB::table('case_project')->where('id', $id)->delete();

             }

            return response()->json(['status'=>200]);


    }


    public function about_blog_detail(){

        $data['industry']=DB::table('industries')->get();

        $about_blog_detail=DB::table('about_blog_detail')->get();

        $data['about_blog_detail']=$about_blog_detail;

        return view('admin.about_blog',$data);
    }

    public function add_about_blog_detail($id){

        if($id==0){

                $data['image']='';
                $data['date']='';
                $data['title']='';
                $data['description']='';
                $data['detail_description']='';

                $data['id']=0;

                $data['industry']=DB::table('industries')->get();

              }else{

                  $about_blog_detail=DB::table('about_blog_detail')->where('id',$id)->get();

                $data['image']=$about_blog_detail[0]->image;  
                $data['date']=$about_blog_detail[0]->date;
                $data['title']=$about_blog_detail[0]->title;
                
                $data['description']=$about_blog_detail[0]->description;
                $data['detail_description']=$about_blog_detail[0]->detail_description;

                $data['id']=$about_blog_detail[0]->id;

                $data['industry']=DB::table('industries')->get();


              } 

           return view('admin.add_about_blog',$data);
    }

    public function store_about_blog_detail(Request $request,$id){

        if($id==0){

            $validated=$request->validate([
                'date'=>'required',
                'title'=>'required',
                'description'=>'required',
                'detail_description'=>'required',
            ]);

            $date=$request->input('date');

            $title=$request->input('title');

            $description=$request->input('description');

            $detail_description=$request->input('detail_description');

            $file=$request->file('image');

            $imagename='';

            if($file){

                $destination_path='uploads';

                $imagename=time().'_'.$file->getClientOriginalName();

                $file->move($destination_path,$imagename);
            }

            DB::table('about_blog_detail')->insert(['image'=>$imagename,'date'=>$date,'title'=>$title,'description'=>$description,'detail_description'=>$detail_description]);

            return redirect('/admin/about_blog_detail')->with('error','data submitted successfully!!!');
        }else{

            $validated=$request->validate([
                'date'=>'required',
                'title'=>'required',
                'description'=>'required',
                'detail_description'=>'required',
            ]);

            $date=$request->input('date');

            $title=$request->input('title');

            $description=$request->input('description');

            $detail_description=$request->input('detail_description');

            $file=$request->file('image');

            $oldimage=$request->input('oldimage');

            $imagename='';

            if($file){

                $destination_path='uploads';

                $imagename=time().'_'.$file->getClientOriginalName();

                $file->move($destination_path,$imagename);

                if($oldimage){

                    unlink(public_path('/uploads/'.$oldimage));
                }

                DB::table('about_blog_detail')->where('id',$id)->update(['image'=>$imagename]);
            }

            DB::table('about_blog_detail')->where('id',$id)->update(['date'=>$date,'title'=>$title,'description'=>$description,'detail_description'=>$detail_description,]);

            return redirect('/admin/about_blog_detail')->with('error','data updated successfully!!!');
        }
    }


    public function delete_about_blog_detail($id){

        $userdata=DB::table('about_blog_detail')->where('id', $id)->get();

        $image=$userdata[0]->image;

        if($image){
            unlink(public_path('/uploads/'.$image));
        }

        DB::table('about_blog_detail')->where('id', $id)->delete();

        return response()->json([
         'success' => 'Record has been deleted successfully!'
        ]);

    }


    public function  delete_all_about_blog_detail(Request $request){

            $ids = $request->ids;

             foreach($ids as $id){

                $userdata=DB::table('about_blog_detail')->where('id', $id)->get();

                $image=$userdata[0]->main_image;

                if($image){
                    unlink(public_path('/uploads/'.$image));
                }

                    DB::table('about_blog_detail')->where('id', $id)->delete();

             }

            return response()->json(['status'=>200]);


    }

    public function view_case_detail($id){

        $data['industry']=DB::table('industries')->get();

        $case_studies=DB::table('case_studies')->where('id',$id)->get();

        $data['case_studies']=$case_studies;

        $case_management=DB::table('case_management')->where('case_id',$id)->get();

        $data['case_management']=$case_management;

        $case_project=DB::table('case_project')->where('case_id',$id)->get();

        $data['case_project']=$case_project;

        return view('admin.view_case_detail',$data);
    }


    public function view_blog_detail($id){

        $data['industry']=DB::table('industries')->get();

        $about_blog_detail=DB::table('about_blog_detail')->where('id',$id)->get();

        $data['about_blog_detail']=$about_blog_detail;

        return view('admin.view_blog_detail',$data);
    }








    public function add_case_management_data($id){

        $data['industry']=DB::table('industries')->get();

        $data['id']=$id;

        return view('admin.add_case_management_data',$data);
    }


    public function store_case_management_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);

        $title=$request->input('title');

        $description=$request->input('description');

        $file=$request->file('image');

        $imagename='';

        if($file){

            $destination_path='uploads';

            $imagename=time().'_'.$file->getClientOriginalName();

            $file->move($destination_path,$imagename);
        }


        $file1=$request->file('icon_image');

        $imagename1='';

        if($file1){

            $destination_path='uploads';

            $imagename1=time().'__'.$file1->getClientOriginalName();

            $file1->move($destination_path,$imagename1);
        }

        DB::table('case_management')->insert(['image'=>$imagename,'icon_image'=>$imagename1,'title'=>$title,'description'=>$description,'case_id'=>$id]);

        return redirect('/admin/case_management')->with('error','data submitted successfully!!');


    }


    public function update_case_management_data($id){

        $data['industry']=DB::table('industries')->get();

        $case_management=DB::table('case_management')->where('id',$id)->get();

                $data['image']=$case_management[0]->image;
                $data['icon_image']=$case_management[0]->icon_image;
                $data['title']=$case_management[0]->title;
                $data['description']=$case_management[0]->description;

                $data['id']=$case_management[0]->id;

        return view('admin.update_case_management_data',$data);
    }


    public function store_update_case_management_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);

        $title=$request->input('title');

        $description=$request->input('description');

        $file=$request->file('image');

        $oldimage=$request->input('oldimage');

        $imagename='';

        if($file){

            $destination_path='uploads';

            $imagename=time().'_'.$file->getClientOriginalName();

            $file->move($destination_path,$imagename);

            if($oldimage){

                unlink(public_path('/uploads/'.$oldimage));
            }

            DB::table('case_management')->where('id',$id)->update(['image'=>$imagename]);
        }


        $file1=$request->file('icon_image');

        $oldicon_image=$request->input('oldicon_image');

        $imagename1='';

        if($file1){

            $destination_path='uploads';

            $imagename1=time().'__'.$file1->getClientOriginalName();

            $file1->move($destination_path,$imagename1);

            if($oldicon_image !=''){

                unlink(public_path('/uploads/'.$oldicon_image));
            }

            DB::table('case_management')->where('id',$id)->update(['icon_image'=>$imagename1]);
        }


        DB::table('case_management')->where('id',$id)->update(['title'=>$title,'description'=>$description]);

        return redirect('/admin/case_management')->with('error','data updated successfully!!!');
    }






    //new          new          new          new          new          new          new          new          new          new          new          new          new          new          new           




    public function add_more_cs_banner($id){

        $data['industry']=DB::table('industries')->get();

        $cs_banner_data=DB::table('cs_banner')->where('case_id',$id)->get();

        $data['cs_banner_data']=$cs_banner_data;

        $data['id']=$id;

        return view('admin.add_more_cs_banner',$data);
    }


    public function add_more_cs_banner_data($id){

        $data['id']=$id;

        $data['industry']=DB::table('industries')->get();

        $cs_banner=DB::table('cs_banner')->where('case_id',$id)->get();
        
        if(count($cs_banner)==0){

            $data['image']='';

            $data['title']='';

            $data['description']='';

            $data['d_id']=0;
        }
        else{

            $data['update_id']=$cs_banner[0]->id;

            $data['image']=$cs_banner[0]->image;

            $data['title']=$cs_banner[0]->title;

            $data['description']=$cs_banner[0]->description;

            $data['case_id']=$cs_banner[0]->case_id;

            $data['d_id']=100;
        }

        return view('admin.add_more_cs_banner_data',$data);
    }


    public function store_add_more_cs_banner_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);

        $d_id=$request->input('d_id');

        if($d_id ==0){

            $title=$request->input('title');

            $description=$request->input('description');

            $file=$request->file('image');

            $imagename='';

            if($file !=''){

                $destination_path='uploads';

                $imagename=time().'_'.$file->getClientOriginalName();

                $file->move($destination_path,$imagename);
            }

            DB::table('cs_banner')->insert(['image'=>$imagename , 'title'=>$title , 'description'=>$description , 'case_id'=>$id]);

            return redirect('/admin/add_more_cs_banner/'.$id)->with('error','data submitted successfully!!');
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

                DB::table('cs_banner')->where('case_id',$id)->update(['image'=>$imagename]);
            }

            DB::table('cs_banner')->where('case_id',$id)->update(['title'=>$title , 'description'=>$description]);

            return redirect('/admin/add_more_cs_banner/'.$id)->with('error','data updated successfully!!');
        }
    }


    public function add_more_cs_banner_list($id){

        $data['industry']=DB::table('industries')->get();

        $data['id']=$id;

        $cs_banner_main_list=DB::table('cs_banner_main_list')->get();

        $data['cs_banner_main_list']=$cs_banner_main_list;

        $cs_banner_list=DB::table('cs_banner_list')->where('case_id',$id)->get();

        $data['cs_banner_list']=$cs_banner_list;

        return view('admin.add_more_cs_banner_list',$data);
    }


    public function add_more_cs_banner_list_data($id){

        $data['id']=$id;

        $data['industry']=DB::table('industries')->get();

        $cs_banner_main_list=DB::table('cs_banner_main_list')->get();

        $data['cs_banner_main_list']=$cs_banner_main_list;

        return view('admin.add_more_cs_banner_list_data',$data);
    }

    public function store_add_more_cs_banner_list_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
            'name'=>'required',
        ]);

        $list_id=$request->input('title');

        $name=$request->input('name');

        $name1 = explode(",", $name);

             if($name !=''){

                foreach ($name1 as $key =>$l) {

                    DB::table('cs_banner_list')->insert(['name'=>$l, 'list_id'=>$list_id , 'case_id'=>$id]);
        
                }
            }

        return redirect('/admin/add_more_cs_banner_list/'.$id)->with('error','data submitted successfully!!');
    }

    public function delete_cs_banner_list($id){

        DB::table('cs_banner_list')->where('id',$id)->delete();

        return response()->json([
            'success' => 'Record has been deleted successfully!',
        ]);
    }


    public function add_more_cs_challenge($id){

        $data['industry']=DB::table('industries')->get();

        $cs_challenge_data=DB::table('cs_challenge')->where('case_id',$id)->get();

        $data['cs_challenge_data']=$cs_challenge_data;

        $data['id']=$id;

        $challenge_description=DB::table('cs_challenge_des')->where('case_id',$id)->get();

        $data['challenge_description']=$challenge_description;

        return view('admin.add_more_cs_challenge',$data);
    }


    public function add_more_cs_challenge_data($id){

        $data['id']=$id;

        $data['industry']=DB::table('industries')->get();

        $cs_challenge=DB::table('cs_challenge')->where('case_id',$id)->get();
        
        if(count($cs_challenge)==0){

            $data['title']='';

            $data['description']='';

            $data['d_id']=0;
        }
        else{

            $data['update_id']=$cs_challenge[0]->id;

            $data['title']=$cs_challenge[0]->title;

            $data['description']=$cs_challenge[0]->description;

            $data['case_id']=$cs_challenge[0]->case_id;

            $data['d_id']=100;
        }

        return view('admin.add_more_cs_challenge_data',$data);
    }


    public function store_add_more_cs_challenge_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);

        $d_id=$request->input('d_id');

        if($d_id ==0){

            $title=$request->input('title');

            $description=$request->input('description');




            $challenge_description=$request->input('challenge_description');

            if($challenge_description !=''){

                DB::table('cs_challenge_des')->insert(['description'=>$challenge_description , 'case_id'=>$id]);
            }

            

             $order_details = [];

             $challenge_descriptions=$request->input('challenge_descriptions');


             if($challenge_descriptions !=NULL){

                for($i= 0; $i < count($challenge_descriptions); $i++){

                  $order_details[] = [

                    'description' => $challenge_descriptions[$i],
                    'case_id'=>$id,
                  
                  ];

                }

                DB::table('cs_challenge_des')->insert($order_details);
            }

        
            

            DB::table('cs_challenge')->insert(['title'=>$title , 'description'=>$description ,'case_id'=>$id]);

            return redirect('/admin/add_more_cs_challenge/'.$id)->with('error','data submitted successfully!!');
        }

        else{

            $title=$request->input('title');

            $description=$request->input('description');

            $challenge_description=$request->input('challenge_description');

            if($challenge_description !=''){

                DB::table('cs_challenge_des')->insert(['description'=>$challenge_description , 'case_id'=>$id]);
            }

            

             $order_details = [];

             $challenge_descriptions=$request->input('challenge_descriptions');


             if($challenge_descriptions !=NULL){

                for($i= 0; $i < count($challenge_descriptions); $i++){

                  $order_details[] = [

                    'description' => $challenge_descriptions[$i],
                    'case_id'=>$id,
                  
                  ];

               }

               DB::table('cs_challenge_des')->insert($order_details);

             }

            

            DB::table('cs_challenge')->where('case_id',$id)->update(['title'=>$title , 'description'=>$description]);

            return redirect('/admin/add_more_cs_challenge/'.$id)->with('error','data updated successfully!!');
        }
    }

    public function add_section(){

        return response()->json([
            'success'=>'200',
        ]);
    }

    public function remove_section(){

        return response()->json([
            'success'=>'200',
        ]);
    }

    public function delete_add_more_cs_challenge($id){

        DB::table('cs_challenge_des')->where('id',$id)->delete();

        return response()->json([
            'success'=>'200',
        ]);
    }




    public function add_more_cs_expertise($id){

        $data['industry']=DB::table('industries')->get();

        $data['id']=$id;

        $cs_expertise=DB::table('cs_expertise')->where('case_id',$id)->get();

        $data['cs_expertise']=$cs_expertise;

        $cs_expertise_list=DB::table('cs_expertise_list')->where('case_id',$id)->get();

        $data['cs_expertise_list']=$cs_expertise_list;

        return view('admin.add_more_cs_expertise',$data);
    }


    public function add_more_cs_expertise_data($id){

        $data['id']=$id;

        $data['industry']=DB::table('industries')->get();

        $cs_expertise=DB::table('cs_expertise')->where('case_id',$id)->get();

        if(count($cs_expertise)==0){

            $data['title']='';

            $data['image']='';

            $data['d_id']=0;
        }
        else{

            $data['update_id']=$cs_expertise[0]->id;

            $data['title']=$cs_expertise[0]->title;

            $data['image']=$cs_expertise[0]->image;

            $data['case_id']=$cs_expertise[0]->case_id;

            $data['d_id']=100;
        }

        return view('admin.add_more_cs_expertise_data',$data);
    }

    public function store_add_more_cs_expertise_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
        ]);

        $d_id=$request->input('d_id');

        if($d_id ==0){

            $title=$request->input('title');

            $file=$request->file('image');

            $imagename='';

            if($file !=''){

                $destination_path='uploads';

                $imagename=time().'_'.$file->getClientOriginalName();

                $file->move($destination_path,$imagename);
            }

            DB::table('cs_expertise')->insert(['image'=>$imagename , 'title'=>$title ,'case_id'=>$id]);

            $list_id=DB::table('cs_expertise')->max('id');


            $name=$request->input('name');

            $name1 = explode(",", $name);

                 if($name !=''){

                    foreach ($name1 as $key =>$l) {

                        DB::table('cs_expertise_list')->insert(['name'=>$l, 'list_id'=>$list_id , 'case_id'=>$id]);
            
                    }
                }

            return redirect('/admin/add_more_cs_expertise/'.$id)->with('error','data submitted successfully!!');

        }

        else{

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

                DB::table('cs_expertise')->where('case_id',$id)->update(['image'=>$imagename]);
            }

            DB::table('cs_expertise')->where('case_id',$id)->update(['title'=>$title]);

            $cs_expertise_data=DB::table('cs_expertise')->where('case_id',$id)->get();

            $list_id=$cs_expertise_data[0]->id;

            $name=$request->input('name');

            $name1 = explode(",", $name);

             if($name !=''){

                foreach ($name1 as $key =>$l) {

                    DB::table('cs_expertise_list')->insert(['name'=>$l, 'list_id'=>$list_id , 'case_id'=>$id]);
        
                }
            }

            return redirect('/admin/add_more_cs_expertise/'.$id)->with('error','data submitted successfully!!');

        }
    }

    public function delete_cs_expertise($id){

        DB::table('cs_expertise_list')->where('id',$id)->delete();

        return response()->json([
            'success' => 'Record has been deleted successfully!',
        ]);
    }


    public function add_more_cs_solution($id){

        $data['industry']=DB::table('industries')->get();

        $data['id']=$id;

        $cs_solution=DB::table('cs_solution')->where('case_id',$id)->get();

        $data['cs_solution']=$cs_solution;

        return view('admin.add_more_cs_solution',$data);
    }


    public function add_more_cs_solution_data($id){

        $data['id']=$id;

        $data['industry']=DB::table('industries')->get();

        $cs_solution=DB::table('cs_solution')->where('case_id',$id)->get();

        if(count($cs_solution)==0){

            $data['description']='';

            $data['d_id']=0;
        }
        else{

            $data['update_id']=$cs_solution[0]->id;

            $data['description']=$cs_solution[0]->description;

            $data['case_id']=$cs_solution[0]->case_id;

            $data['d_id']=100;
        }

        return view('admin.add_more_cs_solution_data',$data);
    }

    public function store_add_more_cs_solution_data(Request $request,$id){

        $validated=$request->validate([
            'description'=>'required',
        ]);

        $d_id=$request->input('d_id');

        if($d_id ==0){

            $description=$request->input('description');

            DB::table('cs_solution')->insert(['description'=>$description ,'case_id'=>$id]);

            return redirect('/admin/add_more_cs_solution/'.$id)->with('error','data submitted successfully!!');

        }

        else{

            $description=$request->input('description');

            DB::table('cs_solution')->where('case_id',$id)->update(['description'=>$description]);

            return redirect('/admin/add_more_cs_solution/'.$id)->with('error','data updated successfully!!');

        }
    }







    public function add_more_cs_inner_detail($id){

        $data['industry']=DB::table('industries')->get();

        $cs_inner_detail_data=DB::table('cs_inner_detail')->where('case_id',$id)->get();

        $data['cs_inner_detail_data']=$cs_inner_detail_data;

        $data['id']=$id;

        return view('admin.add_more_cs_inner_detail',$data);
    }


    public function add_more_cs_inner_detail_data($id){

        $data['id']=$id;

        $data['industry']=DB::table('industries')->get();

        $cs_inner_detail=DB::table('cs_inner_detail')->where('case_id',$id)->get();
        
            $data['title']='';

            $data['d_id']=0;

        return view('admin.add_more_cs_inner_detail_data',$data);
    }


    public function store_add_more_cs_inner_detail_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
        ]);

            $title=$request->input('title');
            
            DB::table('cs_inner_detail')->insert(['title'=>$title , 'case_id'=>$id]);

            return redirect('/admin/add_more_cs_inner_detail/'.$id)->with('error','data submitted successfully!!');
        
    }




    public function update_add_more_cs_inner_detail_data($id){

        $data['id']=$id;

        $data['industry']=DB::table('industries')->get();

        $cs_inner_detail=DB::table('cs_inner_detail')->where('id',$id)->get();
        
            $data['id']=$cs_inner_detail[0]->id;

            $data['title']=$cs_inner_detail[0]->title;

            $data['case_id']=$cs_inner_detail[0]->case_id;

            $data['d_id']=100;

        return view('admin.update_add_more_cs_inner_detail_data',$data);
    }


    public function store_update_add_more_cs_inner_detail_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
        ]);

        $d_id=$request->input('d_id');

            $title=$request->input('title'); 

            DB::table('cs_inner_detail')->where('id',$id)->update(['title'=>$title ]);

            $cs_inner_detail=DB::table('cs_inner_detail')->where('id',$id)->get();

            $case_id=$cs_inner_detail[0]->case_id;

            return redirect('/admin/add_more_cs_inner_detail/'.$case_id)->with('error','data updated successfully!!');
        
    }





    public function add_more_cs_view_inner_detail($id){

        $data['industry']=DB::table('industries')->get();

        $cs_inner_detail_data=DB::table('cs_inner_detail')->where('id',$id)->get();

        $data['name']=$cs_inner_detail_data[0]->title;

        $data['case_id']=$cs_inner_detail_data[0]->case_id;

        $cs_inner_detail_des_data=DB::table('cs_inner_detail_des')->where('list_id',$id)->get();

        $data['cs_inner_detail_des_data']=$cs_inner_detail_des_data;

        $data['id']=$id;

        return view('admin.add_more_cs_view_inner_detail',$data);
    }


    public function add_more_cs_view_inner_detail_data($id){

        $data['id']=$id;

        $data['industry']=DB::table('industries')->get();

        return view('admin.add_more_cs_view_inner_detail_data',$data);
    }


    public function store_add_more_cs_view_inner_detail_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);

            $title=$request->input('title');

            $description=$request->input('description');
            
            DB::table('cs_inner_detail_des')->insert(['title'=>$title , 'description'=>$description  , 'list_id'=>$id]);




             $order_details = [];

             $titles=$request->input('titles');



             $descriptions=$request->input('descriptions');


             


             if($titles !=NULL){

                for($i= 0; $i < count($titles); $i++){

                  $order_details[] = [


                    'title' =>$titles[$i],
                    'description' => $descriptions[$i],
                    'list_id'=>$id,
                  
                  ];

               }
            }

           DB::table('cs_inner_detail_des')->insert($order_details);

            return redirect('/admin/add_more_cs_view_inner_detail/'.$id)->with('error','data submitted successfully!!');
        
        
    }

    

    public function delete_add_more_cs_view_inner_detail_data($id){

        DB::table('cs_inner_detail_des')->where('id',$id)->delete();

        return response()->json([
            'success'=>'200',
        ]);
    }


    public function delete_add_more_cs_inner_detail($id){

        DB::table('cs_inner_detail_des')->where('list_id',$id)->delete();

        return response()->json([
            'success'=>'200',
        ]);
    }




    public function add_more_cs_result($id){

        $data['industry']=DB::table('industries')->get();

        $cs_result_data=DB::table('cs_result')->where('case_id',$id)->get();

        $data['cs_result_data']=$cs_result_data;

        $data['id']=$id;

        $result_description=DB::table('cs_result_des')->where('case_id',$id)->get();

        $data['result_description']=$result_description;

        return view('admin.add_more_cs_result',$data);
    }


    public function add_more_cs_result_data($id){

        $data['id']=$id;

        $data['industry']=DB::table('industries')->get();

        $cs_result=DB::table('cs_result')->where('case_id',$id)->get();


        
        if(count($cs_result)==0){

            $data['description']='';

            $data['d_id']=0;
        }
        else{

            $data['update_id']=$cs_result[0]->id;

            $data['description']=$cs_result[0]->description;

            $data['case_id']=$cs_result[0]->case_id;

            $data['d_id']=100;
        }

        return view('admin.add_more_cs_result_data',$data);
    }


    public function store_add_more_cs_result_data(Request $request,$id){

        $validated=$request->validate([
            'description'=>'required',
        ]);

        $d_id=$request->input('d_id');

        if($d_id ==0){

            $description=$request->input('description');


            $result_description=$request->input('result_description');

            DB::table('cs_result_des')->insert(['description'=>$result_description , 'case_id'=>$id]);

             $order_details = [];

             $result_descriptions=$request->input('result_descriptions');


             if($result_descriptions !=NULL){

                for($i= 0; $i < count($result_descriptions); $i++){

                  $order_details[] = [

                    'description' => $result_descriptions[$i],
                    'case_id'=>$id,
                  
                  ];

                }
            }

           DB::table('cs_result_des')->insert($order_details);

            

            DB::table('cs_result')->insert([ 'description'=>$description ,'case_id'=>$id]);

            return redirect('/admin/add_more_cs_result/'.$id)->with('error','data submitted successfully!!');
        }

        else{


            $description=$request->input('description');

            $result_description=$request->input('result_description');

            if($result_description !=''){

                DB::table('cs_result_des')->insert(['description'=>$result_description , 'case_id'=>$id]);
            }

             $order_details = [];

             $result_descriptions=$request->input('result_descriptions');


             if($result_descriptions !=NULL){

                for($i= 0; $i < count($result_descriptions); $i++){

                  $order_details[] = [

                    'description' => $result_descriptions[$i],
                    'case_id'=>$id,
                  
                  ];

               }

               DB::table('cs_result_des')->insert($order_details);

             }

            

            DB::table('cs_result')->where('case_id',$id)->update([ 'description'=>$description]);

            return redirect('/admin/add_more_cs_result/'.$id)->with('error','data updated successfully!!');
        }
    }

    

    public function delete_add_more_cs_result($id){

        DB::table('cs_result_des')->where('id',$id)->delete();

        return response()->json([
            'success'=>'200',
        ]);
    }




    public function submit_form(Request $request){

        $validator=Validator::make($request->all(),[

            'name'=>'required',
            'email'=>'required',
            'phone_no'=>'required',
            'university'=>'required',
        ]);


    }

}
