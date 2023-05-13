<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interest;
class InterestController extends Controller
{
    //get interest list
    public function index()
    {
        return Interest::paginate(env('pagination'));
    }
}
