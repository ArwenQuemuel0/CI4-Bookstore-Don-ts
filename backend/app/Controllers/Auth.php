<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController
{
    public function showLogin()
    {
        $session = session();
        return view('auth/loginPage', [
            'errors' => $session->getFlashdata('errors') ?? [],
            'old' => $session->getFlashdata('old') ?? [],
            'success' => $session->getFlashdata('success') ?? null,
        ]);
    }

    public function login()
    {
        $request = service('request');
        $session = session();
        $validation = \Config\Services::validation();

        $validation->setRule('email', 'Email', 'required|valid_email');
        $validation->setRule('password', 'Password', 'required');

        $post = $request->getPost();

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        $userModel = new UsersModel();
        $email = trim($post['email']);
        $user = $userModel->where('email', $email)->first();

        if (!$user || !password_verify($post['password'], $user->password_hash)) {
            $session->setFlashdata('errors', ['email' => 'Invalid email or password']);
            $session->setFlashdata('old', ['email' => $email]);
            return redirect()->back()->withInput();
        }

        $type = strtolower($user->type ?? 'client');

        // Set session user data
        $session->set('user', [
            'id' => $user->id,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'type' => $type,
        ]);

        // 🔥 Load this user's saved cart
        $cartKey = "cart_" . $user->id;
        if ($session->has($cartKey)) {
            $session->set('cart', $session->get($cartKey));
        } else {
            $session->set('cart', []);
        }

        // Redirect based on type
        if ($type === 'admin') {
            return redirect()->to('/admin/adminDashboard');
        }

        return redirect()->to('/shop');
    }

    public function logout()
    {
        $session = session();

        // 🔥 Save user's cart before logout
        if ($session->has('user')) {
            $userId = $session->get('user')['id'];
            $cartKey = "cart_$userId";

            if ($session->has('cart')) {
                $session->set($cartKey, $session->get('cart'));
            }
        }

        // Destroy only user login, not cart storage
        $session->remove('user');
        $session->remove('cart');

        return redirect()->to('/loginPage');
    }

    public function showSignup()
    {
        $session = session();
        if ($session->has('user')) {
            return redirect()->to('/shop');
        }

        return view('auth/signupPage', [
            'errors' => $session->getFlashdata('errors') ?? [],
            'old' => $session->getFlashdata('old') ?? []
        ]);
    }

    public function signup()
    {
        $request = service('request');
        $session = session();
        $validation = \Config\Services::validation();

        $validation->setRule('first_name', 'First name', 'required|min_length[2]');
        $validation->setRule('last_name', 'Last name', 'required|min_length[2]');
        $validation->setRule('email', 'Email', 'required|valid_email');
        $validation->setRule('password', 'Password', 'required|min_length[6]');
        $validation->setRule('password_confirm', 'Confirm Password', 'required|matches[password]');

        $post = $request->getPost();

        if (!$validation->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        $userModel = new UsersModel();

        if ($userModel->where('email', $post['email'])->first()) {
            $session->setFlashdata('errors', ['email' => 'Email is already registered']);
            return redirect()->back()->withInput();
        }

        $data = [
            'first_name'    => $post['first_name'],
            'middle_name'   => $post['middle_name'],
            'last_name'     => $post['last_name'],
            'email'         => $post['email'],
            'password_hash' => password_hash($post['password'], PASSWORD_DEFAULT),
            'type'          => 'client',
            'account_status' => 1,
        ];

        $userId = $userModel->insert($data);

        $newUser = $userModel->find($userId);

        $session->set('user', [
            'id' => $newUser->id,
            'email' => $newUser->email,
            'first_name' => $newUser->first_name,
            'last_name' => $newUser->last_name,
            'type' => $newUser->type,
        ]);

        $session->set('cart', []); // new user empty cart

        return redirect()->to('/shop');
    }
}
