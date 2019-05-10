<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserEditRequest;

class UsersController extends Controller
{
    function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    function update(UserEditRequest $request, User $user)
    {
        $user->update($request->except('_token'));
        return redirect()->route('users.show', compact('user'));
    }

}
