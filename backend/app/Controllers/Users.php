<?php

namespace App\Controllers;

use App\Controllers\BaseController;
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

        return view('user/cartPage', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'userFirstName' => $session->get('user')['first_name'] ?? 'Reader'
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

        return view('user/checkoutPage', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'userFirstName' => $session->get('user')['first_name'] ?? 'Reader'
        ]);
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
