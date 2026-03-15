<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StocksModel;

class Stock extends BaseController
{
    public function shop()
    {
        $session = session();

        if (!$session->has('user')) {
            return redirect()->to('/loginPage');
        }

        $user = $session->get('user');

        $stocksModel = new StocksModel();
        $products = $stocksModel->findAll();

        return view('user/shopPage', [
            'products' => $products,
            'userFirstName' => $user['first_name']
        ]);
    }
}
