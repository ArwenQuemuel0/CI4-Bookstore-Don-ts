<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController
{
    public function showLogin()
    {
        $session = session();
        $errors = $session->getFlashdata('errors') ?? [];
        $old = $session->getFlashdata('old') ?? [];
        $success = $session->getFlashdata('success') ?? null;

        return view('auth/loginPage', [
            'errors' => $errors,
            'old' => $old,
            'success' => $success,
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

        // Set session first (use `id` as primary key)
        $session->set('user', [
            'id'         => $user->id,
            'email'      => $user->email,
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'type'       => $type,
        ]);

        // Redirect based on type
        if ($type === 'admin') {
            return redirect()->to('/admin/adminDashboard');
        }

        return redirect()->to('/');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/'); // redirect to landing page
    }

    public function showSignup()
    {
        $session = session();
        if ($session->has('user')) {
            return redirect()->to('/');
        }

        $errors = $session->getFlashdata('errors') ?? [];
        $old = $session->getFlashdata('old') ?? [];

        return view('auth/signupPage', ['errors' => $errors, 'old' => $old]);
    }

    public function signup()
    {
        $request = service('request');
        $session = session();
        $validation = \Config\Services::validation();

        $validation->setRule('first_name', 'First name', 'required|min_length[2]|max_length[100]');
        $validation->setRule('middle_name', 'Middle name', 'permit_empty');
        $validation->setRule('last_name', 'Last name', 'required|min_length[2]|max_length[100]');
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
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        $data = [
            'first_name'     => $post['first_name'],
            'middle_name'    => $post['middle_name'],
            'last_name'      => $post['last_name'],
            'email'          => $post['email'],
            'password_hash'  => password_hash($post['password'], PASSWORD_DEFAULT),
            'type'           => 'client',
            'account_status' => 1,
        ];

        $inserted = $userModel->insert($data);
        if ($inserted === false) {
            $session->setFlashdata('errors', ['general' => 'Could not create account']);
            $session->setFlashdata('old', $post);
            return redirect()->back()->withInput();
        }

        $newUser = $userModel->find($inserted);

        $session->set('user', [
            'id'         => $newUser->id ?? null,
            'email'      => $newUser->email ?? null,
            'first_name' => $newUser->first_name ?? null,
            'last_name'  => $newUser->last_name ?? null,
            'type'       => $newUser->type ?? 'client',
        ]);

        $session->setFlashdata('success', 'Account created successfully!');
        return redirect()->to('/');
    }
}
