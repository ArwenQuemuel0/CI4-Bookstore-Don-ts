<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Achlys' Bookstore</title>
    <link rel="shortcut icon" type="image/png" href="/assets/bookstore_icon.ico" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            background: url('https://static.vecteezy.com/system/resources/previews/022/336/538/non_2x/coffee-and-book-minimalist-background-illustration-ai-generative-free-photo.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Roboto Slab', serif;
        }

        .overlay {
            background: linear-gradient(rgba(44, 41, 41, 0.6), rgba(139, 126, 116, 0.4));
        }

        .custom-neutral {
            background-color: #8B7E74;
        }

        .header-title,
        h1,
        h2,
        h3,
        h4,
        .heading {
            font-family: "Righteous", sans-serif;
            font-weight: 400;
            font-style: normal;
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
            box-shadow: 0 8px 20px rgba(139, 126, 116, 0.3);
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
                    <div class="flex justify-center items-center bg-[#8B7E74] mx-auto mb-6 rounded-full w-20 h-20 text-white text-3xl">
                        📚
                    </div>
                    <h2 class="drop-shadow-2xl mb-8 font-bold text-gray-50 text-5xl md:text-7xl header-title">
                        Buy & Download eBooks Instantly
                    </h2>
                    <p class="mb-12 text-gray-200 text-xl md:text-3xl leading-relaxed">
                        Discover, purchase, and enjoy your favorite books in digital format—anytime, anywhere.
                    </p>
                    <a href="#ebooks" class="inline-block bg-white hover:bg-gray-100 shadow-xl px-10 py-5 rounded-full focus:outline-none focus:ring-[#8B7E74]/50 focus:ring-4 font-semibold text-gray-800 text-xl md:text-2xl transition-all duration-300 btn-main">
                        Browse eBooks
                    </a>
                </div>
            </section>

            <!-- Featured Products -->
            <section id="products" class="bg-white/90 backdrop-blur-sm py-20 text-gray-900">
                <div class="mx-auto px-4 max-w-6xl">
                    <h3 class="mb-12 font-bold text-[#8B7E74] text-4xl text-center header-title">
                        Featured Products
                    </h3>
                    <div class="gap-8 grid md:grid-cols-3">
                        <?= view('components/cards/product_cards', [
                            "title" => "The Lord of the Rings",
                            "description" => "by J.R.R. Tolkien — A story about Frodo Baggins’ quest to destroy a dark lord’s powerful ring and save Middle-earth.",
                            "price" => 199,
                            "image" => "https://cdn.shopify.com/s/files/1/0070/1884/0133/t/8/assets/pf-8a8430b5--Books5.jpg?v=1620061376"
                        ]) ?>
                        <?= view('components/cards/product_cards', [
                            "title" => "Harry Potter and the Sorcerer's Stone",
                            "description" => "by J.K. Rowling — A story about young wizard Harry as he discovers his magical heritage, attends Hogwarts School, and faces dark forces.",
                            "price" => 149,
                            "image" => "https://cdn.shopify.com/s/files/1/0070/1884/0133/t/8/assets/pf-b57dac15--Books8_1200x.jpg?v=1620061403"
                        ]) ?>
                        <?= view('components/cards/product_cards', [
                            "title" => "The Origin of Species",
                            "description" => "by Charles Darwin — Explains how species evolve over time through natural selection, laying the foundation for modern evolutionary biology.",
                            "price" => 179,
                            "image" => "https://cdn.shopify.com/s/files/1/0070/1884/0133/t/8/assets/pf-71b40b91--Books_1200x.jpg?v=1620061288"
                        ]) ?>
                    </div>
                </div>
            </section>

            <!-- How It Works -->
            <section id="howitworks" class="bg-white/90 backdrop-blur-sm py-20 text-gray-900">
                <div class="mx-auto px-4 max-w-6xl">
                    <h3 class="mb-12 font-bold text-[#8B7E74] text-4xl text-center header-title">
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
            <section id="about" class="bg-white/90 backdrop-blur-sm py-20 text-gray-900">
                <div class="mx-auto px-4 max-w-5xl text-center">
                    <h3 class="mb-8 font-bold text-[#8B7E74] text-4xl header-title">
                        About Achlys' Bookstore
                    </h3>
                    <div class="flex justify-center items-center bg-[#8B7E74] mx-auto mb-6 rounded-full w-16 h-16 text-white text-2xl">
                        🏛️
                    </div>
                    <p class="mx-auto mb-6 max-w-3xl text-gray-700 text-lg leading-relaxed">
                        Achlys Bookstore is your trusted online bookstore for digital reading. We offer a wide range of genres, from business and self-help to fiction and technology, all available in convenient soft copy formats. Enjoy affordable prices, instant access, and a seamless reading experience.
                    </p>
                </div>
            </section>

            <!-- CTA -->
            <section id="cta-section" class="bg-white/90 backdrop-blur-sm py-32 w-full text-gray-900">
                <div class="text-center">
                    <?= view('components/cta', [
                        'heading' => 'Discover Your Next Favorite Book',
                        'sub' => 'Browse our curated collection of timeless stories and join thousands of readers today. Get started with exclusive deals just for you.',
                        'primary' => ['label' => 'Shop Now', 'href' => '/shop'],
                    ]) ?>
                </div>
            </section>

            <!-- Contact -->
            <section id="contact" class="bg-white/90 backdrop-blur-sm py-20 text-gray-900">
                <div class="mx-auto px-4 max-w-4xl text-center">
                    <h3 class="mb-8 font-bold text-[#8B7E74] text-4xl header-title">
                        Contact Us
                    </h3>
                    <div class="flex justify-center items-center bg-[#8B7E74] mx-auto mb-6 rounded-full w-16 h-16 text-white text-2xl">
                        📧
                    </div>
                    <p class="mb-4 text-gray-700 text-lg">
                        Email: <a href="mailto:support@achlysbookstore.com" class="font-semibold text-[#8B7E74] hover:text-[#A99D92] underline transition-colors">support@achlysbookstore.com</a>
                    </p>
                    <p class="text-gray-700">
                        For inquiries, partnerships, or bulk orders, reach out anytime!
                    </p>
                </div>
            </section>

            <?= view('components/footer') ?>

        </main>
    </div>

</body>

</html>