<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;

class UsersController extends Controller
{

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|max:50|unique:users',
            'nickname' => 'required|max:50',
            'school' => 'max:20',
            'email' => 'email|max:255',
            'password' => 'required|confirmed|min:6'
        ]);
        $user = User::create([
            'username' => $request->username,
            'nickname' => $request->nickname,
            'school' => $request->school,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'last_login_ip' => $request->ip()
        ]);
        Auth::login($user);
        session()->flash('success', '注册成功');
        return redirect()->route('users.show', [$user]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $this->validate($request, [
            'nickname' => 'max:50',
            'password' => 'nullable|confirmed|min:6',
            'school' => 'max:20',
            'email' => 'email|max:255',
        ]);
        $this->authorize('update', $user);
        $data = [];
        $data['username'] = $user->username;
        $data['nickname'] = $request->nickname;
        $data['school'] = $request->school;
        $data['email'] = $request->email;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user->username);
    }

    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store', 'index']
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }
}