<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() {
        return view('pages.login');
    }

    function login(Request $request) {
        $request->validate([
            'nip' => 'required',
            'password' => 'required'
        ],[
            'nip.required' => 'nip wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $login =[
            'nip' => $request->nip,
            'password' => $request->password,
        ];

        if(Auth::attempt($login)){
            $user = Auth::user();
            if ($user->role === 'admin') {
                $admin = User::where('id', $user->id)->first();
                if($admin){
                    session(['admin' => $admin]);
                    return redirect()->route('admin.dashboard');
                }
            } else if ($user->role === 'sales') {
                $sales = User::where('id', $user->id)->first();
                // dd($sales);
                if($sales){
                    session(['sales' => $sales]);
                    return redirect()->route('sales.dashboard');
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Unauthorized'], 401);
            }
        }else {
            return redirect('login')->withErrors('Username dan Password yang dimasukkan tidak sesuai')->withInput();
        }
    }

    function logout() {
        Auth::logout();
        return redirect('');
    }
}
