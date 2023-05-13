<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Account\Register;
use App\Http\Requests\Account\verify;
use App\Http\Requests\Account\Login;
use App\Http\Requests\Account\AccountLogout;
class AccountController extends Controller
{
    //Create Access token
    public function issueToken(Login $request)
    {
        return $request->process();
    }

    //Account register
    public function register(Register $request)
    {
        return $request->process();
    }

    //Account Verify
    public function verify(verify $request,$id)
    {
        return $request->process();
    }    

    public function accountLogout(AccountLogout $request)
    {
        return $request->process();
    }

}
