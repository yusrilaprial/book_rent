<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function index()
    {
        $users = User::where('status', 'active')->where('role_id', 2)->get();
        return view('user', ['users' => $users]);
    }
    public function registerUser()
    {
        $registeredUsers = User::where('status', 'inactive')->where('role_id', 2)->get();
        return view('register-user', ['registeredUser' => $registeredUsers]);
    }
    public function show($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('user-detail', ['user' => $user]);
    }
    public function approve($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->status = 'active';
        $user->save();
        Session::flash('status', 'success');
        Session::flash('message', ' User Approved Successfully!');
        return redirect('/user-detail/'.$slug);
    }
    public function ban($slug)
    {
        $user = User::where('slug', $slug)->first();
        return view('user-banned', ['user' => $user]);
    }
    public function destroy($slug)
    {
        $user = User::where('slug', $slug)->first();
        $user->delete();
        Session::flash('status', 'danger');
        Session::flash('message', ' User Banned!');
        return redirect('/users');
    }
    public function bannedUser()
    {
        $bannedUsers = User::onlyTrashed()->get();
        return view('user-banned-list', ['bannedUsers' => $bannedUsers]);
    }
    public function unbanned($slug)
    {
        $user = User::withTrashed()->where('slug', $slug)->first();
        $user->restore();
        Session::flash('status', 'success');
        Session::flash('message', ' User Unbanned Successfully!');
        return redirect('/users');
    }
}
