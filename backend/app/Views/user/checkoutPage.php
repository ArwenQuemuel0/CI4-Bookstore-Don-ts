<?php
$session = session();

// Redirect if not logged in
if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}

// Get user's first name
$userFirstName = $session->get('user')['first_name'] ?? 'Reader';

// Get cart items
$cart = $session->get('cart') ?? [];
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Fennekin Folios</title>
    <link rel="shortcut icon" type="image/png" href="/assets/bookstore_icon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Roboto Slab', serif;
            background: url('/assets/background.png') no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            background: linear-gradient(rgba(44, 41, 41, 0.6), rgba(225, 90, 55, 0.4));
        }

        .header-title {
            font-family: "Righteous", sans-serif;
        }

        button:hover,
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(225, 90, 55, 0.3);
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">

    <div class="flex flex-col min-h-screen overlay">

        <!-- Header -->
        <?= view('components/header.php', ['showCart' => true]) ?>

        <!-- Main Content -->
        <main class="flex-grow">

            <!-- Greeting -->
            <section class="py-16 text-center">
                <h2 class="drop-shadow-lg font-bold text-white text-3xl md:text-4xl header-title">
                    Checkout, <?= esc($userFirstName) ?>!
                </h2>
                <p class="mt-2 text-white/90 text-lg md:text-xl">
                    Review your cart and complete your purchase.
                </p>
            </section>

            <!-- Cart & Checkout Container -->
            <div class="bg-white shadow-xl mx-auto mt-6 p-8 border border-[#FCE77C] rounded-2xl max-w-6xl">

                <h3 class="mb-8 font-bold text-[#E15A37] text-4xl text-center header-title">
                    Your Cart
                </h3>

                <?php if (!empty($cart)): ?>
                    <div class="overflow-x-auto">
                        <table class="bg-white border border-[#FCE77C] rounded-xl min-w-full">
                            <thead class="bg-[#E15A37] text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left">Book</th>
                                    <th class="px-6 py-3 text-center">Quantity</th>
                                    <th class="px-6 py-3 text-center">Price</th>
                                    <th class="px-6 py-3 text-center">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#FCE77C]">
                                <?php foreach ($cart as $item): ?>
                                    <tr class="hover:bg-[#FFF8E7] transition">
                                        <td class="px-6 py-4 font-semibold"><?= esc($item['name']) ?></td>
                                        <td class="px-6 py-4 text-center"><?= esc($item['quantity']) ?></td>
                                        <td class="px-6 py-4 text-center">₱<?= number_format($item['price'], 2) ?></td>
                                        <td class="px-6 py-4 text-center">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Total -->
                    <div class="mt-8 font-bold text-2xl text-right">
                        Total: ₱<?= number_format($total, 2) ?>
                    </div>

                    <!-- Checkout Form -->
                    <div class="bg-white shadow-md mt-12 p-8 border border-[#FCE77C] rounded-2xl">
                        <h3 class="mb-4 font-bold text-[#E15A37] text-2xl header-title">Shipping Details</h3>
                        <form action="/checkout/submit" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-4">
                                <input type="text" name="fullname" placeholder="Full Name" class="p-3 border border-[#E15A37] rounded-lg focus:outline-none focus:ring-[#E15A37]/50 focus:ring-2 w-full">
                            </div>
                            <div class="mb-4">
                                <input type="text" name="address" placeholder="Address" class="p-3 border border-[#E15A37] rounded-lg focus:outline-none focus:ring-[#E15A37]/50 focus:ring-2 w-full">
                            </div>
                            <div class="mb-4">
                                <input type="text" name="contact" placeholder="Contact Number" class="p-3 border border-[#E15A37] rounded-lg focus:outline-none focus:ring-[#E15A37]/50 focus:ring-2 w-full">
                            </div>
                            <button type="submit" class="bg-[#E15A37] hover:bg-[#ED865A] px-6 py-3 rounded-lg w-full font-semibold text-white">
                                Place Order
                            </button>
                        </form>
                    </div>

                <?php else: ?>
                    <p class="mt-12 text-gray-600 text-xl text-center">Your cart is empty.</p>
                <?php endif; ?>

            </div>

        </main>

        <!-- Footer -->
        <footer class="mt-auto">
            <?= view('components/footer') ?>
        </footer>

    </div>
</body>

</html>