<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use DB;
class ContactController extends Controller
{
   
   public function __construct(){

         $this->middleware('auth:admin');

      }

   public function contact_detail(){
 
       $admin=Auth::guard('admin')->user();

       
          $data['admin']=$admin;

         $data['site_url']= env('APP_URl');
         $data['metatitle']='home page';

         $id=Auth::id();
         $admin=Admin::where('id',$id)->get();

         $data['admin_name']=$admin[0]->name;

         $contact_detail=DB::table('contact_detail')->paginate(4);

         $data['contact_detail']=$contact_detail;

         return view('admin.contact_detail',$data);
      
     } 

      public function add_contact_detail(){
 
       $admin=Auth::guard('admin')->user();

       
          $data['admin']=$admin;

         $data['site_url']= env('APP_URl');
         $data['metatitle']='home page';

         $id=Auth::id();
         $admin=Admin::where('id',$id)->get();

         $data['admin_name']=$admin[0]->name;

    
         return view('admin.add_contact_detail',$data);
      
     } 

     public function store_contact_detail(Request $request){


          $error=$request->validate([

              'country' => 'required',
              'email' => 'required|email',
              'phone_no' => 'required',  
              'address' => 'required',  
               
            ]);
       
                $country=$request->input('country'); 
                $email=$request->input('email');    
                $phone_no=$request->input('phone_no'); 
                $address=$request->input('address'); 
         

            DB::table('contact_detail')->insert(['country'=>$country ,'email'=>$email,'phone_no'=>$phone_no,'address'=>$address,]);

       
           return redirect('admin/contact_detail')->with('error',' Contact detail data insert succcesfully!!!!');

     }

       public function update_contact_detail($id){


             $id1=Auth::id();
             $admin=Admin::where('id',$id1)->get();
             $data['admin_name']=$admin[0]->name;

             $contact_detail= DB::table('contact_detail')->where('id', $id)->get();

             $data['id']=$contact_detail[0]->id;
             $data['country']=$contact_detail[0]->country;
             $data['email']=$contact_detail[0]->email;
             $data['phone_no']=$contact_detail[0]->phone_no;
             $data['address']=$contact_detail[0]->address;
          
            
           return view('admin.update_contact_detail',$data);

       }


        public function store_update_contact_detail(Request $request ,$id){


          $error=$request->validate([

              'country' => 'required',
              'email' => 'required|email',
              'phone_no' => 'required',  
              'address' => 'required',  
               
            ]);
       
                $country=$request->input('country'); 
                $email=$request->input('email');    
                $phone_no=$request->input('phone_no'); 
                $address=$request->input('address'); 
         

            DB::table('contact_detail')->where('id',$id)->update(['country'=>$country ,'email'=>$email,'phone_no'=>$phone_no,'address'=>$address,]);

       
           return redirect('admin/contact_detail')->with('error',' Contact detail data updated succcesfully!!!!');

      }

       public function delete_contact_detail($id){

           DB::table('contact_detail')->where('id', $id)->delete();

           return response()->json([
            'success' => 'Record has been deleted successfully!'
           ]);

        }


         public function  delete_all_contact_detail(Request $request){

                $ids = $request->ids;

                 foreach($ids as $id){

                        DB::table('contact_detail')->where('id', $id)->delete();

                 }
  
                return response()->json(['status'=>200]);


               }


   }

