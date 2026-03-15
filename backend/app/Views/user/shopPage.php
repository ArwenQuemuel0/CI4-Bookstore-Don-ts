<?php
$session = session();

// Redirect to login if user is not logged in
if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}

// Get user's first name
$userFirstName = $session->get('user')['first_name'] ?? 'Reader';
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
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(225, 90, 55, 0.3);
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <div class="flex flex-col min-h-screen overlay">

        <?= view('components/header.php') ?>

        <main class="flex-grow">

            <!-- Greeting -->
            <section class="py-16 text-center">
                <h2 class="drop-shadow-lg font-bold text-white text-3xl md:text-4xl header-title">
                    Hello, <?= esc($userFirstName) ?>!
                </h2>
                <p class="mt-2 text-white/90 text-lg md:text-xl">
                    Welcome back! Browse and purchase your favorite Japanese folktales and supernatural stories.
                </p>
            </section>

            <!-- Products from Database -->
            <section class="bg-white/90 backdrop-blur-sm py-20 text-[#514d4d]">
                <div class="mx-auto px-4 max-w-6xl">

                    <h3 class="mb-12 font-bold text-[#e15a37] text-4xl text-center header-title">
                        Featured Japanese Books
                    </h3>

                    <div class="gap-8 grid md:grid-cols-3">

                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <?= view('components/cards/shop_cards', [
                                    'title'       => $product->name,
                                    'description' => $product->description,
                                    'price'       => $product->price,
                                    'image'       => $product->image
                                ]) ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-center text-gray-600 col-span-3">
                                No books available at the moment.
                            </p>
                        <?php endif; ?>

                    </div>

                </div>
            </section>

            <!-- CTA -->
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

            <!-- Footer -->
            <?= view('components/footer') ?>

        </main>
    </div>
</body>

</html>