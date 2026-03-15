<?php
$session = session();

// Redirect if not logged in
if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}

// Use the passed in name (preferred) or fall back to profile data.
$userFirstName = $userFirstName ?? ($session->get('user')['profile']['display_name'] ?? $session->get('user')['first_name'] ?? 'Reader');

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
            font-family: Arial, serif;
            background: url('/assets/background.png') no-repeat center center fixed;
            background-size: cover;
        }

        .overlay {
            background: linear-gradient(rgba(44, 41, 41, 0.6), rgba(225, 90, 55, 0.4));
        }

        .header-title {
            font-family: "Times New Roman", sans-serif;
        }

        button:hover,
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 0, 0, 0.5);
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">

    <div class="flex flex-col min-h-screen overlay">

        <!-- Header -->
        <?= view('components/header.php', ['showCart' => true]) ?>

        <!-- Main Content -->
        <main class="flex-grow">

            <!-- Cart Summary -->
            <div class="bg-white shadow-xl mx-auto mt-6 p-2 border border-[#FCE77C] rounded-2xl max-w-6xl">

                <h3 class="mb-2 font-bold text-red-500 text-2xl text-center header-title">
                    Cart
                </h3>

                <?php if (!empty($cart)): ?>
                    <div class="overflow-x-auto">
                        <table class="bg-white border border-[#FCE77C] rounded-xl min-w-full">
                            <tbody class="divide-y divide-[#FCE77C]">
                                <?php foreach ($cart as $item): ?>
                                    <tr>
                                        <td class="px-1 py-1 font-semibold text-sm"><?= esc($item['title']) ?></td>
                                        <td class="px-1 py-1 text-sm text-center"><?= esc($item['quantity']) ?></td>
                                        <td class="px-1 py-1 text-sm text-center">₱<?= number_format($item['price'], 2) ?></td>
                                        <td class="px-1 py-1 text-sm text-center">₱<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- PLACE ORDER BUTTON -->
                    <div class="mt-2 text-right">
                        <form action="/checkout/placeOrder" method="post">
                            <button type="submit"
                                class="bg-red-500 px-2 py-1 rounded font-bold text-white text-sm">
                                Order
                            </button>
                        </form>
                    </div>

                <?php else: ?>
                    <p class="mt-2 text-gray-600 text-sm text-center">Empty.</p>
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