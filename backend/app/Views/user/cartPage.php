<?php
$session = session();

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
    <div class="overlay flex flex-col min-h-screen">

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

            <!-- CART BOX -->
            <div class="bg-white shadow-xl mx-auto mt-6 p-8 table-card max-w-6xl">

                <table class="min-w-full">
                    <thead class="bg-[#E15A37] text-white rounded-lg">
                        <tr>
                            <th class="px-4 py-3 text-left">Image</th>
                            <th class="px-4 py-3 text-left">Book</th>
                            <th class="px-4 py-3 text-left">Price</th>
                            <th class="px-4 py-3 text-left">Quantity</th>
                            <th class="px-4 py-3 text-left">Subtotal</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($cartItems)): ?>
                            <?php foreach ($cartItems as $item): ?>
                                <tr class="border-b">
                                    <td class="px-4 py-3">
                                        <img src="<?= esc($item['image']) ?>"
                                            class="w-20 h-20 object-cover rounded-lg border border-[#FCE77C]">
                                    </td>

                                    <td class="px-4 py-3 font-semibold"><?= esc($item['title']) ?></td>

                                    <td class="px-4 py-3">₱<?= number_format($item['price'], 2) ?></td>

                                    <td class="px-4 py-3">
                                        <form action="/cart/updateQuantity/<?= $item['id'] ?>" method="post" class="flex gap-2">
                                            <input type="number" name="quantity" min="1"
                                                value="<?= $item['quantity'] ?>"
                                                class="border border-[#E15A37] p-1 rounded w-16 text-center">

                                            <button class="btn-primary px-3 rounded">
                                                Update
                                            </button>
                                        </form>
                                    </td>

                                    <td class="px-4 py-3 font-semibold">
                                        ₱<?= number_format($item['price'] * $item['quantity'], 2) ?>
                                    </td>

                                    <td class="px-4 py-3">
                                        <a href="/cart/remove/<?= $item['id'] ?>"
                                            class="text-red-500 font-bold hover:text-red-700">
                                            Remove
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <!-- TOTAL -->
                            <tr>
                                <td colspan="4"></td>
                                <td class="px-4 py-4 font-bold text-xl">
                                    Total: ₱<?= number_format($totalPrice, 2) ?>
                                </td>
                                <td></td>
                            </tr>

                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-gray-600 text-center">
                                    Your cart is empty.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Checkout Button -->
                <div class="flex justify-end mt-6">
                    <a href="/checkout"
                        class="btn-yellow px-6 py-3 rounded-full font-semibold shadow">
                        Proceed to Checkout
                    </a>
                </div>

            </div>
        </main>

        <!-- FOOTER -->
        <footer class="mt-auto">
            <?= view('components/footer') ?>
        </footer>

    </div>
</body>

</html>