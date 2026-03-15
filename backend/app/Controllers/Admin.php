<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\StocksModel;   // ⭐ ADD THIS
use CodeIgniter\Exceptions\ForbiddenException;

class Admin extends BaseController
{
    /**
     * Enforce admin-only access
     */
    private function checkAdminAccess()
    {
        $session = session();

        if (!$session->has('user')) {
            throw ForbiddenException::forbidden('Authentication required. Please log in to access admin pages.');
        }

        $user = $session->get('user');

        if (!isset($user['type']) || $user['type'] !== 'admin') {
            throw ForbiddenException::forbidden('Access denied: Admin role required to access admin pages.');
        }
    }

    /**
     * Display Admin Dashboard
     */
    public function showDashboard()
    {
        $this->checkAdminAccess();

        try {
            $usersModel = new UsersModel();
            $clientsCount = $usersModel->where('type', 'client')->countAllResults();
        } catch (\Exception $error) {
            $clientsCount = "Server Issue: " . $error;
        }

        $session = session();
        $user = $session->get('user') ?? [];
        $firstName = $user['first_name'] ?? 'Admin';

        return view('admin/adminDashboard', [
            'clientsCount' => $clientsCount,
            'adminFirstName' => $firstName,
        ]);
    }

    /**
     * STOCKS PAGE — loads books from stock database
     */
    public function stockPage()
    {
        $this->checkAdminAccess();

        $session = session();
        $user = $session->get('user') ?? [];
        $firstName = $user['first_name'] ?? 'Admin';

        // ⭐ LOAD STOCKS FROM DATABASE
        $stocksModel = new StocksModel();
        $stocks = $stocksModel->findAll();

        return view('admin/stockPage', [
            'adminFirstName' => $firstName,
            'stocks' => $stocks   // ⭐ PASS STOCK DATA TO VIEW
        ]);
    }

    /**
     * Requests Page
     */
    public function requestPage()
    {
        $this->checkAdminAccess();

        $session = session();
        $user = $session->get('user') ?? [];
        $firstName = $user['first_name'] ?? 'Admin';

        return view('admin/requestPage', [
            'adminFirstName' => $firstName
        ]);
    }

    /**
     * ACCOUNTS PAGE — Loads users from DB
     */
    public function accountsPage()
    {
        $this->checkAdminAccess();

        $session = session();
        $user = $session->get('user') ?? [];
        $firstName = $user['first_name'] ?? 'Admin';

        $usersModel = new UsersModel();
        $accounts = $usersModel->findAll();

        return view('admin/accountsPage', [
            'adminFirstName' => $firstName,
            'accounts' => $accounts
        ]);
    }

    /**
     * UPDATE USER — Called by Edit Modal
     */
    public function updateAccount($id)
    {
        $this->checkAdminAccess();

        $usersModel = new UsersModel();
        $user = $usersModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/accountsPage')->with('error', 'User not found.');
        }

        // Gather fields
        $data = [
            'first_name'  => $this->request->getPost('first_name'),
            'middle_name' => $this->request->getPost('middle_name'),
            'last_name'   => $this->request->getPost('last_name'),
            'email'       => $this->request->getPost('email'),
        ];

        // Update password if provided
        if (!empty($this->request->getPost('password'))) {
            $data['password_hash'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // Save update
        $usersModel->update($id, $data);

        return redirect()->to('/admin/accountsPage')->with('message', 'User updated successfully.');
    }
}
