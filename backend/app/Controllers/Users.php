<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Users extends BaseController
{
    public function index()
    {
        return view('user/landingPage');
    }

    public function login()
    {
        return view('user/loginPage');
    }

    public function signup()
    {
        return view('user/signupPage');
    }

    public function shop()
    {
        $session = session();

        // Redirect to login if not logged in
        if (!$session->has('user')) {
            return redirect()->to('/loginPage');
        }

        return view('user/shopPage'); // This is your shop page view
    }

    public function moodboard()
    {
        return view('user/moodboardPage');
    }

    public function roadmap()
    {
        return view('user/roadmapPage');
    }
}
