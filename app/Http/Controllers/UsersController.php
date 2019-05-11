<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserEditRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }
    /**
     * 用户详情页
     */
    function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * 用户编辑页
     */
    function edit(User $user)
    {
        $this->authorize('isSelf', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * 用户编辑
     */
    function update(UserEditRequest $request, User $user, ImageUploadHandler $upload)
    {
        $this->authorize('isSelf', $user);
        $data = $request->except('_token');
        if($request->avatar){
            $res = $upload->save($request->avatar, 'avatars', $user->id, 500);
            if($res) {
                $data['avatar'] = $res['path'];
            }
        }
        
        $user->update($data);
        return redirect()->route('users.show', compact('user'))->with('success', '个人资料修改成功');
    }

}
