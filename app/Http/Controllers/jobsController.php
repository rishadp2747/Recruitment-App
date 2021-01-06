<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Companydetail;
use App\Models\Appliedjob;
use App\Models\Studentdetail;
use App\Models\Qualifications;
use App\Models\Students_qualifications;
use App\Models\Jobs_qualifications;
use App\Models\User;
use App\Models\Allowed_users;
use Auth;
use DB;

class jobsController extends Controller
{

    public function add()
    {
          $user = Auth::user();
          $u_type = $user->user_type;
          $uname = $user->name;
          if($u_type==1){
            $qualification = Qualifications::all();
          $data = array( 'uname' => $uname, 'qualifications' => $qualification );
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
              session()->flash('errorinfo', 'In order to do any operation in this dashboard you have to complete your profile first. To complete your profile please <a href="./dashboard/profile">click here</a> !');
              return redirect()->route('home');
            }
            else{
          $req->validate([
              'title' => 'required|max:100|min:1|string',
              'minage' => 'nullable|integer|min:18|max:100',
              'maxage' => 'nullable|integer|min:18|max:100',
              'skills' => 'nullable|string|min:1|max:100',
              'qualification0' => 'nullable|integer|max:100',
              'specialisation0' => 'nullable|string|max:100',
              'cgpa0' => 'nullable|integer|max:100',
              'course0' => 'nullable|string|min:1|max:100',
              'hbacklogs0' => 'nullable|integer|max:100',
              'cbacklogs0' => 'nullable|integer|max:100',
              'last' => 'nullable|date_format:Y-m-d',
              'gender' => 'nullable|in:male,female,any',
          ]);
          $numb_val = 0;
          
        for($i=0;$i<100;$i++){
          $name= 'qualification'.strval($i);
          if(!empty($req->$name) && isset($req->$name)){
            $numb_val=$numb_val+1;
          }
          else{
            break;
          }
        }

          $key = substr(str_shuffle($email),0,10);
          $job = new Job;
          $job->Job_Id = $key;
          $job->Job_Title = $req->title;
          $job->Email = $email;
          $job->Skills_Required = $req->skills;
          $job->Min_Age = $req->minage;
          $job->Max_Age = $req->maxage;
          $job->gender = $req->gender;
          $job->last_date = $req->last;
          if($job->save()){
            for($i=0;$i<$numb_val;$i++){
              $acc = new Jobs_qualifications();
              $na1 = 'qualification'.strval($i);
              $na2 = 'course'.strval($i);
              $na3 = 'specialisation'.strval($i);
              $na4 = 'cgpa'.strval($i);
              $na5 = 'hbacklogs'.strval($i);
              $na6 = 'cbacklogs'.strval($i);
              $acc->Job_Id = $key;
              $acc->cbacklogs = $req->$na6;
              $acc->hbacklogs = $req->$na5;
              $acc->qualification = $req->$na1;
              $acc->course = $req->$na2;
              $acc->specialisation = $req->$na3;
              $acc->cgpa = $req->$na4;
              if($acc->save()){
                continue;
              }
              else{
                $data = Job::where('Job_Id',$key);
                $count = $data->delete();
                $data2 = Jobs_qualifications::where('Job_Id',$key);
                $count2 = $data2->delete();
                session()->flash('errorinfo', 'Something went wrong while adding the job, please try again !');
                return redirect()->route('home'); 
              }
            }
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
          $qualification = Qualifications::all();
          $jobs = Job::where('Email',$email)->get();
          $data = array( 'jobs' => $jobs, 'uname' => $uname, 'qualifications' => $qualification);
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
        $qualification = Qualifications::all();
        $jobs = Job::where('Job_Id',$id)->where('Email',$email)->get();
        $stud_qual = Jobs_qualifications::where('Job_Id',$id)->get();
        $count = count($jobs);
        if(!$count>0){
          session()->flash('errorinfo', 'Trying to access wrong Job_Id !');
          return redirect()->route('updateJob');
        }
        $data = array('stud_qual' => $stud_qual, 'jobs' => $jobs, 'uname' => $uname, 'qualifications' => $qualification);
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
          'minage' => 'nullable|integer|min:18|max:100',
          'maxage' => 'nullable|integer|min:18|max:100',
          'skills' => 'nullable|string|min:4|max:100',
          'last' => 'nullable|date_format:Y-m-d',
          'gender' => 'nullable|in:male,female,any',
      ]);
      $numb_val = 0;
          
        for($i=0;$i<100;$i++){
          $name= 'qualification'.strval($i);
          if(!empty($req->$name) && isset($req->$name)){
            $numb_val=$numb_val+1;
          }
          else{
            break;
          }
        }
          $job = Job::where('Job_Id',$req->id)->where('Email',$email)->first();
          if($job==null){
            session()->flash('errorinfo', 'Something went wrong while updating the job, please try again !');
            return redirect()->route('updateJob');
          }
          $job->Job_Title = $req->title;
          $job->Email = $email;
          $job->Skills_Required = $req->skills;
          $job->Min_Age = $req->minage;
          $job->Max_Age = $req->maxage;
          $job->gender = $req->gender;
          $job->last_date = $req->last;
          if($job->save()){
            $data4 = Jobs_qualifications::where('Job_Id',$req->id);
            $count4 = $data4->delete();
            for($i=0;$i<$numb_val;$i++){
              $acc = new Jobs_qualifications();
              $na1 = 'qualification'.strval($i);
              $na2 = 'course'.strval($i);
              $na3 = 'specialisation'.strval($i);
              $na4 = 'cgpa'.strval($i);
              $na5 = 'hbacklogs'.strval($i);
              $na6 = 'cbacklogs'.strval($i);
              $acc->Job_Id = $req->id;
              $acc->cbacklogs = $req->$na6;
              $acc->hbacklogs = $req->$na5;
              $acc->qualification = $req->$na1;
              $acc->course = $req->$na2;
              $acc->specialisation = $req->$na3;
              $acc->cgpa = $req->$na4;
              if($acc->save()){
                continue;
              }
              else{
                $data2 = Jobs_qualifications::where('Job_Id',$req->id);
                $count2 = $data2->delete();
                session()->flash('errorinfo', 'Something went wrong while updating the job, please try again !');
                return redirect()->route('home'); 
              }
            }
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
          $data2 = Jobs_qualifications::where('Job_Id',$id);
          $count2 = $data2->delete();
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
          $data_num = Students_qualifications::select(DB::raw('COUNT(email) AS occurrences'))
                          ->groupBy('email')
                          ->orderBy('occurrences', 'DESC')
                          ->limit(1)
                          ->get();
        $vv = 0;
        $hg = 0;
        foreach($d as $item){
        $n[] = User::select('name')->where('email',$item->Student_Email)->get()->first();
        $f[] = Studentdetail::where('email',$item->Student_Email)->get()->first();
        $j[] = Students_qualifications::where('email',$item->Student_Email)->get();
        $val = $j[$hg]->count();
        if($val>$vv){
          $vv = $val;
        }
        $hg = $hg + 1;
        }
        $c = count($n);
        $data = array( 'applied' => $d, 'uname' => $uname, 'stud_qual' => $j, 'data_num' => $vv, 'stud_det' => $f, 'count' => $c, 'name' => $n, 'info' => 'Applications under Review');
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
          $data_num = Students_qualifications::select(DB::raw('COUNT(email) AS occurrences'))
                          ->groupBy('email')
                          ->orderBy('occurrences', 'DESC')
                          ->limit(1)
                          ->get();
        $vv = 0;
        $hg = 0;
        foreach($d as $item){
        $n[] = User::select('name')->where('email',$item->Student_Email)->get()->first();
        $f[] = Studentdetail::where('email',$item->Student_Email)->get()->first();
        $j[] = Students_qualifications::where('email',$item->Student_Email)->get();
        $val = $j[$hg]->count();
        if($val>$vv){
          $vv = $val;
        }
        $hg = $hg + 1;
        }
        $c = count($n);
        $data = array( 'applied' => $d, 'uname' => $uname, 'stud_qual' => $j, 'data_num' => $vv, 'stud_det' => $f, 'count' => $c, 'name' => $n, 'info' => 'Applications Waitlisted');
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
          $data_num = Students_qualifications::select(DB::raw('COUNT(email) AS occurrences'))
                          ->groupBy('email')
                          ->orderBy('occurrences', 'DESC')
                          ->limit(1)
                          ->get();
        $vv = 0;
        $hg = 0;
        foreach($d as $item){
        $n[] = User::select('name')->where('email',$item->Student_Email)->get()->first();
        $f[] = Studentdetail::where('email',$item->Student_Email)->get()->first();
        $j[] = Students_qualifications::where('email',$item->Student_Email)->get();
        $val = $j[$hg]->count();
        if($val>$vv){
          $vv = $val;
        }
        $hg = $hg + 1;
        }
        $c = count($n);
        $data = array( 'applied' => $d, 'uname' => $uname, 'stud_qual' => $j, 'data_num' => $vv, 'stud_det' => $f, 'count' => $c, 'name' => $n, 'info' => 'Applications Approved');
        return view('company.jobs.appliedview')->with($data);
        }

      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }

    public function selectedview()
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){

        $d = Appliedjob::where('Company_Email',$email)->whereIn('Status', ['Approved', 'Selected', 'NotSelected'])->get();
        if($d->isEmpty()){
          $data = array('uname' => $uname, 'info' => 'Application Selection');
          return view('company.jobs.selectedview')->with($data);
        }
        else{
          $data_num = Students_qualifications::select(DB::raw('COUNT(email) AS occurrences'))
                          ->groupBy('email')
                          ->orderBy('occurrences', 'DESC')
                          ->limit(1)
                          ->get();
        $vv = 0;
        $hg = 0;
        foreach($d as $item){
        $n[] = User::select('name')->where('email',$item->Student_Email)->get()->first();
        $f[] = Studentdetail::where('email',$item->Student_Email)->get()->first();
        $j[] = Students_qualifications::where('email',$item->Student_Email)->get();
        $val = $j[$hg]->count();
        if($val>$vv){
          $vv = $val;
        }
        $hg = $hg + 1;
        }
        $c = count($n);
        $data = array( 'applied' => $d, 'uname' => $uname, 'stud_qual' => $j, 'data_num' => $vv, 'stud_det' => $f, 'count' => $c, 'name' => $n, 'info' => 'Application Selection');
        return view('company.jobs.selectedview')->with($data);
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
          $comp_qual = Jobs_qualifications::where('Job_Id',$d->Job_Id)->get();
          $qualification = Qualifications::all();
          $stud_n = User::select('name')->where('Email',$d->Student_Email)->get()->first();
          $student = Studentdetail::where('Email',$d->Student_Email)->get()->first();
          $stud_qual = Students_qualifications::where('email',$d->Student_Email)->get();
          $data = array( 'comp_qual' => $comp_qual, 'stud_qual' => $stud_qual, 'stud_n' => $stud_n, 'applied' => $d, 'uname' => $uname, 'job' => $job, 'student' => $student, 'qualifications' => $qualification);
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

    public function statuschangeselected(Request $req)
    {
      $user = Auth::user();
      $u_type = $user->user_type;
      $uname = $user->name;
      $email = $user->email;
      if($u_type==1){

        $req->validate([
          'u_id' => 'required|string',
          'status' => 'required|string|in:Selected,NotSelected'
        ]);

        $d = Appliedjob::where('U_Id',$req->u_id)->where('Company_Email',$email)->get()->first();
        if($d===null){
          session()->flash('errorinfo', "Application id and your job id's do not match, so not possible to update the status of the job !");
          return redirect()->back();
        }
        else{
          if($d->Status=='Rejected'){
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
