<?php
$session = session();

// Redirect to login if user is not logged in
if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}

// Get user's first name
$userFirstName = $session->get('user')['first_name'] ?? 'Reader';

// Japanese books array
$products = [
    [
        "title" => "Tales of Japan: Traditional Stories of Monsters and Magic",
        "description" => "by Kotaro Chiba — A collection of 15 classic Japanese folktales filled with vengeful spirits, brave samurai, and eerie yokai, blending monsters and magic in atmospheric, illustrated stories.",
        "price" => 199,
        "image" => "https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1538457160i/41188320.jpg"
    ],
    [
        "title" => "Japanese Yokai: Explore a Mythical World of Monsters, Demons and Magical Creatures",
        "description" => "by Fleur Daugey — An illustrated guide to over 30 Japanese yokai that explains how these mysterious monsters, demons, and magical creatures shape strange events and spooky legends in everyday life.",
        "price" => 149,
        "image" => "https://unsw-prod.s3.amazonaws.com/media/images/9784805318911_i0UR1OC.original.jpg"
    ],
    [
        "title" => "Supernatural Tales from Japan",
        "description" => "by Lafcadio Hearn & Yei Theodora Ozaki — A collection of eerie Japanese ghost stories and yokai legends where goblins, spirits, and magical beings haunt the border between the human and supernatural worlds.",
        "price" => 179,
        "image" => "https://cdn11.bigcommerce.com/s-q39b4/images/stencil/2000x2000/products/9578/239719/9784805318539__58590.1709233075.jpg?c=2"
    ],
    [
        "title" => "The Book of Japanese Folklore: An Encyclopedia of the Spirits, Monsters, and Yokai of Japanese Myth",
        "description" => "by Thersa Matsuura — An illustrated encyclopedia of Japanese spirits, monsters, and yokai that explains their stories, powers, and legends, from mischievous kappa to fearsome oni.",
        "price" => 359,
        "image" => "https://m.media-amazon.com/images/I/51Z1ovbO1yL._AC_SY580_.jpg"
    ],
    [
        "title" => "Japanese Folk Magic",
        "description" => "by Marianna Zanetta — An illustrated look at Japan’s everyday magic, from folk rituals and healing charms to divination and protective talismans rooted in Shinto, Buddhism, and rural tradition.",
        "price" => 400,
        "image" => "https://image.isu.pub/250826114909-2844808b574f6e1a9580a9ef965894c2/jpg/page_1_thumb_large.jpg"
    ],
    [
        "title" => "Kitsune: The Fox Spirit of Japanese Legends",
        "description" => "by Marsha M. Crump — A journey through Japanese legends of the fox spirit, exploring how kitsune shapeshift, trick, protect, and enchant humans in stories that blur the line between mischief and magic.",
        "price" => 250,
        "image" => "https://m.media-amazon.com/images/I/71MOLUftG9L._AC_UF1000,1000_QL80_.jpg"
    ],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fennekin Folios – Shop</title>
    <link rel="shortcut icon" type="image/png" href="/assets/bookstore_icon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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

        .header-title,
        h1,
        h2,
        h3,
        h4,
        .heading {
            font-family: "Righteous", sans-serif;
            font-weight: 400;
        }

        button,
        a.btn-main,
        .card-hover {
            transition: all 0.3s ease;
        }

        button:hover,
        a.btn-main:hover,
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(225, 90, 55, 0.3);
        }

        input:focus,
        .focus-ring:focus {
            transition: all 0.3s ease;
            transform: scale(1.02);
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

            <!-- Products -->
            <section id="products" class="bg-white/90 backdrop-blur-sm py-20 text-[#514d4d]">
                <div class="mx-auto px-4 max-w-6xl">
                    <h3 class="mb-12 font-bold text-[#e15a37] text-4xl text-center header-title">
                        Featured Japanese Books
                    </h3>

                    <div class="gap-8 grid md:grid-cols-3">
                        <?php foreach ($products as $product): ?>
                            <?= view('components/cards/shop_cards', $product) ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <!-- CTA -->
            <section id="cta-section" class="bg-white/90 backdrop-blur-sm py-32 w-full text-[#514d4d] text-center">
                <?= view('components/cta', [
                    'heading' => 'Discover More Japanese Folktales',
                    'sub' => 'Explore a curated selection of mystical and supernatural stories that capture the imagination.',
                    'primary' => ['label' => 'Shop Now', 'href' => '/shop']
                ]) ?>
            </section>

            <!-- Footer -->
            <?= view('components/footer') ?>

        </main>
    </div>
</body>

</html>