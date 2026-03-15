<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RatingsModel;
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

        $userFirstName = $user['profile']['display_name'] ?? $user['first_name'] ?? 'Reader';

        // Load existing rating (if any)
        $ratingsModel = new RatingsModel();
        $existingRating = $ratingsModel->where('user_id', $user['id'])->first();

        return view('user/shopPage', [
            'products' => $products,
            'userFirstName' => $userFirstName,
            'existingRating' => $existingRating,
        ]);
    }
}
