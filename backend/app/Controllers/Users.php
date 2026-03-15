<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RatingsModel;
use App\Models\StocksModel;

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

    public function moodboard()
    {
        return view('user/moodboardPage');
    }

    public function roadmap()
    {
        return view('user/roadmapPage');
    }

    private function getCart()
    {
        $session = session();

        if (!$session->has('user')) {
            return [];
        }

        $userId = $session->get('user')['id'];
        $cartKey = "cart_$userId";

        $cart = $session->get($cartKey) ?? [];

        // Sync with session "cart"
        $session->set('cart', $cart);

        return $cart;
    }

    public function cart()
    {
        $session = session();
        if (!$session->has('user')) return redirect()->to('/loginPage');

        $cartItems = $this->getCart();

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $user = $session->get('user');
        $userFirstName = $user['profile']['display_name'] ?? $user['first_name'] ?? 'Reader';

        return view('user/cartPage', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'userFirstName' => $userFirstName
        ]);
    }

    public function checkout()
    {
        $session = session();
        if (!$session->has('user')) return redirect()->to('/loginPage');

        $cartItems = $this->getCart();

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $user = $session->get('user');
        $userFirstName = $user['profile']['display_name'] ?? $user['first_name'] ?? 'Reader';

        return view('user/checkoutPage', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'userFirstName' => $userFirstName
        ]);
    }

    public function profile()
    {
        $session = session();
        if (!$session->has('user')) {
            return redirect()->to('/loginPage');
        }

        return view('user/profilePage');
    }

    public function updateProfile()
    {
        $session = session();
        if (!$session->has('user')) {
            return redirect()->to('/loginPage');
        }

        $user = $session->get('user');
        $userId = $user['id'];

        $request = service('request');
        $validation = \Config\Services::validation();

        $validation->setRule('display_name', 'Display Name', 'required|min_length[2]|max_length[150]');
        $validation->setRule('avatar', 'Profile picture', 'permit_empty|is_image[avatar]|max_size[avatar,2048]|ext_in[avatar,png,jpg,jpeg]');

        $post = $request->getPost();

        if (!$validation->withRequest($request)->run($post)) {
            $session->setFlashdata('errors', $validation->getErrors());
            return redirect()->back()->withInput();
        }

        $profileModel = new \App\Models\ProfilesModel();
        $profile = $profileModel->where('user_id', $userId)->first();

        $avatarUrl = $profile?->avatar_url;
        $avatarFile = $request->getFile('avatar');

        if ($avatarFile && $avatarFile->isValid() && !$avatarFile->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/profiles/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Remove previous avatar file if it exists
            if (!empty($avatarUrl)) {
                $existingFile = FCPATH . ltrim($avatarUrl, '/');
                if (is_file($existingFile)) {
                    @unlink($existingFile);
                }
            }

            $newName = $avatarFile->getRandomName();
            $avatarFile->move($uploadPath, $newName);
            $avatarUrl = '/uploads/profiles/' . $newName;
        }

        $profileData = [
            'display_name' => $post['display_name'],
            'avatar_url' => $avatarUrl,
        ];

        if ($profile) {
            $profileModel->update($profile->id, $profileData);
        } else {
            $profileData['user_id'] = $userId;
            $profileModel->insert($profileData);
        }

        // Keep session in sync
        $user['avatar_url'] = $avatarUrl;
        $user['profile']['display_name'] = $post['display_name'];
        $session->set('user', $user);

        $session->setFlashdata('success', 'Profile updated successfully.');
        return redirect()->to('/profile');
    }

    public function ratings()
    {
        $session = session();
        if (!$session->has('user')) {
            return redirect()->to('/loginPage');
        }

        $userId = $session->get('user')['id'];
        $ratingsModel = new RatingsModel();
        $rating = $ratingsModel->where('user_id', $userId)->first();

        return view('user/ratingsPage', [
            'old' => ['existing_rating' => $rating?->rating] ?? [],
        ]);
    }

    public function submitRating()
    {
        $session = session();
        if (!$session->has('user')) {
            return redirect()->to('/loginPage');
        }

        $request = service('request');
        $validation = \Config\Services::validation();

        $validation->setRule('rating', 'Rating', 'required|integer|greater_than_equal_to[1]|less_than_equal_to[5]');
        $validation->setRule('comment', 'Comment', 'permit_empty|max_length[500]');

        $post = $request->getPost();

        if (!$validation->run($post)) {
            $session->setFlashdata('rating_errors', $validation->getErrors());
            $session->setFlashdata('rating_old', $post);
            return redirect()->back()->withInput();
        }

        $userId = $session->get('user')['id'];
        $ratingsModel = new RatingsModel();
        $existing = $ratingsModel->where('user_id', $userId)->first();

        $data = [
            'user_id' => $userId,
            'rating' => (int) $post['rating'],
            'comment' => $post['comment'] ?? null,
        ];

        if ($existing) {
            $ratingsModel->update($existing->id, $data);
        } else {
            $ratingsModel->insert($data);
        }

        $session->setFlashdata('rating_success', 'Thank you for your rating!');
        return redirect()->to('/shop');
    }

    /**
     * PLACE ORDER — deduct stock + clear cart
     */
    public function placeOrder()
    {
        $session = session();

        if (!$session->has('user')) {
            return redirect()->to('/loginPage');
        }

        $userId = $session->get('user')['id'];
        $cartKey = "cart_$userId";

        $cart = $this->getCart();

        if (empty($cart)) {
            return redirect()->to('/cart')->with('error', 'Your cart is empty.');
        }

        $stocksModel = new StocksModel();

        // 🔥 Deduct stock for each product purchased
        foreach ($cart as $item) {

            $product = $stocksModel->find($item['id']);

            if ($product) {
                $newQuantity = max(0, $product->quantity - $item['quantity']);

                // update stock
                $stocksModel->update($item['id'], [
                    'quantity' => $newQuantity
                ]);
            }
        }

        // 🔥 Clear only THIS user's cart
        $session->remove($cartKey);
        $session->remove('cart');

        return redirect()->to('/shop')->with('success', 'Order placed!');
    }
}
