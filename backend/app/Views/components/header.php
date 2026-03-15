<?php
$session = \Config\Services::session();

// Count items in cart
$cartCount = $session->has('cart') ? count($session->get('cart')) : 0;

// Determine home URL dynamically
$homeUrl = $session->has('user') ? '/shop' : '/';
?>

<header class="top-0 z-50 sticky bg-[#e15a37] shadow-lg text-white">
    <div class="flex justify-between items-center mx-auto px-4 py-6 max-w-7xl">

        <!-- Brand -->
        <div class="flex items-center space-x-3">
            <img src="<?= esc($logo ?? '/assets/fenecircle_logo.png') ?>"
                alt="<?= esc($brandTitle ?? 'Fennekin Folios') ?>"
                class="w-12 h-12">
            <h1 class="font-bold text-3xl md:text-4xl tracking-wider" style="font-family: 'Righteous', sans-serif;">
                <?= esc($brandTitle ?? 'Fennekin Folios') ?>
            </h1>
        </div>

        <!-- Desktop Nav + Logout + Cart -->
        <div class="hidden md:flex items-center space-x-4">
            <a href="<?= esc($homeUrl) ?>" class="bg-[#fce77c] hover:bg-[#ed865a] shadow-lg px-6 py-3 rounded-full text-[#514d4d] btn-main">
                Home
            </a>
            <a href="/moodboardPage" class="bg-[#fce77c] hover:bg-[#ed865a] shadow-lg px-6 py-3 rounded-full text-[#514d4d] btn-main">
                Moodboard
            </a>
            <a href="/roadmapPage" class="bg-[#fce77c] hover:bg-[#ed865a] shadow-lg px-6 py-3 rounded-full text-[#514d4d] btn-main">
                Roadmap
            </a>

            <?php if ($session->has('user')): ?>
                <form action="/logout" method="post">
                    <button type="submit" class="inline-block bg-white hover:opacity-80 shadow-lg px-6 py-3 rounded-full text-[#514d4d]">
                        Logout
                    </button>
                </form>

                <!-- Cart Icon -->
                <a href="/cart" class="relative flex items-center ml-4">
                    <img src="/assets/cart_icon.png" alt="Cart" class="w-10 h-10">
                    <?php if ($cartCount > 0): ?>
                        <span class="-top-2 -right-2 absolute flex justify-center items-center bg-red-500 rounded-full w-5 h-5 text-white text-xs">
                            <?= $cartCount ?>
                        </span>
                    <?php endif; ?>
                </a>
            <?php else: ?>
                <a href="/loginPage" class="inline-block bg-white hover:opacity-80 shadow-lg px-6 py-3 rounded-full text-[#514d4d]">
                    Login
                </a>
            <?php endif; ?>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobileMenuButton" class="md:hidden text-white text-3xl">☰</button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-[#e15a37]">
        <a href="<?= esc($homeUrl) ?>" class="block hover:bg-[#fce77c]/20 px-6 py-3 text-white">Home</a>
        <a href="/moodboardPage" class="block hover:bg-[#fce77c]/20 px-6 py-3 text-white">Moodboard</a>
        <a href="/roadmapPage" class="block hover:bg-[#fce77c]/20 px-6 py-3 text-white">Roadmap</a>
        <?php if ($session->has('user')): ?>
            <a href="/cart" class="block hover:bg-[#fce77c]/20 px-6 py-3 text-white">
                Cart (<?= $cartCount ?>)
            </a>
            <form action="/logout" method="post" class="px-6 py-3 text-right">
                <button type="submit" class="inline-block bg-white hover:opacity-80 shadow-lg px-6 py-3 rounded-full text-[#514d4d]">
                    Logout
                </button>
            </form>
        <?php else: ?>
            <a href="/loginPage" class="inline-block bg-white hover:opacity-80 shadow-lg px-6 py-3 rounded-full text-[#514d4d]">Login</a>
        <?php endif; ?>
    </div>

    <script>
        const btn = document.getElementById('mobileMenuButton');
        const menu = document.getElementById('mobileMenu');
        btn.addEventListener('click', () => menu.classList.toggle('hidden'));
    </script>
</header>