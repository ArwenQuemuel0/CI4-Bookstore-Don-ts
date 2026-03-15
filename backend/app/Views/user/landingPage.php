<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fennekin Folios</title>
    <link rel="shortcut icon" type="image/png" href="/assets/bookstore_icon.ico" />
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

        /* OVERLAY UPDATED TO ORANGE TINT */
        .overlay {
            background: linear-gradient(rgba(44, 41, 41, 0.6), rgba(225, 90, 55, 0.4));
        }

        /* OLD BROWN → PRIMARY ORANGE */
        .custom-neutral {
            background-color: #e15a37;
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

        /* ORANGE SHADOW GLOW */
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

            <!-- Hero Section -->
            <section class="flex justify-center items-center py-32 text-center">
                <div class="bg-white/10 backdrop-blur-sm mx-auto p-8 px-4 rounded-2xl max-w-4xl">

                    <!-- ICON CIRCLE -->
                    <div class="flex justify-center items-center bg-[#e15a37] mx-auto mb-6 rounded-full w-20 h-20 text-white text-3xl">
                        📚
                    </div>

                    <h2 class="drop-shadow-2xl mb-8 font-bold text-white text-5xl md:text-7xl header-title">
                        Buy & Download eBooks Instantly
                    </h2>

                    <p class="mb-12 text-[#ffefaa] text-xl md:text-3xl leading-relaxed">
                        Discover, purchase, and enjoy your favorite books in digital format—anytime, anywhere.
                    </p>

                    <a href="/loginPage"
                        class="inline-block bg-[#fce77c] hover:bg-[#ed865a] shadow-xl px-10 py-5 rounded-full font-semibold text-[#514d4d] text-xl md:text-2xl">
                        Browse eBooks
                    </a>
                </div>
            </section>

            <!-- Featured Products -->
            <section id="products" class="bg-white/90 backdrop-blur-sm py-20 text-[#514d4d]">
                <div class="mx-auto px-4 max-w-6xl">

                    <h3 class="mb-12 font-bold text-[#e15a37] text-4xl text-center header-title">
                        Featured Products
                    </h3>

                    <div class="gap-8 grid md:grid-cols-3">
                        <?= view('components/cards/product_cards', [
                            "title" => "Tales of Japan: Traditional Stories of Monsters and Magic",
                            "description" => "by Kotaro Chiba — A collection of 15 classic Japanese folktales filled with vengeful spirits, brave samurai, and eerie yokai, blending monsters and magic in atmospheric, illustrated stories.",
                            "price" => 199,
                            "image" => "https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1538457160i/41188320.jpg"
                        ]) ?>
                        <?= view('components/cards/product_cards', [
                            "title" => "Japanese Yokai: Explore a Mythical World of Monsters, Demons and Magical Creatures",
                            "description" => "by Fleur Daugey — An illustrated guide to over 30 Japanese yokai that explains how these mysterious monsters, demons, and magical creatures shape strange events and spooky legends in everyday life.",
                            "price" => 149,
                            "image" => "https://unsw-prod.s3.amazonaws.com/media/images/9784805318911_i0UR1OC.original.jpg"
                        ]) ?>
                        <?= view('components/cards/product_cards', [
                            "title" => "Supernatural Tales from Japan",
                            "description" => "by Lafcadio Hearn & Yei Theodora Ozaki — A collection of eerie Japanese ghost stories and yokai legends where goblins, spirits, and magical beings haunt the border between the human and supernatural worlds.",
                            "price" => 179,
                            "image" => "https://cdn11.bigcommerce.com/s-q39b4/images/stencil/2000x2000/products/9578/239719/9784805318539__58590.1709233075.jpg?c=2"
                        ]) ?>
                    </div>

                </div>
            </section>

            <!-- How It Works -->
            <section id="howitworks" class="bg-white/90 backdrop-blur-sm py-20 text-[#514d4d]">
                <div class="mx-auto px-4 max-w-6xl">

                    <h3 class="mb-12 font-bold text-[#e15a37] text-4xl text-center header-title">
                        How It Works
                    </h3>

                    <div class="gap-8 grid md:grid-cols-3">
                        <?= view('components/cards/how_cards', [
                            "number" => "1️⃣",
                            "title" => "Browse & Select",
                            "description" => "Explore our curated collection of eBooks and pick your favorites."
                        ]) ?>
                        <?= view('components/cards/how_cards', [
                            "number" => "2️⃣",
                            "title" => "Secure Payment",
                            "description" => "Pay securely using credit/debit card, GCash, or PayPal."
                        ]) ?>
                        <?= view('components/cards/how_cards', [
                            "number" => "3️⃣",
                            "title" => "Instant Download",
                            "description" => "Get your eBook instantly—read on any device, anytime."
                        ]) ?>
                    </div>

                </div>
            </section>

            <!-- About -->
            <section id="about" class="bg-white/90 backdrop-blur-sm py-20 text-[#514d4d]">
                <div class="mx-auto px-4 max-w-5xl text-center">

                    <h3 class="mb-8 font-bold text-[#e15a37] text-4xl header-title">
                        About Fennekin Folios
                    </h3>

                    <div class="flex justify-center items-center bg-[#e15a37] mx-auto mb-6 rounded-full w-16 h-16 text-white text-2xl">
                        🏛️
                    </div>

                    <p class="mx-auto mb-6 max-w-3xl text-[#514d4d] text-lg leading-relaxed">
                        Fennekin Folios is your trusted online bookstore for digital reading...
                    </p>

                </div>
            </section>

            <!-- CTA Section -->
            <section id="cta-section" class="bg-white/90 backdrop-blur-sm py-32 w-full text-[#514d4d]">
                <div class="text-center">
                    <?= view('components/cta', [
                        'heading' => 'Discover Your Next Favorite Book',
                        'sub' => 'Browse our curated collection...',
                        'primary' => ['label' => 'Shop Now', 'href' => '/loginPage'],
                    ]) ?>
                </div>
            </section>

            <!-- Contact -->
            <section id="contact" class="bg-white/90 backdrop-blur-sm py-20 text-[#514d4d]">
                <div class="mx-auto px-4 max-w-4xl text-center">

                    <h3 class="mb-8 font-bold text-[#e15a37] text-4xl header-title">
                        Contact Us
                    </h3>

                    <div class="flex justify-center items-center bg-[#e15a37] mx-auto mb-6 rounded-full w-16 h-16 text-white text-2xl">
                        📧
                    </div>

                    <p class="mb-4 text-lg">
                        Email:
                        <a href="mailto:support@fennekinfolios.com"
                            class="font-semibold text-[#e15a37] hover:text-[#ed865a] underline">
                            support@fennekinfolios.com
                        </a>
                    </p>

                    <p>
                        For inquiries, partnerships, or bulk orders, reach out anytime!
                    </p>

                </div>
            </section>

            <?= view('components/footer') ?>

        </main>
    </div>

</body>

</html>