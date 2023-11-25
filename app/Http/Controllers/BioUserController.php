<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BioUserController extends Controller
{
    public function index()
    {
        $data = User::all();
    }
}
