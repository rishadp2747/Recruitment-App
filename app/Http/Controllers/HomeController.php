<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studentdetail;
use App\Models\Companydetail;
use App\Models\User;
use Auth;
use File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $u_type = $user->user_type;
        $uname = $user->name;
        if($u_type==0){
          $data = array('uname' => $uname );
          return view('student.dashboard')->with($data);
        }
        elseif($u_type==1){
          $data = array( 'uname' => $uname );
          return view('company.dashboard')->with($data);
        }
        elseif($u_type==2){
          $data = array( 'uname' => $uname );
          return view('admin.dashboard')->with($data);
        }
        else{
            Auth::logout();
            return redirect('login')->with('info', 'User Type is not valid !');
        }
    }

    public function approval_checker()
    {
        $user = Auth::user();
        $u_type = $user->user_type;
        $uname = $user->name;
        $approval_s = $user->approved;
        if($approval_s==0){
          return view('auth.approval');
        }
        elseif($approval_s==1){
          return redirect('dashboard');
        }
        elseif($approval_s==2){
          return view('auth.rejected');
        }
        else{
            Auth::logout();
            return redirect('login')->with('info', 'Something Went Wrong !');
        }
    }

    public function profile()
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==0){
        $data = Studentdetail::where('Email',$email)->get()->first();
        $data = array('uname' => $uname , 'data' => $data , 'email' => $email);
        return view('student.profile')->with($data);
      }
      elseif($u_type==1){
        #session()->flash('status', 'Profile page under construction !');
        #return redirect()->route('home');
        $data = Companydetail::where('Email',$email)->get()->first();
        $data = array('uname' => $uname , 'data' => $data , 'email' => $email);
        return view('company.profile')->with($data);
      }
      elseif($u_type==2){
        session()->flash('status', 'Profile page is disabled for the admin !');
        return redirect()->route('home');
      }
      else{
          Auth::logout();
          return redirect('login')->with('info', 'User Type is not valid !');
      }
    }

    public function profileUpdate(Request $req)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==0){

        if($req->photo===null){
             if($req->photoval===null){
               return back()->with('errorinfo','You have to upload a image (photo).')->withInput($req->input());
             }
        }

        if($req->cv===null){
          if($req->cvval===null){
               return back()->with('errorinfo','You have to upload a cv.')->withInput($req->input());
          }
        }

        if($req->cert===null){
          if($req->certval===null){
               return back()->with('errorinfo','You have to upload certificates.')->withInput($req->input());
          }
        }

        $req->validate([
            'name' => 'required|string|min:2|max:100',
            'age' => 'required|integer|min:18|max:100',
            'address' => 'required|string|min:10|max:500',
            'bio' => 'required|string|min:5|max:200',
            'skills' => 'required|string|min:5|max:200',
            'dob' => 'required|date_format:Y-m-d',
            'phoneno' => 'required|digits:10',
            'volunteership' => 'required|string|min:5|max:200',
            'backlogs' => 'required|integer|min:0|max:100',
            'current_backlogs' => 'required|integer|min:0|max:100',
            'linkedin' => 'required|url',
            'github' => 'required|url'
        ]);

        #$new = (explode("-",$req->dob));
        #$req->dob = $new[2].'-'.$new[1].'-'.$new[0];

        if($req->file('photo')){
          $req->validate([
           'photo' => 'image|max:1024'
          ]);
          if($req->photoval!==null){
            File::delete(public_path('storage/uploads/student/photo/'.$req->photoval));
          }
          $file = $req->file('photo');
          $ext = $file->getClientOriginalExtension();
          $fname =  str_replace(' ', '', strtolower($req->name)).'photo'.time().'.'.$ext;
          $req->file('photo')->storeAs('uploads/student/photo', $fname, 'public');
          $req->photo = $fname;
        }
        else{
          $req->photo = $req->photoval;
        }

        if($req->file('cv')){
          $req->validate([
            'cv' => 'mimes:pdf|max:2048'
           ]);
          if($req->cvval!==null){
            File::delete(public_path('storage/uploads/student/cv/'.$req->cvval));
          }
          $file1 = $req->file('cv');
          $ext1 = $file1->getClientOriginalExtension();
          $fname1 =  str_replace(' ', '', strtolower($req->name)).'cv'.time().'.'.$ext1;
          $req->file('cv')->storeAs('uploads/student/cv', $fname1, 'public');
          $req->cv = $fname1;
        }
        else{
          $req->cv = $req->cvval;
        }

        if($req->file('cert')){
          $req->validate([
            'cert' => 'mimes:pdf|max:2048'
           ]);
          if($req->certval!==null){
            File::delete(public_path('storage/uploads/student/certificates/'.$req->certval));
          }
          $file2 = $req->file('cert');
          $ext2 = $file2->getClientOriginalExtension();
          $fname2 =  str_replace(' ', '', strtolower($req->name)).'certificates'.time().'.'.$ext2;
          $req->file('cert')->storeAs('uploads/student/certificates', $fname2, 'public');
          $req->cert = $fname2;
        }
        else{
          $req->cert = $req->certval;
        }

        if($req->photoval===null){
          if($req->name!=$uname){
            $datas = User::where('Email',$email)->first();
            $datas->name = $req->name;
            $datas->save();
          }
        $details = new Studentdetail();
        $details->Email = $email;
        $details->Age = $req->age;
        $details->DOB = $req->dob;
        $details->Phoneno = $req->phoneno;
        $details->Address = $req->address;
        $details->Bio = $req->bio;
        $details->Skills = $req->skills;
        $details->CV = $req->cv;
        $details->Certificates = $req->cert;
        $details->Photo = $req->photo;
        $details->Volunteership = $req->volunteership;
        $details->Backlogs = $req->backlogs;
        $details->Current_Backlogs = $req->current_backlogs;
        $details->Linkedin = $req->linkedin;
        $details->Github = $req->github;
        if($details->save()){
          session()->flash('status', 'Profile updated Successfully !');
          return redirect()->route('home');
        } 
        else{
          session()->flash('errorinfo', 'Something went wrong while updating your profile, please try again !');
          return redirect()->route('profile');  
        }
        }
        else{
          if($req->name!=$uname){
            $datas = User::where('Email',$email)->first();
            $datas->name = $req->name;
            $datas->save();
          }
          $details = Studentdetail::where('Email',$email)->first();
          $details->Email = $email;
          $details->Age = $req->age;
          $details->DOB = $req->dob;
          $details->Phoneno = $req->phoneno;
          $details->Address = $req->address;
          $details->Bio = $req->bio;
          $details->Skills = $req->skills;
          $details->CV = $req->cv;
          $details->Certificates = $req->cert;
          $details->Photo = $req->photo;
          $details->Volunteership = $req->volunteership;
          $details->Backlogs = $req->backlogs;
          $details->Current_Backlogs = $req->current_backlogs;
          $details->Linkedin = $req->linkedin;
          $details->Github = $req->github;
          if($details->save()){
            session()->flash('status', 'Profile updated Successfully !');
            return redirect()->route('home');
          } 
          else{
            session()->flash('errorinfo', 'Something went wrong while updating your profile, please try again !');
            return redirect()->route('profile');  
          }
        }


      }
      elseif($u_type==1){

        if($req->photo===null){
          if($req->photoval===null){
            return back()->with('errorinfo','You have to upload a image (photo).')->withInput($req->input());
          }
        }

        $req->validate([
          'name' => 'required|string|min:2|max:100',
          'address' => 'required|string|min:10|max:500',
          'description' => 'required|string|min:5|max:200',
          'phoneno' => 'required|digits:10'
         ]);

         if($req->file('photo')){
          $req->validate([
           'photo' => 'image|max:1024'
          ]);
          if($req->photoval!==null){
            File::delete(public_path('storage/uploads/company/photo/'.$req->photoval));
          }
          $file = $req->file('photo');
          $ext = $file->getClientOriginalExtension();
          $fname =  str_replace(' ', '', strtolower($req->name)).'photo'.time().'.'.$ext;
          $req->file('photo')->storeAs('uploads/company/photo', $fname, 'public');
          $req->photo = $fname;
        }
        else{
          $req->photo = $req->photoval;
        }

        if($req->photoval===null){
          if($req->name!=$uname){
            $datas = User::where('Email',$email)->first();
            $datas->name = $req->name;
            $datas->save();
          }
          $details = new Companydetail();
          $details->Email = $email;
          $details->Phoneno = $req->phoneno;
          $details->Address = $req->address;
          $details->Description = $req->description;
          $details->Photo = $req->photo;
          if($details->save()){
            session()->flash('status', 'Profile updated Successfully !');
            return redirect()->route('home');
          } 
          else{
            session()->flash('errorinfo', 'Something went wrong while updating your profile, please try again !');
            return redirect()->route('profile');  
          }
          }
          else{
            if($req->name!=$uname){
              $datas = User::where('Email',$email)->first();
              $datas->name = $req->name;
              $datas->save();
            }
            $details = Companydetail::where('Email',$email)->first();
            $details->Email = $email;
            $details->Phoneno = $req->phoneno;
            $details->Address = $req->address;
            $details->Description = $req->description;
            $details->Photo = $req->photo;
            if($details->save()){
              session()->flash('status', 'Profile updated Successfully !');
              return redirect()->route('home');
            } 
            else{
              session()->flash('errorinfo', 'Something went wrong while updating your profile, please try again !');
              return redirect()->route('profile');  
            }
          }

        #session()->flash('status', 'Profile page under construction !');
        #return redirect()->route('home');
      }
      elseif($u_type==2){
        session()->flash('status', 'Profile page is disabled for the admin !');
        return redirect()->route('home');
      }
      else{
          Auth::logout();
          return redirect('login')->with('info', 'User Type is not valid !');
      }
    }
}
