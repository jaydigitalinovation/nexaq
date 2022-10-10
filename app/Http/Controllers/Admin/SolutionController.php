<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use DB;

class SolutionController extends Controller
{
    
    public function solution_team(){

        $data['industry']=DB::table('industries')->get();

        $solution_team_data=DB::table('solution_team')->get();

        $data['solution_team_data']=$solution_team_data;

        $solution_team_description=DB::table('solution_team_des')->get();

        $data['solution_team_description']=$solution_team_description;

        return view('admin.solution_team',$data);
    }


    public function add_solution_team_data($id){

        $data['industry']=DB::table('industries')->get();
        
        if($id==0){

            $data['description']='';

            $data['title']='';

            $data['id']=$id;
        }
        else{

            $solution_team=DB::table('solution_team')->where('id',$id)->get();

            $data['id']=$solution_team[0]->id;

            $data['title']=$solution_team[0]->title;

            $data['description']=$solution_team[0]->description;
        }

        return view('admin.add_solution_team_data',$data);
    }


    public function store_add_solution_team_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);

        if($id ==0){

            $title=$request->input('title');

            $description=$request->input('description');

            DB::table('solution_team')->insert([ 'description'=>$description ,'title'=>$title]);

            $s_id=DB::table('solution_team')->max('id');


            $team_description=$request->input('team_description');

            if($team_description !=''){

                DB::table('solution_team_des')->insert(['description'=>$team_description , 's_id'=>$s_id]);

            }


             $order_details = [];

             $team_descriptions=$request->input('team_descriptions');


             if($team_descriptions !=NULL){

                for($i= 0; $i < count($team_descriptions); $i++){

                  $order_details[] = [

                    'description' => $team_descriptions[$i],
                    's_id'=>$s_id,
                  
                  ];

                }
            }

           DB::table('solution_team_des')->insert($order_details);

            return redirect('/admin/solution_team')->with('error','data submitted successfully!!');
        }

        else{

            $title=$request->input('title');

            $description=$request->input('description');

            $team_description=$request->input('team_description');

            if($team_description !=''){

                DB::table('solution_team_des')->insert(['description'=>$team_description , 's_id'=>$id]);
            }

             $order_details = [];

             $team_descriptions=$request->input('team_descriptions');


             if($team_descriptions !=NULL){

                for($i= 0; $i < count($team_descriptions); $i++){

                  $order_details[] = [

                    'description' => $team_descriptions[$i],
                    's_id'=>$id,
                  
                  ];

                }
                DB::table('solution_team_des')->insert($order_details);
            }

            DB::table('solution_team')->where('id',$id)->update(['description'=>$description ,'title'=>$title]);

            return redirect('/admin/solution_team')->with('error','data updated successfully!!');
        }
    }

    

    public function delete_solution_team($id){

        DB::table('solution_team_des')->where('id',$id)->delete();

        return response()->json([
            'success'=>'200',
        ]);
    }




    public function solution_service(){

        $data['industry']=DB::table('industries')->get();

        $solution_service_data=DB::table('solution_service')->get();

        $data['solution_service_data']=$solution_service_data;

        $solution_service_description_data=DB::table('solution_service_description')->get();

        $data['solution_service_description_data']=$solution_service_description_data;

        return view('admin.solution_service',$data);
    }


    public function update_solution_service_description_data($id){

        $data['industry']=DB::table('industries')->get();
        
            $solution_service_description=DB::table('solution_service_description')->where('id',$id)->get();

            $data['id']=$solution_service_description[0]->id;

            $data['title']=$solution_service_description[0]->title;

            $data['description']=$solution_service_description[0]->description;
        

        return view('admin.update_solution_service_description_data',$data);
    }


    public function store_update_solution_service_description_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);


            $title=$request->input('title');

            $description=$request->input('description');

            
            DB::table('solution_service_description')->where('id',$id)->update(['description'=>$description ,'title'=>$title]);

            return redirect('/admin/solution_service')->with('error','data updated successfully!!');
        
    }


    public function add_solution_service_data($id){

        $data['industry']=DB::table('industries')->get();
        
        if($id==0){

            $data['image']='';

            $data['description']='';

            $data['title']='';

            $data['id']=$id;
        }
        else{

            $solution_service=DB::table('solution_service')->where('id',$id)->get();

            $data['id']=$solution_service[0]->id;

            $data['image']=$solution_service[0]->image;

            $data['title']=$solution_service[0]->title;

            $data['description']=$solution_service[0]->description;
        }

        return view('admin.add_solution_service_data',$data);
    }


    public function store_add_solution_service_data(Request $request,$id){

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

            DB::table('solution_service')->insert(['image'=>$imagename, 'description'=>$description ,'title'=>$title]);

            return redirect('/admin/solution_service')->with('error','data submitted successfully!!');
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

                DB::table('solution_service')->where('id',$id)->update(['image'=>$imagename ]);

            }
            
            DB::table('solution_service')->where('id',$id)->update(['description'=>$description ,'title'=>$title]);

            return redirect('/admin/solution_service')->with('error','data updated successfully!!');
        }
    }

    

    public function delete_solution_service($id){

        $userdata=DB::table('solution_service')->where('id',$id)->get();

        $image=$userdata[0]->image;

        if($image !=''){

            unlink(public_path('/uploads/'.$image));
        }

        DB::table('solution_service')->where('id',$id)->delete();

        return response()->json([
            'success'=>'200',
        ]);
    }




    public function solution_choose(){

        $data['industry']=DB::table('industries')->get();

        $solution_choose_data=DB::table('solution_choose')->get();

        $data['solution_choose_data']=$solution_choose_data;

        $solution_choose_description_data=DB::table('solution_choose_description')->get();

        $data['solution_choose_description_data']=$solution_choose_description_data;

        return view('admin.solution_choose',$data);
    }


    public function update_solution_choose_description_data($id){

        $data['industry']=DB::table('industries')->get();
        
            $solution_choose_description=DB::table('solution_choose_description')->where('id',$id)->get();

            $data['id']=$solution_choose_description[0]->id;

            $data['title']=$solution_choose_description[0]->title;

            $data['description']=$solution_choose_description[0]->description;
        

        return view('admin.update_solution_choose_description_data',$data);
    }


    public function store_update_solution_choose_description_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);


            $title=$request->input('title');

            $description=$request->input('description');

            
            DB::table('solution_choose_description')->where('id',$id)->update(['description'=>$description ,'title'=>$title]);

            return redirect('/admin/solution_choose')->with('error','data updated successfully!!');
        
    }


    public function add_solution_choose_data($id){

        $data['industry']=DB::table('industries')->get();
        
        if($id==0){

            $data['description']='';

            $data['title']='';

            $data['id']=$id;
        }
        else{

            $solution_choose=DB::table('solution_choose')->where('id',$id)->get();

            $data['id']=$solution_choose[0]->id;

            $data['title']=$solution_choose[0]->title;

            $data['description']=$solution_choose[0]->description;
        }

        return view('admin.add_solution_choose_data',$data);
    }


    public function store_add_solution_choose_data(Request $request,$id){

        $validated=$request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);

        if($id ==0){

            $title=$request->input('title');

            $description=$request->input('description');

            DB::table('solution_choose')->insert([ 'description'=>$description ,'title'=>$title]);

            return redirect('/admin/solution_choose')->with('error','data submitted successfully!!');
        }

        else{

            $title=$request->input('title');

            $description=$request->input('description');
            
            DB::table('solution_choose')->where('id',$id)->update(['description'=>$description ,'title'=>$title]);

            return redirect('/admin/solution_choose')->with('error','data updated successfully!!');
        }
    }

    

    public function delete_solution_choose($id){

        DB::table('solution_choose')->where('id',$id)->delete();

        return response()->json([
            'success'=>'200',
        ]);
    }
}
