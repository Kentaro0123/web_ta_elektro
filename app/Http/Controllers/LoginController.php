<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Webklex\PHPIMAP\IMAP;
use Laravel\Socialite\Facades\Socialite;
class LoginController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        
       

        // Google user object dari google
        $userFromGoogle = Socialite::driver('google')->user();
        
        $userFromGoogle->getAvatar();

            $email= strtok($userFromGoogle->getEmail(),'@');
            $domain= strtok('');
            $nama=$userFromGoogle->getName();
            
        

        // Ambil user dari database berdasarkan google user id
        $userFromDatabase = User::where('nip', strtok($userFromGoogle->getEmail(),'@'))->first();
        // dd($userFromDatabase);
        
        // Jika tidak ada user, maka buat user baru
        if (!$userFromDatabase) {
            // $newUser = new User([
            //     'nip' => $email,
            //     'name' => $userFromGoogle->getName(),
            //     'email' => $userFromGoogle->getEmail(),
            // ]);

            if($domain == 'john.petra.ac.id')
            {
                // dd('hello');

                return view('features.register_mahasiswa',[
                    'nip'=>$email,
                    'nama' => $nama,
                    'role'=>1,
                    'email' => $userFromGoogle->getEmail(),
                    ]);

            }
            elseif($domain == 'peter.petra.ac.id')
            {

                $dosen = new User();
                $dosen->nip=$email;
                $dosen->nama=$nama;
                $dosen->role=2;
                $dosen->email=$userFromGoogle->getEmail();
                $dosen->password=Hash::make("dosen$email");
                $dosen->save();


            }
            else{
                return redirect('/');
            }
            // $view= new View();
            // $view->with('image',$userFromGoogle->getAvatar());
            // view()->composer('*',function($view) {
            //     $view->with('user', $image);
               
            // });
            
            $user=new User();
            $login_user=$user->all()->where('nip','=',$email)->first();
            
              if(Auth::attempt($login_user)){
               session()->regenerate();
        
                return redirect()->intended('/dashboard');
               }
               return redirect('/');

        }
        // dd('masuk');

        // Jika ada user langsung login saja
        // if(Auth::attempt($credentials)){
        //     $request->session()->regenerate();
    
        //     return redirect()->intended('/dashboard');
        //    }
            $user=new User();
            $login_user=$user->all()->where('nip','=',$email)->first();
            session()->regenerate();
            Auth::login($login_user);
            return redirect()->intended('/dashboard');

            // // dd($login_user);
            // $credentials = [
            //     'email' => $login_user['email'],
            //     'password' => $login_user['password'],
            // ];
            // // dd($credentials);
            //   if(Auth::attempt($credentials)){

            //     // dd($credentials);
            //    session()->regenerate();
        
            //     return redirect()->intended('/dashboard');
            //    }
            //    return redirect('/');
    }

    // public function logout(Request $request)
    // {
    //     auth('web')->logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect('/');
    // }
    public function index(){
        return view('features.login.index',[
            'title'=>"Login"
        ]);
    }

    

    public function store(Request $request){
        return $request->all();
    }
    public function authenticate(Request $request): RedirectResponse{


        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    

        // $user=new User();
        // $user->email=$request->email;
        // $user->password=$request->password;
        
        if(Auth::attempt($credentials)){
        $request->session()->regenerate();

        return redirect()->intended('/dashboard');
       }

       
        return back()->with('loginError','Login Failed !');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
  // // $url="{john.petra.ac.id:993/imap/ssl/novalidate-cert}INBOX";
        // // // $url = "{imap.gmail.com:995/imap/ssl/novalidate-cert}INBOX";
        // // $id_mahasiswa=$credentials['email'];
        // // $password=$credentials['password'];
        // // $mailbox=imap_open($url,$id_mahasiswa,$password);
        // $url = "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX";
        // $id = "tutorialspoint.test@gmail.com";
        // $pwd = "cohondob_123";
        // $mailbox = imap_open($url, $id, $pwd);
      
        // if($mailbox){
        //     dd("User Valid");
        // }else{
        //     dd("User Tidak Valid");
        // }

        // dd(Auth::attempt($credentials));
