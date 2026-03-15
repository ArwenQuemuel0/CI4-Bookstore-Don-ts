<?php
$session = session();

if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}

$userFirstName = $session->get('user')['first_name'] ?? 'Reader';

// Total *quantity* in cart (not total items)
$cart = $session->get('cart') ?? [];
$cartCount = 0;
foreach ($cart as $c) {
    $cartCount += $c['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fennekin Folios – Shop</title>
    <link rel="shortcut icon" type="image/png" href="/assets/bookstore_icon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            background: url('/assets/background.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Roboto Slab', serif;
        }

        .overlay {
            background: linear-gradient(rgba(44, 41, 41, 0.6), rgba(225, 90, 55, 0.4));
        }

        .header-title {
            font-family: "Righteous", sans-serif;
        }

        button:hover,
        .card-hover:hover,
        a:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(225, 90, 55, 0.3);
        }

        .cart-badge {
            top: -0.5rem;
            right: -0.5rem;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <div class="flex flex-col min-h-screen overlay">

        <!-- Header -->
        <?= view('components/header.php', ['showCart' => true, 'cartCount' => $cartCount]) ?>

        <main class="flex-grow">

            <!-- Greeting -->
            <section class="py-16 text-center">
                <h2 class="drop-shadow-lg font-bold text-white text-3xl md:text-4xl header-title">
                    Hello, <?= esc($userFirstName) ?>!
                </h2>
                <p class="mt-2 text-white/90 text-lg md:text-xl">
                    Browse our Japanese books.
                </p>
            </section>

            <!-- PRODUCTS -->
            <section class="bg-white/90 backdrop-blur-sm py-20 text-[#514d4d]">
                <div class="mx-auto px-4 max-w-6xl">

                    <h3 class="mb-12 font-bold text-[#e15a37] text-4xl text-center header-title">
                        Featured Japanese Books
                    </h3>

                    <div class="gap-8 grid md:grid-cols-3">

                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $p): ?>
                                <div class="bg-white border border-[#FCE77C] rounded-xl shadow p-5">

                                    <!-- IMAGE FIX -->
                                    <img src="<?= esc($p->image) ?>"
                                        class="w-full h-64 object-cover rounded-lg mb-3">

                                    <h3 class="font-bold text-[#E15A37] text-xl"><?= esc($p->name) ?></h3>
                                    <p class="text-gray-600 text-sm mb-2"><?= esc($p->description) ?></p>

                                    <p class="font-bold text-lg">₱<?= number_format($p->price, 2) ?></p>

                                    <button
                                        onclick="openCartModal(
                                        '<?= $p->id ?>',
                                        '<?= esc(addslashes($p->name)) ?>',
                                        '<?= $p->price ?>',
                                        '<?= $p->quantity ?>'
                                    )"
                                        class="w-full mt-3 bg-[#E15A37] text-white p-2 rounded-lg">
                                        Add to Cart
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="col-span-3 text-gray-600 text-center">No books available at the moment.</p>
                        <?php endif; ?>

                    </div>
                </div>
            </section>

            <!-- CTA FULL WIDTH (RESTORED) -->
            <section class="bg-white/90 backdrop-blur-sm py-32 w-full text-[#514d4d] text-center">
                <?= view('components/cta', [
                    'heading' => 'Discover More Japanese Folktales',
                    'sub' => 'Explore a curated selection of mystical and supernatural stories that capture the imagination.',
                    'primary' => [
                        'label' => 'Shop Now',
                        'href'  => '/shop'
                    ]
                ]) ?>
            </section>

            <!-- USER REQUEST FORM (RESTORED) -->
            <div class="bg-white shadow-md mx-auto mt-16 mb-16 p-8 border border-[#FCE77C] rounded-xl max-w-3xl">
                <h3 class="mb-4 font-bold text-[#E15A37] text-2xl header-title">Have a Book Request?</h3>
                <p class="mb-4 text-gray-700">If there's a book you'd like us to add, you can submit your request below.</p>

                <?php if (session()->getFlashdata('success')): ?>
                    <p class="mb-4 p-3 bg-green-100 text-green-700 border border-green-300 rounded-lg">
                        <?= session()->getFlashdata('success') ?>
                    </p>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <p class="mb-4 p-3 bg-red-100 text-red-700 border border-red-300 rounded-lg">
                        <?= session()->getFlashdata('error') ?>
                    </p>
                <?php endif; ?>

                <form action="/submitRequest" method="post">
                    <?= csrf_field() ?>

                    <input type="hidden" name="requester_name"
                        value="<?= esc($session->get('user')['first_name'] . ' ' . $session->get('user')['last_name']) ?>">

                    <textarea name="requested_data" placeholder="Enter the book or item you want added..."
                        class="mb-4 p-3 border border-[#E15A37] rounded-lg w-full"
                        rows="3" required></textarea>

                    <textarea name="message" placeholder="Optional message..."
                        class="mb-4 p-3 border border-[#E15A37] rounded-lg w-full"
                        rows="3"></textarea>

                    <button type="submit"
                        class="bg-[#E15A37] hover:bg-[#ED865A] px-6 py-3 rounded-lg font-semibold text-white">
                        Submit Request
                    </button>
                </form>

            </div>

            <!-- FOOTER -->
            <?= view('components/footer') ?>

        </main>
    </div>

    <!-- ADD TO CART MODAL -->
    <div id="cartModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-xl max-w-md">

            <h2 class="text-2xl font-bold text-[#E15A37] mb-4">Add to Cart</h2>

            <p id="modalBookTitle" class="font-bold"></p>
            <p>Available Stock: <span id="modalStock"></span></p>

            <form action="/cart/add" method="post" class="mt-4">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="modalBookId">
                <input type="hidden" name="title" id="modalBookName">
                <input type="hidden" name="price" id="modalBookPrice">

                <label>Quantity</label>
                <input type="number" name="quantity" id="modalQuantity" required min="1"
                    class="border w-full p-2 mb-3">

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeCartModal()" class="border p-2 rounded">Cancel</button>
                    <button type="submit" class="bg-[#E15A37] text-white p-2 rounded">Add</button>
                </div>
            </form>

        </div>
    </div>

    <script>
        function openCartModal(id, name, price, stock) {
            document.getElementById("modalBookId").value = id;
            document.getElementById("modalBookName").value = name;
            document.getElementById("modalBookPrice").value = price;

            document.getElementById("modalBookTitle").innerText = name;
            document.getElementById("modalStock").innerText = stock;

            let qty = document.getElementById("modalQuantity");
            qty.value = 1;
            qty.max = stock;

            document.getElementById("cartModal").classList.remove("hidden");
            document.getElementById("cartModal").classList.add("flex");
        }

        function closeCartModal() {
            document.getElementById("cartModal").classList.add("hidden");
        }
    </script>

</body>

</html>