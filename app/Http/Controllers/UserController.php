<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Transformers\UserTransformer;

class UserController extends Controller
{
    public function users(User $user)
    {
    	$users = $user->all();

    	return fractal()
    			->collection($users, 'You are loggin')
    			->transformWith(new UserTransformer)
    			->toArray();
    }

    public function profile(User $user)
    {
    	$user = $user->find(Auth::user()->id);

    	return fractal()
    				->item($user)
    				->transformWith(new UserTransformer)
                    ->includePosts()
    				->toArray();
    }

    public function profileUser(User $user, $id)
    {
        $user = $user->find($id);

        return fractal()
                    ->item($user)
                    ->transformWith(new UserTransformer)
                    ->includePosts()
                    ->toArray();
    }
}
