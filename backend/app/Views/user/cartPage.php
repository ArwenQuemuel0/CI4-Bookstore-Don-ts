<?php
$session = session();

if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}

// Use the passed in name (preferred) or fall back to profile data.
$userFirstName = $userFirstName ?? ($session->get('user')['profile']['display_name'] ?? $session->get('user')['first_name'] ?? 'Reader');
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
    <title>Your Cart | Fennekin Folios</title>
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

        .table-card {
            border: 2px solid #FCE77C;
            border-radius: 20px;
        }

        .btn-primary {
            background-color: #E15A37;
            color: white;
        }

        .btn-primary:hover {
            background-color: #ED865A;
        }

        .btn-yellow {
            background-color: #FCE77C;
            color: #514D4D;
        }

        .btn-yellow:hover {
            background-color: #ED865A;
            color: white;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <div class="flex flex-col min-h-screen overlay">

        <!-- HEADER -->
        <?= view('components/header.php') ?>

        <main class="flex-grow p-10">

            <!-- Greeting -->
            <section class="py-10 text-center">
                <h2 class="drop-shadow-lg font-bold text-white text-3xl md:text-4xl header-title">
                    Hello, <?= esc($userFirstName) ?>!
                </h2>
                <p class="mt-2 text-white/90 text-lg md:text-xl">
                    Your cart items are listed below.
                </p>
            </section>

            <!-- Confusing Process Bar -->
            <div class="table-card bg-white shadow-xl mx-auto mt-6 p-4 max-w-6xl">
                <h3 class="font-bold text-lg text-center">Shopping Process</h3>
                <div class="bg-gray-200 mt-2 rounded-full w-full h-4">
                    <div class="bg-red-500 rounded-full h-4" style="width: 25%"></div>
                </div>
                <p class="mt-1 text-sm text-center">Step 1 of 8: Viewing Cart (but actually you're stuck here)</p>
            </div>

            <!-- CART BOX -->
            <div class="table-card bg-white shadow-xl mx-auto mt-6 p-8 max-w-6xl">

                <table class="min-w-full">
                    <thead class="bg-[#E15A37] rounded-lg text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Image</th>
                            <th class="px-4 py-3 text-left">Book</th>
                            <th class="px-4 py-3 text-left">Price</th>
                            <th class="px-4 py-3 text-left">Quantity</th>
                            <th class="px-4 py-3 text-left">Subtotal</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                            <th class="px-4 py-3 text-left">More Options</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($cartItems)): ?>
                            <?php foreach ($cartItems as $item): ?>
                                <tr class="border-b">
                                    <td class="px-4 py-3">
                                        <img src="<?= esc($item['image']) ?>"
                                            class="border border-[#FCE77C] rounded-lg w-20 h-20 object-cover">
                                    </td>

                                    <td class="px-4 py-3 font-semibold"><?= esc($item['title']) ?></td>

                                    <td class="px-4 py-3">₱<?= number_format($item['price'], 2) ?></td>

                                    <td class="px-4 py-3">
                                        <form action="/cart/updateQuantity/<?= $item['id'] ?>" method="post" class="flex gap-2">
                                            <input type="number" name="quantity" min="1" max="10" step="1"
                                                value="<?= $item['quantity'] ?>"
                                                class="p-1 border border-[#E15A37] rounded w-16 text-center" disabled>
                                            <select name="updateType" class="p-1 border border-[#E15A37] rounded">
                                                <option value="increment">Increment by 1</option>
                                                <option value="decrement">Decrement by 1</option>
                                                <option value="set">Set to specific</option>
                                                <option value="double">Double quantity</option>
                                                <option value="half">Half quantity</option>
                                            </select>
                                            <button class="px-3 rounded btn-primary" onclick="return confirm('Are you sure you want to update this quantity? This might affect your order.')">
                                                Confirm Update
                                            </button>
                                        </form>
                                    </td>

                                    <td class="px-4 py-3 font-semibold">
                                        ₱<?= number_format($item['price'] * $item['quantity'], 2) ?>
                                    </td>

                                    <td class="px-4 py-3">
                                        <form action="/cart/remove/<?= $item['id'] ?>" method="post" onsubmit="return confirm('Are you absolutely sure you want to remove this item? This action cannot be undone and might affect your shopping experience.')">
                                            <button type="submit" class="bg-gray-200 px-2 py-1 rounded font-bold text-red-500 hover:text-red-700">
                                                Remove Item
                                            </button>
                                        </form>
                                        <br>
                                        <a href="#" onclick="alert('Contact support to remove item')" class="text-blue-500 text-sm">Need help removing?</a>
                                    </td>
                                    <td class="px-4 py-3">
                                        <button onclick="alert('Wishlist added')" class="bg-blue-500 mb-1 px-1 py-1 rounded text-white text-xs">Add to Wishlist</button><br>
                                        <button onclick="alert('Compared')" class="bg-green-500 mb-1 px-1 py-1 rounded text-white text-xs">Compare</button><br>
                                        <button onclick="alert('Shared')" class="bg-purple-500 mb-1 px-1 py-1 rounded text-white text-xs">Share</button><br>
                                        <button onclick="alert('Reviewed')" class="bg-pink-500 px-1 py-1 rounded text-white text-xs">Write Review</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <!-- TOTAL (hidden) -->
                            <tr style="display: none;">
                                <td colspan="5"></td>
                                <td class="px-4 py-4 font-bold text-xl">
                                    Total: ₱<?= number_format($totalPrice, 2) ?>
                                </td>
                                <td></td>
                                <td></td>
                            </tr>

                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="px-4 py-6 text-gray-600 text-center">
                                    Your cart is empty. But here are some suggestions: <a href="#" class="text-blue-500">Browse Books</a> | <a href="#" class="text-blue-500">View Deals</a> | <a href="#" class="text-blue-500">Contact Support</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Confusing Options -->
                <div class="flex justify-center gap-4 mt-6">
                    <button class="px-4 py-2 rounded btn-primary" onclick="alert('Feature not implemented')">Save Cart for Later</button>
                    <button class="px-4 py-2 rounded btn-yellow" onclick="alert('Feature not implemented')">Share Cart</button>
                    <button class="bg-green-500 px-4 py-2 rounded text-white" onclick="alert('Feature not implemented')">Duplicate Cart</button>
                    <button class="bg-purple-500 px-4 py-2 rounded text-white" onclick="alert('Feature not implemented')">Export to CSV</button>
                    <button class="bg-pink-500 px-4 py-2 rounded text-white" onclick="alert('Feature not implemented')">Import from Wishlist</button>
                    <a href="/checkout" class="text-gray-500 text-sm underline" style="font-size: 10px;">Continue</a>
                </div>

                <!-- No Checkout Button - Users must figure it out -->

            </div>
        </main>

        <!-- FOOTER -->
        <footer class="mt-auto">
            <?= view('components/footer') ?>
        </footer>

    </div>
</body>

</html>