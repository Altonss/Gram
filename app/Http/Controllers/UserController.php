<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('User/Index', [
            'profiles'  =>  UserResource::collection(
                User::with('posts', 'likes', 'followers', 'followables')
                ->latest()
                ->when($request->input('searchUsers'), function ($query, $searchUsers) {
                    $query->where('name', 'like', "%{$searchUsers}%");
                })
                ->paginate(15)
                ->withQueryString()
            ),
            'search' => $request->only(['searchUsers']),
            'filters' => $request->only(['search'])
            ]);
    }

    public function show(User $user, Request $request)
    {
        return Inertia::render('User/Show', [
            'profile'   =>  UserResource::make($user->load('followers', 'followables')),
            'posts'     =>  PostResource::collection(
                $user->posts()->latest()
                ->select('id', 'description', 'file', 'category_id', 'user_id', 'created_at')
                ->with('user', 'replies', 'likers')
                ->paginate(15)
            ),
            'filters'   => $request->only(['search']),
        ]);
    }

    public function follow(User $user)
    {
        if (auth()->user()->isFollowing($user)) {
            auth()->user()->unfollow($user);
        } else {
            auth()->user()->toggleFollow($user);
        }

        return back();
    }
}
