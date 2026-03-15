<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use CodeIgniter\Exceptions\ForbiddenException;

class Admin extends BaseController
{
    /**
     * Enforce admin-only access
     *
     * @throws ForbiddenException
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
        // Enforce admin-only access
        $this->checkAdminAccess();

        try {
            $usersModel = new UsersModel();

            // Count all client accounts (ignore account_status)
            $clientsCount = $usersModel->where('type', 'client')->countAllResults();
        } catch (\Exception $error) {
            $clientsCount = "Server Issue: " . $error;
        }

        // Get the admin's first name from session (safe default)
        $session = session();
        $user = $session->get('user') ?? [];
        $firstName = $user['first_name'] ?? 'Admin';

        return view('admin/adminDashboard', [
            'clientsCount' => $clientsCount,
            'adminFirstName' => $firstName,
        ]);
    }
}
