<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;
  
class ChangePasswordController extends Controller
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
            $data = array( 'uname' => $uname );
            return view('student.changepassword')->with($data);
        }
        elseif($u_type==1){
            $data = array( 'uname' => $uname );
            return view('company.changepassword')->with($data);
        }
        elseif($u_type==2){
            $data = array( 'uname' => $uname );
            return view('admin.changepassword')->with($data);
        }
        else{
            Auth::logout();
            return redirect('login')->with('info', 'User Type is not valid !');
        }
    } 
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
          
        $user = Auth::user();
        $email = $user->email;

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required','different:current_password'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $check = User::where('email',$email)->update(['password'=> Hash::make($request->new_password)]);
        if($check){
            session()->flash('status', 'Password Changed Successfully !');
            return redirect()->route('home');
        }
        else{
            session()->flash('status', 'Something went wrong while updating your password, please try again !');
            return redirect()->route('home');
        }
    }
}