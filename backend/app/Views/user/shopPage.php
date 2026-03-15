<?php
$session = session();

if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}

// Use the passed in name (preferred) or fall back to profile data.
$userFirstName = $userFirstName ?? ($session->get('user')['profile']['display_name'] ?? $session->get('user')['first_name'] ?? 'Reader');

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
            font-family: Arial, serif;
        }

        .overlay {
            background: linear-gradient(rgba(44, 41, 41, 0.6), rgba(225, 90, 55, 0.4));
        }

        .header-title {
            font-family: "Times New Roman", sans-serif;
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

            <!-- USER RATING -->
            <div class="bg-white shadow-md mx-auto mb-16 p-2 border border-[#FCE77C] rounded-xl max-w-3xl">
                <h3 class="mb-2 font-bold text-red-500 text-lg header-title">Rate Stuff</h3>
                <p class="mb-2 text-gray-700 text-xs">Do something.</p>

                <form action="/ratings" method="post" class="space-y-2">
                    <?= csrf_field() ?>

                    <div>
                        <label class="block mb-1 font-semibold text-[#514d4d] text-xs">Pick Numbers</label>
                        <div class="flex gap-1">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <input type="checkbox" name="rating[]" value="<?= $i ?>" class="w-3 h-3">
                            <?php endfor; ?>
                        </div>
                    </div>

                    <button type="submit"
                        class="bg-gray-200 px-1 py-0.5 rounded text-gray-600 text-xs">
                        Go
                    </button>
                </form>
            </div>

            <!-- USER REQUEST FORM (RESTORED) -->
            <div class="bg-white shadow-md mx-auto mt-16 mb-16 p-8 border border-[#FCE77C] rounded-xl max-w-3xl">
                <h3 class="mb-4 font-bold text-red-500 text-2xl header-title">Have a Book Request?</h3>
                <p class="mb-4 text-gray-700">If there's a book you'd like us to add, you can submit your request below.</p>

                <?php if (session()->getFlashdata('success')): ?>
                    <p class="bg-green-100 mb-4 p-3 border border-green-300 rounded-lg text-green-700">
                        <?= session()->getFlashdata('success') ?>
                    </p>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <p class="bg-red-100 mb-4 p-3 border border-red-300 rounded-lg text-red-700">
                        <?= session()->getFlashdata('error') ?>
                    </p>
                <?php endif; ?>

                <form action="/submitRequest" method="post">
                    <?= csrf_field() ?>

                    <input type="hidden" name="requester_name"
                        value="<?= esc($session->get('user')['profile']['display_name'] ?? ($session->get('user')['first_name'] . ' ' . $session->get('user')['last_name'])) ?>">

                    <textarea name="requested_data" placeholder="Enter the book or item you want added..."
                        class="mb-4 p-3 border border-[#E15A37] rounded-lg w-full"
                        rows="3" required></textarea>

                    <textarea name="message" placeholder="Optional message..."
                        class="mb-4 p-3 border border-[#E15A37] rounded-lg w-full"
                        rows="3"></textarea>

                    <button type="submit"
                        class="bg-transparent opacity-50 hover:opacity-75 px-2 py-1 rounded font-normal text-gray-500">
                        Submit Request
                    </button>
                </form>

            </div>

            <!-- PRODUCTS -->
            <section class="bg-white/90 backdrop-blur-sm py-20 text-[#514d4d]">
                <div class="mx-auto px-4 max-w-6xl">

                    <h3 class="mb-12 font-bold text-red-500 text-4xl text-center header-title">
                        Featured Japanese Books
                    </h3>

                    <div class="gap-8 grid md:grid-cols-3">

                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $p): ?>
                                <div class="bg-white shadow p-5 border border-[#FCE77C] rounded-xl">

                                    <!-- IMAGE FIX -->
                                    <img src="<?= esc($p->image) ?>"
                                        class="mb-3 rounded-lg w-full h-64 object-cover">

                                    <h3 class="font-bold text-red-500 text-xl"><?= esc($p->name) ?></h3>
                                    <p class="mb-2 text-gray-600 text-sm"><?= esc($p->description) ?></p>

                                    <p class="font-bold text-lg">₱<?= number_format($p->price, 2) ?></p>

                                    <button
                                        onclick="openCartModal(
                                        '<?= $p->id ?>',
                                        '<?= esc(addslashes($p->name)) ?>',
                                        '<?= $p->price ?>',
                                        '<?= $p->quantity ?>'
                                    )"
                                        class="bg-transparent opacity-50 hover:opacity-75 mt-3 p-1 rounded w-full text-gray-500 text-sm">
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
            <?= view('components/cta', [
                'heading' => 'Discover More Japanese Folktales',
                'sub' => 'Explore a curated selection of mystical and supernatural stories that capture the imagination.',
                'primary' => [
                    'label' => 'Shop Now',
                    'href'  => '/shop'
                ]
            ]) ?>
            </section>

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

                    <h3 class="mb-12 font-bold text-red-500 text-4xl text-center header-title">
                        Featured Japanese Books
                    </h3>

                    <div class="gap-8 grid md:grid-cols-3">

                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $p): ?>
                                <div class="bg-white shadow p-5 border border-[#FCE77C] rounded-xl">

                                    <!-- IMAGE FIX -->
                                    <img src="<?= esc($p->image) ?>"
                                        class="mb-3 rounded-lg w-full h-64 object-cover">

                                    <h3 class="font-bold text-red-500 text-xl"><?= esc($p->name) ?></h3>
                                    <p class="mb-2 text-gray-600 text-sm"><?= esc($p->description) ?></p>

                                    <p class="font-bold text-lg">₱<?= number_format($p->price, 2) ?></p>

                                    <button
                                        onclick="openCartModal(
                                        '<?= $p->id ?>',
                                        '<?= esc(addslashes($p->name)) ?>',
                                        '<?= $p->price ?>',
                                        '<?= $p->quantity ?>'"
                                        class="bg-transparent opacity-50 hover:opacity-75 mt-3 p-1 rounded w-full text-gray-500 text-sm">
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

    </div>

    <!-- FOOTER -->
    <?= view('components/footer') ?>

    </main>
    </div>

    <!-- ADD TO CART MODAL -->
    <div id="cartModal" class="hidden z-50 fixed inset-0 justify-center items-center bg-black/50">

        <div class="bg-white shadow-xl p-8 border border-[#FCE77C] rounded-2xl w-full max-w-md">

            <h2 class="mb-4 font-bold text-red-500 text-3xl">
                Add to Cart
            </h2>

            <p id="modalBookTitle" class="mb-1 font-semibold text-[#514D4D] text-lg"></p>
            <p class="mb-4 text-gray-600 text-sm">
                Available Stock: <span id="modalStock"></span>
            </p>

            <form action="/cart/add" method="post" class="mt-2">
                <?= csrf_field() ?>

                <input type="hidden" name="id" id="modalBookId">
                <input type="hidden" name="title" id="modalBookName">
                <input type="hidden" name="price" id="modalBookPrice">

                <label class="block mb-1 font-semibold text-[#514D4D]">Quantity</label>
                <input type="number" name="quantity" id="modalQuantity" required min="1"
                    class="mb-6 p-2 border border-[#E15A37] rounded-lg focus:ring-[#E15A37]/40 focus:ring-2 w-full">

                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeCartModal()"
                        class="hover:bg-[#FFF1EB] px-5 py-2 border border-[#E15A37] rounded-lg font-semibold text-red-500">
                        Cancel
                    </button>

                    <button type="submit"
                        class="bg-red-500 hover:bg-green-500 px-5 py-2 rounded-lg font-semibold text-white">
                        Add
                    </button>
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

    <!-- 🔥 ORDER SUCCESS MODAL -->
    <?php if (session()->getFlashdata('success')): ?>
        <div id="orderSuccessModal"
            class="z-50 fixed inset-0 flex justify-center items-center bg-black bg-opacity-50">

            <div class="bg-white shadow-xl p-8 border-[#FCE77C] border-2 rounded-2xl max-w-md text-center">

                <h2 class="mb-4 font-bold text-red-500 text-3xl">
                    Order Successful!
                </h2>

                <p class="mb-6 text-gray-700 text-lg">
                    <?= session()->getFlashdata('success') ?>
                </p>

                <button onclick="closeSuccessModal()"
                    class="bg-red-500 hover:bg-green-500 px-6 py-3 rounded-lg font-semibold text-white">
                    Continue Shopping
                </button>

            </div>
        </div>

        <script>
            function closeSuccessModal() {
                document.getElementById("orderSuccessModal").remove();
            }
        </script>
    <?php endif; ?>

</body>

</html>






