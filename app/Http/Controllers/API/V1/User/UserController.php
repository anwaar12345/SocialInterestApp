<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserProfile;
class UserController extends Controller
{
    //get profile api
    public function profile(UserProfile $request)
    {
       return $request->process();
    }
}
