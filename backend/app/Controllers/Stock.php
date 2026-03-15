<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StocksModel;

class Stock extends BaseController
{
    public function shop()
    {
        $session = session();

        // Redirect if not logged in
        if (!$session->has('user')) {
            return redirect()->to('/loginPage');
        }

        // Logged user's first name
        $user = $session->get('user');
        $userFirstName = $user['first_name'] ?? 'Reader';

        // Load products from DB
        $stocksModel = new StocksModel();
        $products = $stocksModel->findAll();

        // IMPORTANT: correct view PATH
        return view('user/shopPage', [
            'userFirstName' => $userFirstName,
            'products' => $products
        ]);
    }
}
