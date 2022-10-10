<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Auth;
use Hash;
use DB;

use Carbon\Carbon;

class AuthController extends Controller
{
    

    public function register()
    {
       // echo Carbon::now()->subdays(2);
      return view('registration');
    }

    public function storeuser(Request $request)
    {
        $error=$request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'terms_condition' => 'accepted'
        ]);

  
             $name=$request->input('name');
             $email=$request->input('email');
             $password=$request->input('password');
             $terms_condition=$request->input('terms_condition');
             $password1=Hash::make($password);


           $user = User::insert(['name'=>$name,'email'=>$email, 'password'=>$password1,'terms_condition'=>$terms_condition]);

            return redirect('/');
       
      // return redirect('/')->with('error', 'Registration Completed !!!');
     }

    public function login()
    {

      return view('login');
    }

    public function authenticate(Request $request)
    {
        $error=$request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect('/login')->with('success', 'Oppes! You have entered invalid credentials');
    }

    public function logout() {
      Auth::logout();

      return redirect('login');
    }

 /*   public function Changepassword(){
         

       // $id = Auth::user()->id;
       // echo $id;
      return view('auth.Changepassword');
    }*/

  /*  public function creatnewpassword(Changepassword_request $request,$id){


        

        $password=$request->input('password');
        $confirmpassword=$request->input('confirmpassword');

          $data['password']=$password;
          $data['confirmpassword']=$confirmpassword;
        //  $id = Auth::user()->id;
         

          if ($password==$confirmpassword) {

              $this->userService->creatnewpassword($request,$id);
              
            //  $password1=Hash::make($password);
          //  user::where('id', $id)->update(['password'=>$password1]);

             return redirect('login')->with('error', 'your password has been changed!!!!');;
            
          }else {
                   
                       return redirect('Changepassword')->with('error', 'password is not matched!!!!');
                  // return redirect('Changepassword')->with('error', 'password and confirm passwords does not matched!!!!');
          }

    }
*/
    //////////////////////////// forgot password////////////////////////

     public function forget_password()
    {
      
      return view('forgetpassword');
    }
     public function reset_password_url(Request $request){


         $error=$request->validate([
            'email' => 'required|email',
          
        ]);

         $email=$request->input('email');

           $user=User::where('email', $email)->count();

         if($user){
         
    
         
            $user_id=User::where('email',$email)->get();
            $id=$user_id[0]->id;

            // $img_url = env('APP_URL')."/uploads/1641381228_logo.png";
       
             $meta['FROM_EMAIL']="ditest787@gmail.com";
             $meta['email']=$request->email;
             $meta['subject']="reset password mail";  
          /*   $meta['image']= $img_url;*/
             $meta['id']= $id;
           
           
      
           Mail::send('email.userotp', $meta, function($m) use($meta){
        
               $m->from($meta['FROM_EMAIL'],'reset password mail');
               $m->to($meta['email']);
               $m->subject($meta['subject']); 
             });



    

             return redirect('/forget_password')->with('error', 'Password Reset url send on this email address !');

         

       } else{


        return redirect('/forget_password')->with('success', 'User is not available, Please Complete your Registration !');
      
        
          }

      }


      public function reset_password_view($id){

            $data['id']=$id;

        return view('reset_password_view',$data);

     }

     public function reset_password(Request $request,$id){



       $error=$request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

       echo $password1 =$request->input('password');


         $password=Hash::make($password1);


           DB::table('users')->where('id',$id)->update(['password' => $password]);

        return redirect('login')->with('error', 'Reset your password successfully !!!!');



     }

  


    public function home()
    {
       // echo Auth::user();
      return view('home');
    }
}

