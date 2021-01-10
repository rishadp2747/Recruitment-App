<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Companydetail;
use App\Models\Appliedjob;
use App\Models\Studentdetail;
use App\Models\User;
use App\Models\Allowed_users;
use App\Models\Students_qualifications;
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
      if($u_type==2){
        
        $req->validate([
          'email' => 'required|string'
          ]);

          $exception_st = '';
          $succs = 0;
          $userss = explode(",",$req->email);
       foreach($userss as $it){
        $it = str_replace(' ', '', $it);
        if(!filter_var($it, FILTER_VALIDATE_EMAIL)){
          if($exception_st==''){
            $exception_st = $exception_st.$it;
            continue; 
        }
        else{
          $exception_st = $exception_st.', '.$it;
          continue;
        }
        }

        if($email==$it){
          if($exception_st==''){
              $exception_st = $exception_st.$it;
              continue;  
          }
          else{
            $exception_st = $exception_st.', '.$it;
            continue;
          }
        }

        $u_ex = User::where('email', '=', $it)->where('user_type', '=', 1)->exists();

        if($u_ex){
          if($exception_st==''){
            $exception_st = $exception_st.$it;
            continue;  
        }
        else{
          $exception_st = $exception_st.', '.$it;
          continue;
        } 
        }

        $u_exist = Allowed_users::where('email', '=', $req->email)->exists();

        if($u_exist){
          $succs = $succs + 1;
          continue;  
        }

        $a_usr = new Allowed_users;
        $a_usr->Email = $it;
        $a_usr->Admin_Email = $email;
        if($a_usr->save()){
          $succs = $succs + 1;
          continue;
        } 
        else{
          if($exception_st==''){
            $exception_st = $exception_st.$it;
            continue;  
        }
        else{
          $exception_st = $exception_st.', '.$it;
          continue;
        }  
        }
      }
        
       if(!empty($exception_st)){
          $statement = $succs.' Students added successfully. Adding these users ( '.$exception_st.' ) failed, please cross check for any errors and try again.';
       }
       else{
         $statement = $succs.' Students added successfully !';
       }

          session()->flash('status', $statement);
          return redirect()->route('home');
 
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

        if($req->email=='all'){
          $exception_st = '';
          $n = Allowed_users::select('Email','id')->get();
          foreach($n as $reqd){
            $id = $reqd->id;
            $email2 = $reqd->Email;
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
              $kl_ex = Students_qualifications::where('email', '=', $email2)->exists();
              if($kl_ex){
                $data5 = Students_qualifications::where('email',$email2);
                $count5 = $data5->delete();
              }
              else{
                $count5 = 1;
              }
            }
            else{
              $count1 = 0;
              $count3 = 0;
              $count4 = 0;
              $count5 = 0;
            }
            if($count1===1 && $count2===1 && $count3===1 && $count4===1 && $count5===1){
              continue;
            }
            else{
              if($exception_st==''){
                $exception_st = $exception_st.$email2;
            }
            else{
                $exception_st = $exception_st.', '.$email2;
            }
            }
          }
          if($exception_st==''){
            session()->flash('status', 'All students deleted successfully !');
            return redirect()->route('home');
          }
          else{
            session()->flash('status', 'All students except ( '.$exception_st.' ) deleted successfully !');
            return redirect()->route('home');
          }
        }
        else{
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
          $kl_ex = Students_qualifications::where('email', '=', $email2)->exists();
              if($kl_ex){
                $data5 = Students_qualifications::where('email',$email2);
                $count5 = $data5->delete();
              }
              else{
                $count5 = 1;
              }
        }
        else{
          $count1 = 0;
          $count3 = 0;
          $count4 = 0;
          $count5 = 0;
        }
        if($count1===1 && $count2===1 && $count3===1 && $count4===1 && $count5===1){
          session()->flash('status', 'User ('.$email2.') Deleted Successfully !');
          return redirect()->route('studentdelete');
        }
        else{
          session()->flash('errorinfo', 'Error in deleting the selected user, please try again !');
          return redirect()->route('studentdelete');
        }
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

        if($req->email=='all'){
          $exception_st = '';
          $n = User::where('user_type',1)->get();
          foreach($n as $reqd){
            $email2 = $reqd->email;
            $u_ex = User::where('email', '=', $email2)->exists();
            if($u_ex){
              $data2 = User::where('email',$email2);
              $count2 = $data2->delete();
            }
            else{
              $count2 = 1;
            }
            if($count2===1){
              $f_ex = Job::where('email', '=', $email2)->exists();
              if($f_ex){
                $data1 = Job::where('Email',$email2);
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
              continue;
            }
            else{
              if($exception_st==''){
                  $exception_st = $exception_st.$email2;
              }
              else{
                  $exception_st = ', '.$exception_st.$email2;
              }
            }
          }
          if($exception_st==''){
            session()->flash('status', 'All company deleted successfully !');
            return redirect()->route('home');
          }
          else{
            session()->flash('status', 'All company except ( '.$exception_st.' ) deleted successfully !');
            return redirect()->route('home');
          }
        }
        else{
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
      }
      else{
        session()->flash('status', 'You are not allowed to do that operation !');
        return redirect()->route('home');
      }
    }
}
