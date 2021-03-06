<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Studentdetail;
use App\Models\Companydetail;
use App\Models\Qualifications;
use App\Models\Job;
use App\Models\Appliedjob;
use App\Models\AsapCourses;
use App\Models\Students_qualifications;
use App\Models\Volunteership;
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
        $email = $user->email;
        if($u_type==0){
          $data_check = Studentdetail::where('Email',$email)->get()->first();
          if($data_check===null){
            $p_status = 'no';
          }
          else{
            $p_status = 'yes';
          }
          $a = Appliedjob::where('Student_Email',$email)->get();
          $a_count = count($a);
          $a_rev = Appliedjob::where('Student_Email',$email)->where('Status','Reviewing')->get();
          $a_count_rev = count($a_rev);
          $a_app = Appliedjob::where('Student_Email',$email)->where('Status','Approved')->get();
          $a_count_app = count($a_app);
          $a_rej = Appliedjob::where('Student_Email',$email)->where('Status','Rejected')->get();
          $a_count_rej = count($a_rej);
          $a_sel = Appliedjob::where('Student_Email',$email)->where('Status','Selected')->get();
          $a_count_sel = count($a_sel);
          $a_not = Appliedjob::where('Student_Email',$email)->where('Status','NotSelected')->get();
          $a_count_not = count($a_not);
          $data = array( 'uname' => $uname , 'p_status' => $p_status, 'a_count' => $a_count, 'a_count_rev' => $a_count_rev, 'a_count_app' => $a_count_app, 'a_count_rej' => $a_count_rej, 'a_count_sel' => $a_count_sel, 'a_count_not' => $a_count_not);
          return view('student.dashboard')->with($data);
        }
        elseif($u_type==1){
          $data_check = Companydetail::where('Email',$email)->get()->first();
          if($data_check===null){
              $p_status = 'no';
            }
            else{
              $p_status = 'yes';
            }
            $j = Job::where('Email',$email)->get();
            $j_count = count($j);
            $a = Appliedjob::where('Company_Email',$email)->get();
            $a_count = count($a);
            $data = array( 'uname' => $uname , 'p_status' => $p_status, 'j_count' => $j_count, 'a_count' => $a_count);
          return view('company.dashboard')->with($data);
        }
        elseif($u_type==2){
          $s = User::where('user_type',0)->get();
          $s_count = count($s);
          $c = User::where('user_type',1)->get();
          $c_count = count($c);
          $j = Job::get();
          $j_count = count($j);
          $a = Appliedjob::get();
          $a_count = count($a);
          $all_application = ["Applied","Reviewing","Waitlisted","Approved","Rejected","Selected","NotSelected"];
          $gh = 1;
          foreach($all_application as $it){
            ${"ap".$gh} = Appliedjob::where('Status',$it)->get();
            ${"c_".$gh} = count(${"ap".$gh});
            $gh = $gh + 1;
          }
          $cert_applications = ["Selected","NotSelected"];
          $ghh = 2;
          foreach($cert_applications as $itt){
            ${"d".$ghh} = Appliedjob::where('Status',$itt)->get();
            if(${"d".$ghh}->isEmpty()){
              ${"cert_count".$ghh} = 0;
              ${"comp_n".$ghh} = 0;
              ${"j".$ghh} = 0;
              ${"vv".$ghh} = 0;
              ${"f".$ghh} = 0;
              ${"n".$ghh} = 0;
            }
            else{
            ${"cert_count".$ghh} = 1;
            ${"vv".$ghh} = 0;
            ${"hg".$ghh} = 0;
            foreach(${"d".$ghh} as $item){
            ${"comp_n".$ghh}[] = User::select('name')->where('email',$item->Company_Email)->get()->first();
            ${"n".$ghh}[] = User::select('name')->where('email',$item->Student_Email)->get()->first();
            ${"f".$ghh}[] = Studentdetail::where('email',$item->Student_Email)->get()->first();
            ${"j".$ghh}[] = Students_qualifications::where('email',$item->Student_Email)->get();
            ${"val".$ghh} = ${"j".$ghh}[${"hg".$ghh}]->count();
            if(${"val".$ghh}>${"vv".$ghh}){
              ${"vv".$ghh} = ${"val".$ghh};
            }
            ${"hg".$ghh} = ${"hg".$ghh} + 1;
            }
            }
            $ghh = $ghh + 1;
          }
          $data = array( 'uname' => $uname , 's_count' => $s_count, 'c_count' => $c_count, 'j_count' => $j_count, 'a_count' => $a_count, 'c_1' => $c_1, 'c_2' => $c_2, 'c_3' => $c_3, 'c_4' => $c_4, 'c_5' => $c_5, 'c_6' => $c_6, 'c_7' => $c_7, 'comp_name2' => $comp_n2, 'applied2' => $d2, 'stud_qual2' => $j2, 'data_num2' => $vv2, 'stud_det2' => $f2, 'name2' => $n2, 'comp_name3' => $comp_n3, 'applied3' => $d3, 'stud_qual3' => $j3, 'data_num3' => $vv3, 'stud_det3' => $f3, 'name3' => $n3, 'cert_count2' => $cert_count2, 'cert_count3' => $cert_count3);
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
        $qualification = Qualifications::all();
        $asap_courses = AsapCourses::all();
        $volunteership = Volunteership::all();
        $stud_qual = Students_qualifications::where('Email',$email)->get();

        $data = Studentdetail::where('Email',$email)->get()->first();
        if($data){
          $stat = 'yes';
        }
        else{
          $stat = 'no';
        }
        $data = array('stud_qual' => $stud_qual, 'status' => $stat, 'uname' => $uname , 'data' => $data , 'email' => $email, 'qualifications' => $qualification, 'asap' => $asap_courses, 'volunteership_ss' => $volunteership );
        return view('student.profile')->with($data);
      }
      elseif($u_type==1){
        $data = Companydetail::where('Email',$email)->get()->first();
        if($data){
          $stat = 'yes';
        }
        else{
          $stat = 'no';
        }
        $data = Companydetail::where('Email',$email)->get()->first();
        $data = array('status' => $stat, 'uname' => $uname , 'data' => $data , 'email' => $email);
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

        $data_dd = Studentdetail::where('Email',$email)->get()->first();
        if($data_dd){
          session()->flash('errorinfo', 'Profile updation failed, updation only allowed once !');
          return redirect()->route('profile'); 
        }

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
            'address' => 'required|string|min:5|max:500',
            'bio' => 'required|string|min:5|max:200',
            'skills' => 'required|string|min:5|max:200',
            'dob' => 'required|date_format:Y-m-d',
            'asapskills' => 'required',
            'volunteership' => 'nullable|array',
            'phoneno' => 'required|digits:10',
            'gender' => 'required|in:male,female,other',
            'aadhaar' => 'required|integer',
            'qualification0' => 'required|string',
            'board0' => 'required|string',
            'specialisation0' => 'required|string',
            'institution0' => 'required|string',
            'cgpa0' => 'required|integer|min:1|max:100',
            'join0' => 'required|date_format:Y-m-d',
            'pass0' => 'required|date_format:Y-m-d'
        ]);

        $numb_val = 0;
          
        for($i=0;$i<100;$i++){
          $name= 'cgpa'.strval($i);
          if(!empty($req->$name)){
            $numb_val=$numb_val+1;
          }
          else{
            break;
          }
        }

        if(empty($req->asapskills)){
          $asa = 'unknown';
        }
        else{
        $asa = '';
        foreach($req->asapskills as $asp){
           $asa = $asa . $asp . ',';
        }

        $asa = substr($asa, 0, -1);
       }

       if(empty($req->volunteership)){
        $vol = 'unknown';
      }
      else{
        $vol = '';
        foreach($req->volunteership as $vols){
           $vol = $vol . $vols . ',';
        }

        $vol = substr($vol, 0, -1);
      }

      if(empty($req->linkedin)){
        $req->linkedin = 'unknown';
      }

      if(empty($req->github)){
        $req->github = 'unknown';
      }

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
        $details->Volunteership = $vol;
        $details->Asap_Skills = $asa;
        $details->Aadhaar = $req->aadhaar;
        $details->Gender = $req->gender;
        $details->Linkedin = $req->linkedin;
        $details->Github = $req->github;
        if($details->save()){
          for($i=0;$i<$numb_val;$i++){
            $acc = new Students_qualifications();
            $acc->email = $email;
            $na1 = 'course'.strval($i);
            $na11 = 'specialisation'.strval($i);
            $na2 = 'cgpa'.strval($i);
            $na3 = 'board'.strval($i);
            $na4 = 'institution'.strval($i);
            $na5 = 'join'.strval($i);
            $na6 = 'pass'.strval($i);
            $na7 = 'cback'.strval($i);
            $na8 = 'hback'.strval($i);
            $na9 = 'qualification'.strval($i);
            $acc->course = $req->$na1;
            $acc->specialisation = $req->$na11;
            $acc->cgpa = $req->$na2;
            $acc->board = $req->$na3;
            $acc->institution = $req->$na4;
            $acc->join = $req->$na5;
            $acc->pass = $req->$na6;
            $acc->cbacklogs = $req->$na7;
            $acc->hbacklogs = $req->$na8;
            $acc->qualification = $req->$na9;
            if($acc->save()){
              continue;
            }
            else{
              $data = Studentdetail::where('Email',$email);
              $count = $data->delete();
              $data2 = Students_qualifications::where('email',$email);
              $count2 = $data2->delete();
              session()->flash('errorinfo', 'Something went wrong while updating your profile, please try again !');
              return redirect()->route('profile'); 
            }
          }
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
          $details->Volunteership = $vol;
          $details->Asap_Skills = $asa;
          $details->Aadhaar = $req->aadhaar;
          $details->Gender = $req->gender;
          $details->Linkedin = $req->linkedin;
          $details->Github = $req->github;
          if($details->save()){
            for($i=0;$i<$numb_val;$i++){
              $acc = new Students_qualifications();
              $acc->email = $email;
              $na1 = 'course'.strval($i);
              $na2 = 'cgpa'.strval($i);
              $na3 = 'board'.strval($i);
              $na4 = 'institution'.strval($i);
              $na5 = 'join'.strval($i);
              $na6 = 'pass'.strval($i);
              $na7 = 'cback'.strval($i);
              $na8 = 'hback'.strval($i);
              $na9 = 'qualification'.strval($i);
              if($i==0){
                $req->course0 = 'unknown';
                $req->cback0 = 0;
                $req->hback0 = 0;
              }
              $acc->course = $req->$na1;
              $acc->cgpa = $req->$na2;
              $acc->board = $req->$na3;
              $acc->institution = $req->$na4;
              $acc->join = $req->$na5;
              $acc->pass = $req->$na6;
              $acc->cbacklogs = $req->$na7;
              $acc->hbacklogs = $req->$na8;
              $acc->qualification = $req->$na9;
              if($acc->save()){
                continue;
              }
              else{
                $data = Studentdetail::where('Email',$email);
                $count = $data->delete();
                $data2 = Students_qualifications::where('email',$email);
                $count2 = $data2->delete();
                session()->flash('errorinfo', 'Something went wrong while updating your profile, please try again !');
                return redirect()->route('profile'); 
              }
            }
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

        $data_dd = Companydetail::where('Email',$email)->get()->first();
        if($data_dd){
          session()->flash('errorinfo', 'Profile updation failed, updation only allowed once !');
          return redirect()->route('profile'); 
        }

        if($req->photo===null){
          if($req->photoval===null){
            return back()->with('errorinfo','You have to upload a image (photo).')->withInput($req->input());
          }
        }

        $req->validate([
          'name' => 'required|string|min:2|max:100',
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
          if(empty($req->address)){
            $req->address = 'unknown';
          }
          if(empty($req->url)){
            $req->url = 'unknown';
          }
          $details = new Companydetail();
          $details->Email = $email;
          $details->Phoneno = $req->phoneno;
          $details->Address = $req->address;
          $details->URL = $req->url;
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
            if(empty($req->address)){
              $req->address = 'unknown';
            }
            if(empty($req->url)){
              $req->url = 'unknown';
            }
            $details = Companydetail::where('Email',$email)->first();
            $details->Email = $email;
            $details->Phoneno = $req->phoneno;
            $details->Address = $req->address;
            $details->URL = $req->url;
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
