<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Cast\Double;

class RegisterController extends Controller
{
    public function index(){
        return view("features.admin.register_mahasiswa",[
            'title'=>'Register'
        ]);
    }

    public function store(Request $request){

        // dd($request->all());

        $validatedData=$request->validate([
            'nip'=>'required','unique:users',
            'nama' => 'required',
            'role'=>'required',
            'email' => 'required|email:dns','unique:users',
            'password'=>'required',

            
        ]);
        
        
        $validatedData['password'] = Hash::make($validatedData['password']);
        
        if ($validatedData['role']== 1){
            $mahasiswa =$request->only(['user_nip', 'konsentrasi','ipk']);
            Mahasiswa::create($mahasiswa);  

        }
   
        // $mahasiswa['ipk']=number_format($mahasiswa['ipk'],2);
        User::create($validatedData);
        // $request->flash('success','Registration Success');

        return redirect('/register')->with('success','Registration Success');

    }
}
