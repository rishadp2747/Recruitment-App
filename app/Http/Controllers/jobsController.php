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

class jobsController extends Controller
{

    public function add()
    {
          $user = Auth::user();
          $u_type = $user->user_type;
          $uname = $user->name;
          if($u_type==1){
          $data = array( 'uname' => $uname );
          return view('company.jobs.add')->with($data);
          }
          else{
            session()->flash('status', 'You are not allowed to do that operation !');
            return redirect()->route('home');
          }
    }

    public function addtodb(Request $req)
    {
          $user = Auth::user();
          $u_type = $user->user_type;
          $uname = $user->name;
          $email = $user->email;
          if($u_type==1){
            $data = Companydetail::where('Email',$email)->get()->first();

            if($data===null){
              session()->flash('errorinfo', 'In order to post a new job you have to update your profile first !');
              return redirect()->route('profile');
            }
            else{
          $req->validate([
              'title' => 'required|max:100|min:5|string',
              'salary' => 'required|integer|min:1',
              'description' => 'required|string|min:10|max:100',
              'minage' => 'required|integer|min:18|max:100',
              'maxage' => 'required|integer|min:18|max:100',
              'skills' => 'required|string|min:4|max:100',
              'qualification' => 'required|string|min:4|max:100'
          ]);
          $key = substr(str_shuffle($email),0,10);
          $job = new Job;
          $job->Job_Id = $key;
          $job->Job_Title = $req->title;
          $job->Email = $email;
          $job->Salary = $req->salary;
          $job->Min_Qualification = $req->qualification;
          $job->Project_Description = $req->description;
          $job->Skills_Required = $req->skills;
          $job->Min_Age = $req->minage;
          $job->Max_Age = $req->maxage;
          if($job->save()){
            session()->flash('status', 'Job Added Successfully !');
            return redirect()->route('home');
          } 
          else{
            session()->flash('errorinfo', 'Something went wrong while adding the job, please try again !');
            return redirect()->route('addJob');  
          }
          }
          }
          else{
            session()->flash('status', 'You are not allowed to do that operation !');
            return redirect()->route('home');
          }
    }

    public function view()
    {
        $user = Auth::user();
        $u_type = $user->user_type;
        $uname = $user->name;
        $email = $user->email;
        if($u_type==1){

          $jobs = Job::where('Email',$email)->get();
          $data = array( 'jobs' => $jobs, 'uname' => $uname);
          return view('company.jobs.view')->with($data);

        }
        else{
          session()->flash('status', 'You are not allowed to do that operation !');
          return redirect()->route('home');
        }
    }

    public function update()
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){

        $jobs = Job::where('Email',$email)->get();
        $data = array( 'jobs' => $jobs, 'uname' => $uname);
        return view('company.jobs.update')->with($data);

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function updateview($id)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){

        $jobs = Job::where('Job_Id',$id)->where('Email',$email)->get();
        $count = count($jobs);
        if(!$count>0){
          session()->flash('errorinfo', 'Trying to access wrong Job_Id !');
          return redirect()->route('updateJob');
        }
        $data = array( 'jobs' => $jobs, 'uname' => $uname);
        return view('company.jobs.updateview')->with($data);

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function updatefromdb(Request $req)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){
        
        $req->validate([
          'title' => 'required|max:100|min:5|string',
          'salary' => 'required|integer|min:1',
          'description' => 'required|string|min:10|max:100',
          'minage' => 'required|integer|min:18|max:100',
          'maxage' => 'required|integer|min:18|max:100',
          'skills' => 'required|string|min:4|max:100',
          'qualification' => 'required|string|min:4|max:100'
          ]);
          $job = Job::where('Job_Id',$req->id)->where('Email',$email)->first();
          if($job==null){
            session()->flash('errorinfo', 'Something went wrong while updating the job, please try again !');
            return redirect()->route('updateJob');
          }
          $job->Job_Title = $req->title;
          $job->Email = $email;
          $job->Salary = $req->salary;
          $job->Min_Qualification = $req->qualification;
          $job->Project_Description = $req->description;
          $job->Skills_Required = $req->skills;
          $job->Min_Age = $req->minage;
          $job->Max_Age = $req->maxage;
          if($job->save()){
            session()->flash('status', 'Job Updated Successfully !');
            return redirect()->route('home');
          } 
          else{
            session()->flash('errorinfo', 'Something went wrong while updating the job, please try again !');
            return redirect()->route('updateJob');  
          }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function delete()
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){
        
        $jobs = Job::where('Email',$email)->get();
        $data = array( 'jobs' => $jobs, 'uname' => $uname);
        return view('company.jobs.delete')->with($data);

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function deletefromdb(Request $req)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){

        $id = $req->id;
        $data = Job::where('Job_Id',$id)->where('Email',$email);
        $count = $data->delete();
        if($count===1){
          session()->flash('status', 'Job Deleted Successfully !');
          return redirect()->route('home');
        }
        else{
          session()->flash('errorinfo', 'Error in deleting the selected job, please try again !');
          return redirect()->route('deleteJob');
        }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function adduserview()
    {
          $user = Auth::user();
          $u_type = $user->user_type;
          $uname = $user->name;
          if($u_type==1){
          $data = array( 'uname' => $uname );
          return view('company.jobs.studentaddview')->with($data);
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
      if($u_type==1){
        
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
      if($u_type==1){
        
        $users = Allowed_users::All();
        $data = array( 'users' => $users, 'uname' => $uname);
        return view('company.jobs.studentdeleteview')->with($data);

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
      if($u_type==1){

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

    public function appliedview()
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){

        $d = Appliedjob::where('Company_Email',$email)->where('Status','Submitted')->get();
        if($d->isEmpty()){
          $data = array('uname' => $uname, 'info' => 'Students Applied for your Jobs');
          return view('company.jobs.appliedview')->with($data);
        }
        else{
        foreach($d as $item){
        $n[] = User::select('name')->where('email',$item->Student_Email)->get()->first();
        }
        $c = count($n);
        $data = array( 'applied' => $d, 'uname' => $uname, 'count' => $c, 'name' => $n, 'info' => 'Students Applied for your Jobs');
        return view('company.jobs.appliedview')->with($data);
        }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function reviewingview()
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){

        $d = Appliedjob::where('Company_Email',$email)->where('Status','Reviewing')->get();
        if($d->isEmpty()){
          $data = array('uname' => $uname, 'info' => 'Applications under Review');
          return view('company.jobs.appliedview')->with($data);
        }
        else{
        foreach($d as $item){
        $n[] = User::select('name')->where('email',$item->Student_Email)->get()->first();
        }
        $c = count($n);
        $data = array( 'applied' => $d, 'uname' => $uname, 'count' => $c, 'name' => $n, 'info' => 'Applications under Review');
        return view('company.jobs.appliedview')->with($data);
        }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function waitlistedview()
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){

        $d = Appliedjob::where('Company_Email',$email)->where('Status','Waitlisted')->get();
        if($d->isEmpty()){
          $data = array('uname' => $uname, 'info' => 'Applications Waitlisted');
          return view('company.jobs.appliedview')->with($data);
        }
        else{
        foreach($d as $item){
        $n[] = User::select('name')->where('email',$item->Student_Email)->get()->first();
        }
        $c = count($n);
        $data = array( 'applied' => $d, 'uname' => $uname, 'count' => $c, 'name' => $n, 'info' => 'Applications Waitlisted');
        return view('company.jobs.appliedview')->with($data);
        }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function approvedview()
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){

        $d = Appliedjob::where('Company_Email',$email)->where('Status','Approved')->get();
        if($d->isEmpty()){
          $data = array('uname' => $uname, 'info' => 'Applications Approved');
          return view('company.jobs.appliedview')->with($data);
        }
        else{
        foreach($d as $item){
        $n[] = User::select('name')->where('email',$item->Student_Email)->get()->first();
        }
        $c = count($n);
        $data = array( 'applied' => $d, 'uname' => $uname, 'count' => $c, 'name' => $n, 'info' => 'Applications Approved');
        return view('company.jobs.appliedview')->with($data);
        }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function rejectedview()
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){

        $d = Appliedjob::where('Company_Email',$email)->where('Status','Rejected')->get();
        if($d->isEmpty()){
          $data = array('uname' => $uname, 'info' => 'Applications Rejected');
          return view('company.jobs.appliedview')->with($data);
        }
        else{
        foreach($d as $item){
        $n[] = User::select('name')->where('email',$item->Student_Email)->get()->first();
        }
        $c = count($n);
        $data = array( 'applied' => $d, 'uname' => $uname, 'count' => $c, 'name' => $n, 'info' => 'Applications Rejected');
        return view('company.jobs.appliedview')->with($data);
        }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function appliedinfo($id)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){

        $d = Appliedjob::where('Company_Email',$email)->where('U_Id',$id)->get()->first();
        if($d===null){
           session()->flash('status', "Application id and your job id's do not match !");
           return redirect()->route('home');
        }
        else{
          if($d->Status=='Submitted'){
            $update = Appliedjob::where('Company_Email',$email)->where('U_Id',$id)->first();
            $update->Status = 'Reviewing';
            $update->save();
            $d->Status = 'Reviewing';
          }
          $job = Job::where('Job_Id',$d->Job_Id)->where('Email',$email)->get()->first();
          if($job===null){
            session()->flash('status', 'No job data available, for the application ( You deleted the job ) !');
            return redirect()->route('home');
          }
          $student = Studentdetail::where('Email',$d->Student_Email)->get()->first();
          $data = array( 'applied' => $d, 'uname' => $uname, 'job' => $job, 'student' => $student);
          return view('company.jobs.appliedinfoview')->with($data);
        }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function statuschange(Request $req)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){

        $req->validate([
          'u_id' => 'required|string',
          'status' => 'required|string|in:Waitlisted,Approved,Rejected'
        ]);

        $d = Appliedjob::where('U_Id',$req->u_id)->where('Company_Email',$email)->get()->first();
        if($d===null){
          session()->flash('errorinfo', "Application id and your job id's do not match, so not possible to update the status of the job !");
          return redirect()->back();
        }
        else{
          if($d->Status=='Rejected' || $d->Status=='Approved'){
            session()->flash('errorinfo', "Sorry the application has already been ".$d->Status.", so you cannot make any changes to the status !");
            return redirect()->back();
          }
          else{
            $change = Appliedjob::where('U_Id',$req->u_id)->where('Company_Email',$email)->first();
            $change->Status = $req->status;
            if($change->save()){
              session()->flash('successinfo', 'Status changed Successfully !');
              return redirect()->back();
            } 
            else{
              session()->flash('errorinfo', 'Something went wrong while changing the status, please try again !');
              return redirect()->back();  
            }
          }
          
        }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }
}
