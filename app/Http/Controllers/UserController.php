<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::paginate(config('usersmanagement.paginateListSize'));

        if ($user->isAdmin()) {
            return View('pages.admin.home', compact('products'));
        }

        return View('pages.user.home', compact('products'));
    }
}
