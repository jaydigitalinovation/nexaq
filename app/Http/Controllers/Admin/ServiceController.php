<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\Admin;

class ServiceController extends Controller
{

     public function __construct(){

                $this->middleware('auth:admin');
        }

    public function servicelist(){

      $id=Auth::id();
      $admin=Admin::where('id',$id)->get();
      $data['admin_name']=$admin[0]->name;

      $banner=DB::table('banner')->paginate(3);
      $data['banner']=$banner;

      $data['industry']=DB::table('industries')->get();

      $data['servicelist']=DB::table('main_services')->get();

      $data['service_type']=DB::table('service_type')->get();

     return view('admin.servicelist',$data);

        
    }

    public function add_main_service($id){


     $id1=Auth::id();
     $admin=Admin::where('id',$id1)->get();
     $data['admin_name']=$admin[0]->name;

    $data['industry']=DB::table('industries')->get();


        if($id==0){

            $data['name']='';
            $data['type']='';
            $data['image']='';
            $data['short_description']='';
            $data['capabilities']='';
            $data['description']='';
            $data['id']=0;
            $data['service_type']=DB::table('service_type')->get();

          }else{

              $servicelist=DB::table('main_services')->where('id',$id)->get();
              $data['name']=$servicelist[0]->name;
              $data['image']=$servicelist[0]->image;
              $data['type']=$servicelist[0]->type;
              $data['short_description']=$servicelist[0]->sort_desc;
              $data['capabilities']=$servicelist[0]->capabilities;
              $data['description']=$servicelist[0]->description;
              $data['id']=$servicelist[0]->id;
             $data['service_type']=DB::table('service_type')->get();

          } 

       return view('admin.add_main_service',$data);

    }

    public function store_main_service(Request $request, $id){

           $name=$request->input('name');
           $type=$request->input('type');
           $description=$request->input('description');
           $short_description=$request->input('short_description');
           $capabilities=$request->input('capabilities');
           $file=$request->file('image');   

           if($id==0){

              $request->validate([

                 'name' => 'required',
                 'type' => 'required',
                 'image' => 'required',
                 'short_description' => 'required',
                 'capabilities' => 'required',
                 'description' => 'required',
                 
             ]);

               $imagename='';
    
               if($file){
       
                   $destinationPath='uploads';
                   $imagename=time().'_'.$file->getClientOriginalName();
                   $file->move($destinationPath,$imagename);
   
                 }

            DB::table('main_services')->insert(['image'=>$imagename,'name'=>$name,'description'=>$description,'type'=>$type,'sort_desc'=> $short_description,'capabilities'=>$capabilities]);

            DB::table('banner_image')->insert(['name'=>$name , 'image'=>'' , 'page_name'=>$name]); 

                return redirect('admin/servicelist')->with('error','data insert successfully'); 


             }else{


              $request->validate([

                 'name' => 'required',
                 'type' => 'required',
                 'short_description' => 'required',
                 'capabilities' => 'required',
                 'description' => 'required',
                 
             ]);

                  $imagename='';

                  if($file){
             
                    $destinationPath='uploads';
                    $imagename=time().'_'.$file->getClientOriginalName();
                    $file->move($destinationPath,$imagename);

                    DB::table('main_services')->where('id', $id)->update(['image'=>$imagename]);

                   if($request->input('oldimage')!='') {

                        unlink(public_path("/uploads/".$request->input('oldimage')));  
                     }
                  }


            DB::table('main_services')->where('id',$id)->update(['name'=>$name,'description'=>$description,'type'=>$type,'sort_desc'=> $short_description,'capabilities'=>$capabilities]); 

              return redirect('admin/servicelist')->with('error','data updated successfully'); 

             }



    }

    public function delete_main_service($id){



     $service=DB::table('main_services')->where('id', $id)->get();

     $name=$service[0]->name;

        if($service[0]->image!='') {

           unlink(public_path("/uploads/".$service[0]->image));

         }

    $banner_image = DB::table('banner_image')->where('name',$name)->get();

    if($banner_image[0]->image !=''){

        unlink(public_path('/uploads/'.$banner_image[0]->image));
    }

    DB::table('banner_image')->where('name',$name)->delete();

     DB::table('main_services')->where('id', $id)->delete();

       return response()->json([
        'success' => 'Record has been deleted successfully!'
       ]);


    }

    public function service_type(){


     $id1=Auth::id();
     $admin=Admin::where('id',$id1)->get();
     $data['admin_name']=$admin[0]->name;

     $data['industry']=DB::table('industries')->get();

     $data['service_type']=DB::table('service_type')->get();

     $data['aboutus_banner']=DB::table('banner_image')->where('name','Services')->get();

     return view('admin.service_type',$data);

    }

    public function add_service_type($id){


     $id1=Auth::id();
     $admin=Admin::where('id',$id1)->get();
     $data['admin_name']=$admin[0]->name;

    $data['industry']=DB::table('industries')->get();


        if($id==0){

            $data['name']='';
            $data['image']='';
            $data['description']='';
            $data['id']=0;

          }else{

              $service_type=DB::table('service_type')->where('id',$id)->get();
              $data['name']=$service_type[0]->name;
              $data['image']=$service_type[0]->image;
              $data['description']=$service_type[0]->description;
              $data['id']=$service_type[0]->id;
        
          }

         return view('admin.add_service_type',$data);

    }

    public function store_service_type(Request $request,$id){


           $name=$request->input('name');
          $description=$request->input('description');

           
           $file=$request->file('image');   

           if($id==0){

              $request->validate([

                 'name' => 'required',
                 'image' => 'required',
                 'description' => 'required',
                 
             ]);

               $imagename='';
    
               if($file){
       
                   $destinationPath='uploads';
                   $imagename=time().'_'.$file->getClientOriginalName();
                   $file->move($destinationPath,$imagename);
   
                 }

            DB::table('service_type')->insert(['image'=>$imagename,'name'=>$name,'description'=>$description]); 

                return redirect('admin/service_type')->with('error','data insert successfully'); 


             }else{

               $request->validate([

                 'name' => 'required',
                 'description' => 'required',
                 
                ]);

                  $imagename='';

                  if($file){
             
                    $destinationPath='uploads';
                    $imagename=time().'_'.$file->getClientOriginalName();
                    $file->move($destinationPath,$imagename);

                    DB::table('service_type')->where('id', $id)->update(['image'=>$imagename]);

                   if($request->input('oldimage')!='') {

                        unlink(public_path("/uploads/".$request->input('oldimage')));  
                     }
                  }


              DB::table('service_type')->where('id',$id)->update(['name'=>$name,'description'=>$description]); 

              return redirect('admin/service_type')->with('error','data updated successfully'); 

             }

     }

     public function delete_service_type($id){

       $service_type=DB::table('service_type')->where('id', $id)->get();

        if($service_type[0]->image!='') {

           unlink(public_path("/uploads/".$service_type[0]->image));

         }

        DB::table('service_type')->where('id', $id)->delete();

       return response()->json([
        'success' => 'Record has been deleted successfully!'
       ]);


     }

    public function sub_service($id){

        $data['industry']=DB::table('industries')->get();

        $sub_service=DB::table('sub_service')->where('services_id',$id)->get();

        $data['sub_service']=$sub_service;

        $main_services=DB::table('main_services')->where('id',$id)->get();

        $data['main_services']=$main_services;

        $services=DB::table('service_type')->where('id',$id)->get();

        $data['services']=$services;

        $banner_image=DB::table('banner_image')->get();

        $data['banner_image']=$banner_image;

        $sub_service_description=DB::table('sub_service_description')->where('services_id',$id)->get();

        if(count($sub_service_description)==0){

            $data['sub_service_description']='';
        }
        else{

            $data['sub_service_description']=$sub_service_description;
        }

        return view('admin.sub_service',$data);
    }

    public function add_sub_service($id){

        $data['id']=$id;

        $data['industry']=DB::table('industries')->get();

        return view('admin.add_sub_service',$data);
    }

    public function store_sub_service(Request $request,$id){

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

            DB::table('sub_service')->insert(['title'=>$title,'description'=>$description, 'services_id'=>$id ,'image'=>$imagename]);

            return redirect('/admin/sub_service/'.$id);
    }

    public function delete_sub_service($id){

        $userdata=DB::table('sub_service')->where('id', $id)->get();

        $image=$userdata[0]->image;

        if($image){
            unlink(public_path('/uploads/'.$image));
        }

        DB::table('sub_service')->where('id', $id)->delete();

        return response()->json([
         'success' => 'Record has been deleted successfully!'
        ]);
    }


    public function update_sub_service_data($id){

        $data['industry']=DB::table('industries')->get();

        $userdata=DB::table('sub_service')->where('id',$id)->get();

        $data['id']=$userdata[0]->id;

        $data['image']=$userdata[0]->image;

        $data['title']=$userdata[0]->title;

        $data['description']=$userdata[0]->description;

        return view('admin.update_sub_service',$data);

    }

    public function store_update_sub_service_data(Request $request,$id){

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

                DB::table('sub_service')->where('id',$id)->update(['image'=>$imagename]);
            }

            DB::table('sub_service')->where('id',$id)->update(['title'=>$title, 'description'=>$description]);

            $userdata=DB::table('sub_service')->where('id',$id)->get();

            $services_id=$userdata[0]->services_id;

            return redirect('/admin/sub_service/'.$services_id)->with('error','data updated successfully!!');
    }

    public function add_sub_service_description($id){

        $data['industry']=DB::table('industries')->get();

        $data['id']=$id;

        return view('admin.add_sub_service_description',$data);
    }

    public function store_sub_service_description(Request $request,$id){

        $validated=$request->validate([
                'title'=>'required',
                'description'=>'required',
            ]);

            $title=$request->input('title');

            $description=$request->input('description');

            DB::table('sub_service_description')->insert(['title'=>$title,'description'=>$description, 'services_id'=>$id ]);

            return redirect('/admin/sub_service/'.$id);
    }

    public function update_sub_service_description_data($id){

        $data['industry']=DB::table('industries')->get();

        $userdata=DB::table('sub_service_description')->where('id',$id)->get();

        $data['id']=$userdata[0]->id;

        $data['title']=$userdata[0]->title;

        $data['description']=$userdata[0]->description;

        return view('admin.update_sub_service_description_data',$data);
    }

    public function store_update_sub_service_description_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);

        $title=$request->input('title');

        $description=$request->input('description');

        DB::table('sub_service_description')->where('id',$id)->update(['title'=>$title , 'description'=>$description]);

        $userdata=DB::table('sub_service_description')->where('id',$id)->get();

        $services_id=$userdata[0]->services_id;

        return redirect('/admin/sub_service/'.$services_id);
    }

}
