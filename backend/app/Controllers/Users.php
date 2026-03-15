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
        $userId = $session->get('user')['id'];
        $cartKey = "cart_$userId";

        $cart = $session->get($cartKey) ?? [];
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
}
