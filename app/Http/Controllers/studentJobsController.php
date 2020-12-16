<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Studentdetail;
use App\Models\Companydetail;
use App\Models\Qualifications;
use App\Models\Appliedjob;
use App\Models\User;
use Auth;

class studentJobsController extends Controller
{
    public function view()
    {
        $user = Auth::user();
        $u_type = $user->user_type;
        $uname = $user->name;
        $email = $user->email;
        if($u_type==0){

          $d = Appliedjob::select('Job_Id')->where('Student_Email',$email)->get();
          if($d===null){
            $jobs = Job::All();
            $data = array( 'jobs' => $jobs, 'uname' => $uname);
            return view('student.jobs.view')->with($data);
          }
          else{
            $jobs = Job::whereNotIn('Job_Id', $d)->get();
            $data = array( 'jobs' => $jobs, 'uname' => $uname);
            return view('student.jobs.view')->with($data);
          }


        }
        else{
          session()->flash('status', 'You are not allowed to do that operation !');
          return redirect()->route('home');
        }
    }

    public function applyview($id)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==0){
        $qualification = Qualifications::all();
        $data = Studentdetail::where('Email',$email)->get()->first();

        if($data===null){
          session()->flash('errorinfo', 'In order to apply for a job you have to update your profile first !');
          return redirect()->route('profile');
        }
        else{
          $dataj = Job::where('Job_Id',$id)->get()->first();
          if($dataj===null){
            session()->flash('status', 'No job data available !');
            return redirect()->route('home');
          }
          else{
          $c_name = User::select('name')->where('email',$dataj->Email)->get()->first();
          $datac = Companydetail::where('Email',$dataj->Email)->get()->first();
          $data = array( 'c_name' => $c_name, 'id' => $id, 'uname' => $uname, 'dataj' => $dataj, 'datac' => $datac , 'qualifications' => $qualification);
          return view('student.jobs.applyview')->with($data);
          }
        }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function applytodb(Request $req)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==0){

        $req->validate([
          'j_id' => 'string|required',
          'email' => 'string|required',
          'title' => 'string|required'
        ]);

        $d = Appliedjob::where('Student_Email',$email)->where('Job_Id',$req->j_id)->get()->first();
        if($d===null){
          $r_code = substr(str_shuffle($email),0,10);
          $status = 'Submitted';
          $data = new Appliedjob();
          $data->U_Id = $r_code;
          $data->Job_Id = $req->j_id;
          $data->Job_Title = $req->title;
          $data->Company_Email = $req->email;
          $data->Student_Email = $email;
          $data->Status = $status;
          if($data->save()){
            session()->flash('status', 'Applied for job Successfully !');
            return redirect()->route('home');
          } 
          else{
            session()->flash('errorinfo', 'Something went wrong while applying for the job, please try again !');
            return redirect()->back();  
          }
        }
        else{
          session()->flash('errorinfo', 'You have already applied for this job !');
          return redirect()->back();
        }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function applied()
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==0){

          $d = Appliedjob::where('Student_Email',$email)->get();
          $data = array( 'applied' => $d, 'uname' => $uname);
          return view('student.jobs.appliedview')->with($data);

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function appliedview($id)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==0){
          $d = Appliedjob::where('U_Id',$id)->where('Student_Email',$email)->get()->first();
          if($d!==null){
          $dataj = Job::where('Job_Id',$d->Job_Id)->get()->first();
          if($dataj===null){
            session()->flash('status', 'No job data available, for your applied job ( Company deleted the job ) !');
            return redirect()->route('home');
          }
          else{
          $qualification = Qualifications::all();
          $c_name = User::select('name')->where('email',$dataj->Email)->get()->first();
          $datac = Companydetail::where('Email',$dataj->Email)->get()->first();
          $data = array( 'c_name' => $c_name, 'id' => $id, 'uname' => $uname, 'dataj' => $dataj, 'datac' => $datac , 'status' => $d->Status, 'date' => $d->created_at, 'date_up' => $d->updated_at, 'qualifications' => $qualification);
          return view('student.jobs.appliedinfoview')->with($data);
          }
         }
         else{
           session()->flash('status', 'It seems like you have not applied for such job !');
           return redirect()->route('home');       
         }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function appliedelete(Request $req)
      {
        $user = Auth::user();
        $u_type = $user->user_type;
        $uname = $user->name;
        $email = $user->email;
        if($u_type==0){
  
            $req->validate([
               'u_id' => 'string|required'
            ]);

            $id = $req->u_id;
            $data = Appliedjob::where('U_Id',$id)->where('Student_Email',$email);
            $count = $data->delete();
            if($count===1){
                session()->flash('status', 'Application withdrawn Successfully !');
                return redirect()->route('home');
            }
            else{
                session()->flash('errorinfo', 'Error in withdrawing the application, please try again !');
                return redirect()->back();
            }
  
        }
        else{
          session()->flash('status', 'You are not allowed to do that operation !');
          return redirect()->route('home');
        }
      }
}
