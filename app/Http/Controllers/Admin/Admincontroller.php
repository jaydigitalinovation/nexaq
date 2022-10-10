<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\carbon;
use DB;
use Hash;
use \Crypt;
use Illuminate\support\facades\Auth;
use Illuminate\support\facades\Redirect;
use Illuminate\support\facades\validator;

class Admincontroller extends Controller{


   public function __construct(){

                $this->middleware('auth:admin');
        }

   public function home(){
 
       $admin=Auth::guard('admin')->user();

       
          $data['admin']=$admin;

         $data['site_url']= env('APP_URl');
         $data['metatitle']='home page';

         $id=Auth::id();
         $admin=Admin::where('id',$id)->get();

         $data['admin_name']=$admin[0]->name;

         $data['industry']=DB::table('industries')->get();

         return view('admin.home',$data);
      
     } 
    

     /*----------- change password ---------------*/

      public function changepassword(){
       
         return view('admin.change_password');
     }

      public function updatepassword(Request $request,$id){

          $error=$request->validate([
              'oldpassword' => 'required|string',
              'newpassword' => 'required|string|min:6',
           
              ]);

             $oldpassword=$request->input('oldpassword');
             $newpassword=$request->input('newpassword');

             $password=DB::table('admins')->where('id', $id)->get();

             $password1=$password[0]->password;

           if(Hash::check($oldpassword,$password1)){

               DB::table('admins')->where('id', $id)->update(['password'=>Hash::make($newpassword)]);

               return redirect('admin/home')->with('error','your password has been update sucessfully' );

               }else{

                return Redirect::back()->with('error','Your Old password is not correct!!!!');

            }
         }

         public function footer_about_us(){

            $data['industry']=DB::table('industries')->get();

              $admin=Auth::guard('admin')->user();

           
              $data['admin']=$admin;

             $id=Auth::id();
             $admin=Admin::where('id',$id)->get();

             $data['admin_name']=$admin[0]->name;

             $footer_about_us=DB::table('footer_about_us')->get();

             $data['footer_about_us']=$footer_about_us;

             return view('admin.footer_about',$data);


         }

         public function update_footer_about_us($id){

            $data['industry']=DB::table('industries')->get();

          $footer_about_us=DB::table('footer_about_us')->get();


          $data['id']=$footer_about_us[0]->id;
          $data['image']=$footer_about_us[0]->image;
          $data['description']=$footer_about_us[0]->description;

          return view('admin.update_footer_about',$data);


         }

         public function store_update_footer_about_us(Request $request, $id){

               $error=$request->validate([
             
                 'description' => 'required',
           
              ]);


                $description=$request->input('description');
                $file=$request->file('image');
          
                $imagename='';

                if($file){
         
                       $destinationPath='uploads';
                       $imagename=time().'_'.$file->getClientOriginalName();
                       $file->move($destinationPath,$imagename);

                       DB::table('footer_about_us')->where('id', $id)->update(['image'=>$imagename]);

                      if($request->input('oldimage')!='') {

                            unlink(public_path("/uploads/".$request->input('oldimage')));  
                         }
                      }

            DB::table('footer_about_us')->where('id', $id)->update(['description'=>$description]);

           return redirect('admin/footer_about_us')->with('error',' update Footer About us data succcesfully!!!!');


         }




         public function admin_detail(){

            $data['industry']=DB::table('industries')->get();

            $admin_detail=DB::table('admin_detail')->get();

            $data['admin_detail']=$admin_detail;

            return view('admin.admin_detail',$data);
         }



         public function add_admin_detail_data($id){

            if($id==0){

                    $data['name']='';
                    $data['email']='';
                    
                    $data['phone_no']='';
                    $data['address']='';

                    $data['id']=0;

                    $data['industry']=DB::table('industries')->get();

                  }else{

                      $admin_detail=DB::table('admin_detail')->where('id',$id)->get();

                    $data['name']=$admin_detail[0]->name;
                    $data['email']=$admin_detail[0]->email;

                    $data['phone_no']=$admin_detail[0]->phone_no;

                    $data['address']=$admin_detail[0]->address;

                    $data['id']=$admin_detail[0]->id;

                    $data['industry']=DB::table('industries')->get();


                  } 

               return view('admin.add_admin_detail_data',$data);
        }

        public function store_add_admin_detail_data(Request $request,$id){

            if($id==0){

                $validated=$request->validate([
                    'name'=>'required',
                    'email'=>'required|email',
                    'phone_no'=>'required',
                    'address'=>'required',
                ]);

                $name=$request->input('name');

                $email=$request->input('email');

                $phone_no=$request->input('phone_no');

                $address=$request->input('address');

                DB::table('admin_detail')->insert(['name'=>$name,'email'=>$email ,'phone_no'=>$phone_no,'address'=>$address ,]);

                return redirect('/admin/admin_detail')->with('error','data submitted successfully!!!');
            }else{

                $validated=$request->validate([
                    'name'=>'required',
                    'email'=>'required|email',
                    'phone_no'=>'required',
                    'address'=>'required',
                ]);

                $name=$request->input('name');

                $email=$request->input('email');

                $phone_no=$request->input('phone_no');

                $address=$request->input('address');

                DB::table('admin_detail')->where('id',$id)->update(['name'=>$name,'email'=>$email ,'phone_no'=>$phone_no,'address'=>$address ,]);

                return redirect('/admin/admin_detail')->with('error','data updated successfully!!!');
            }
        }


        public function delete_admin_detail($id){

            DB::table('admin_detail')->where('id', $id)->delete();

            return response()->json([
             'success' => 'Record has been deleted successfully!'
            ]);

        }
        
    }
   

  




