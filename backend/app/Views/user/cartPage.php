<?php
$session = session();

// Redirect if not logged in
if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}

$userFirstName = $session->get('user')['first_name'] ?? 'Reader';
$cartItems = $session->get('cart') ?? [];
$totalPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | Fennekin Folios</title>
    <link rel="shortcut icon" type="image/png" href="/assets/bookstore_icon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto Slab', serif;
            background: url('/assets/background.png') no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            background: linear-gradient(rgba(44, 41, 41, 0.6), rgba(225, 90, 55, 0.4));
        }

        .header-title {
            font-family: 'Righteous', sans-serif;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(225, 90, 55, 0.3);
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <div class="flex flex-col min-h-screen overlay">

        <?= view('components/header.php') ?>

        <main class="flex-grow p-10">

            <section class="py-16 text-center">
                <h2 class="drop-shadow-lg font-bold text-white text-3xl md:text-4xl header-title">
                    Hello, <?= esc($userFirstName) ?>!
                </h2>
                <p class="mt-2 text-white/90 text-lg md:text-xl">
                    Your cart items are listed below. Ready to checkout?
                </p>
            </section>

            <div class="bg-white shadow-xl mx-auto mt-6 p-8 border border-[#FCE77C] rounded-2xl max-w-6xl">
                <table class="border border-[#FCE77C] rounded-xl min-w-full">
                    <thead class="bg-[#E15A37] text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">Book</th>
                            <th class="px-4 py-2 text-left">Price</th>
                            <th class="px-4 py-2 text-left">Quantity</th>
                            <th class="px-4 py-2 text-left">Subtotal</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($cartItems)): ?>
                            <?php foreach ($cartItems as $item): ?>
                                <tr class="border-b">
                                    <td class="px-4 py-2"><?= esc($item['title']) ?></td>
                                    <td class="px-4 py-2">₱<?= number_format($item['price'], 2) ?></td>
                                    <td class="px-4 py-2"><?= esc($item['quantity']) ?></td>
                                    <td class="px-4 py-2">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                    <td class="px-4 py-2">
                                        <a href="/cart/remove/<?= esc($item['id']) ?>" class="text-red-500 hover:text-red-700">🗑️ Remove</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3" class="px-4 py-2 font-bold text-right">Total</td>
                                <td class="px-4 py-2 font-bold">₱<?= number_format($totalPrice, 2) ?></td>
                                <td></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-gray-600 text-center">Your cart is empty.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <div class="flex justify-end mt-6">
                    <a href="/checkout" class="bg-[#FCE77C] hover:bg-[#ED865A] px-6 py-3 rounded-full font-semibold text-[#514D4D]">Proceed to Checkout</a>
                </div>
            </div>

        </main>
    </div>
</body>

</html>