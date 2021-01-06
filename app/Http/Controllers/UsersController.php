<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Companydetail;
use App\Models\Appliedjob;
use App\Models\Studentdetail;
use App\Models\User;
use App\Models\Allowed_users;
use Auth;

class UsersController extends Controller
{
    public function adduserview()
    {
          $user = Auth::user();
          $u_type = $user->user_type;
          $uname = $user->name;
          $email = $user->email;
          if($u_type==1){
            $data = array( 'uname' => $uname );
            return view('company.jobs.studentaddview')->with($data);
          }
          elseif($u_type==2){
            $data = array( 'uname' => $uname );
            return view('admin.student.addview')->with($data);
          }
          else{
            session()->flash('status', 'You are not allowed to do that operation !');
            return redirect()->route('home');
          }
    }

    public function addusertodb(Request $req)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1 || $u_type==2){
        $data_check = Companydetail::where('Email',$email)->get()->first();
          if($data_check===null){
            session()->flash('errorinfo_prof', 'In order to do any operation in this dashboard you have to complete your profile first. To complete your profile please <a href="./dashboard/profile">click here</a> !');
            return redirect()->route('home');
          }
        
        $req->validate([
          'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'
          ]);

        if($email==$req->email){
          session()->flash('errorinfo', 'You cannot add yourself as a student !');
          return redirect()->route('studentadd');  
        }

        $u_ex = User::where('email', '=', $req->email)->where('user_type', '=', 1)->exists();

        if($u_ex){
          session()->flash('errorinfo', 'You are trying to add a company user as a student which is not permitted !');
          return redirect()->route('studentadd');  
        }

        $u_exist = Allowed_users::where('email', '=', $req->email)->exists();

        if($u_exist){
          session()->flash('errorinfo', 'User is already in the allowed list !');
          return redirect()->route('studentadd');  
        }

        $a_usr = new Allowed_users;
        $a_usr->Email = $req->email;
        $a_usr->Admin_Email = $email;
        if($a_usr->save()){
          session()->flash('status', 'Student Added Successfully !');
          return redirect()->route('home');
        } 
        else{
          session()->flash('errorinfo', 'Something went wrong while adding the student, please try again !');
          return redirect()->route('studentadd');  
        }


      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function allowedusersview()
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==2 ){
        
        $users = Allowed_users::All();
        $data = array( 'users' => $users, 'uname' => $uname);
        return view('admin.student.deleteview')->with($data);

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function allowedcompanyview()
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==2){
        
        $users = User::where('user_type',1)->get();
        $data = array( 'users' => $users, 'uname' => $uname);
        return view('admin.company.deleteview')->with($data);

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function companyapprovalview()
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==2){
        
        $users = User::where('user_type',1)->where('approved',0)->get();
        $data = array( 'users' => $users, 'uname' => $uname);
        return view('admin.company.approveview')->with($data);

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function companyapprove(Request $req)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==2){
        
        $email2 = $req->email;
        $users = User::where('email',$email2)->first();
        $users->approved = 1;
        if($users->save()){
            session()->flash('status', 'Company Approved Successfully !');
            return redirect()->route('companyapproval');
        } 
        else{
            session()->flash('errorinfo', 'Something went wrong while updating the job, please try again !');
            return redirect()->route('companyapproval');  
          }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function companyreject(Request $req)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==2){
        
        $email2 = $req->email;
        $users = User::where('email',$email2)->first();
        $users->approved = 2;
        if($users->save()){
            session()->flash('status', 'Company Rejected Successfully !');
            return redirect()->route('companyapproval');
        } 
        else{
            session()->flash('errorinfo', 'Something went wrong while updating the job, please try again !');
            return redirect()->route('companyapproval');  
          }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function deleteuserfromdb(Request $req)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==2){

        $id = $req->id;
        $email2 = $req->email;
        $u_ex = User::where('email', '=', $email2)->exists();
        if($u_ex){
          $data2 = User::where('email',$email2)->where('user_type',0);
          $count2 = $data2->delete();
        }
        else{
          $count2 = 1;
        }
        if($count2===1){
          $data = Allowed_users::where('id',$id);
          $count1 = $data->delete();
          $s_ex = Studentdetail::where('email', '=', $email2)->exists();
          if($s_ex){
            $data3 = Studentdetail::where('Email',$email2);
            $count3 = $data3->delete();
          }
          else{
            $count3 = 1;
          }
          $j_ex = Appliedjob::where('Student_Email', '=', $email2)->exists();
          if($j_ex){
            $data4 = Appliedjob::where('Student_Email',$email2);
            $count4 = $data4->delete();
          }
          else{
            $count4 = 1;
          }
        }
        else{
          $count1 = 0;
          $count3 = 0;
          $count4 = 0;
        }
        if($count1===1 && $count2===1 && $count3===1 && $count4===1){
          session()->flash('status', 'User ('.$email2.') Deleted Successfully !');
          return redirect()->route('studentdelete');
        }
        else{
          session()->flash('errorinfo', 'Error in deleting the selected user, please try again !');
          return redirect()->route('studentdelete');
        }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function deletecompanyfromdb(Request $req)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==2){

        $id = $req->id;
        $email2 = $req->email;
        $u_ex = User::where('email', '=', $email2)->exists();
        if($u_ex){
          $data2 = User::where('email',$email2)->where('user_type',1);
          $count2 = $data2->delete();
        }
        else{
          $count2 = 1;
        }
        if($count2===1){
          $f_ex = Job::where('email', '=', $email2)->exists();
          if($f_ex){
            $data3 = Job::where('Email',$email2);
            $count1 = $data3->delete();
          }
          else{
            $count1 = 1;
          }
          $s_ex = Companydetail::where('email', '=', $email2)->exists();
          if($s_ex){
            $data3 = Companydetail::where('Email',$email2);
            $count3 = $data3->delete();
          }
          else{
            $count3 = 1;
          }
          $j_ex = Appliedjob::where('Company_Email', '=', $email2)->exists();
          if($j_ex){
            $data4 = Appliedjob::where('Company_Email',$email2);
            $count4 = $data4->delete();
          }
          else{
            $count4 = 1;
          }
        }
        else{
          $count1 = 0;
          $count3 = 0;
          $count4 = 0;
        }
        if($count1===1 && $count2===1 && $count3===1 && $count4===1){
          session()->flash('status', 'Company ('.$email2.') Deleted Successfully !');
          return redirect()->route('companydelete');
        }
        else{
          session()->flash('errorinfo', 'Error in deleting the selected company, please try again !');
          return redirect()->route('companydelete');
        }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }
}
