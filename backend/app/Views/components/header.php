<?php
$session = \Config\Services::session();
?>
<header class="top-0 z-50 sticky bg-[#e15a37] shadow-lg text-white">
    <div class="flex justify-between items-center mx-auto px-4 py-6 max-w-7xl">

        <!-- Brand -->
        <div class="flex items-center space-x-3">
            <img src="<?= esc($logo ?? '/assets/circle_logo.png') ?>"
                alt="<?= esc($brandTitle ?? 'Fennekin Folios') ?>"
                class="w-10 md:w-12 h-10 md:h-12">

            <div>
                <h1 class="font-bold text-3xl md:text-4xl tracking-wider"
                    style="font-family: 'Righteous', sans-serif;">
                    <?= esc($brandTitle ?? 'Fennekin Folios') ?>
                </h1>

                <?php if (!empty($brandTagline)): ?>
                    <p class="text-[#fce77c] text-sm"><?= esc($brandTagline) ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Desktop Nav -->
        <nav class="hidden md:flex items-center space-x-6">
            <a href="/"
                class="bg-[#fce77c] hover:bg-[#ed865a] shadow-lg px-6 py-3 rounded-full text-[#514d4d] btn-main">
                Home
            </a>

            <a href="/moodboardPage"
                class="bg-[#fce77c] hover:bg-[#ed865a] shadow-lg px-6 py-3 rounded-full text-[#514d4d] btn-main">
                Moodboard
            </a>

            <a href="/roadmapPage"
                class="bg-[#fce77c] hover:bg-[#ed865a] shadow-lg px-6 py-3 rounded-full text-[#514d4d] btn-main">
                Roadmap
            </a>

            <?php if (!$session->has('user')): ?>
                <a href="/loginPage"
                    class="inline-block bg-[#ffffff] hover:opacity-80 shadow-lg px-6 py-3 rounded-full text-[#514d4d]">
                    Login
                </a>
            <?php else: ?>
                <form action="/logout" method="post">
                    <button type="submit"
                        class="inline-block bg-[#ffffff] hover:opacity-80 shadow-lg px-6 py-3 rounded-full text-[#514d4d]">
                        Logout
                    </button>
                </form>
            <?php endif; ?>
        </nav>

        <!-- Mobile Menu Button -->
        <button id="mobileMenuButton" class="md:hidden text-white text-3xl">☰</button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-[#e15a37]">
        <a href="/" class="block hover:bg-[#fce77c]/20 px-6 py-3 text-white">Home</a>
        <a href="/moodboardPage" class="block hover:bg-[#fce77c]/20 px-6 py-3 text-white">Moodboard</a>
        <a href="/roadmapPage" class="block hover:bg-[#fce77c]/20 px-6 py-3 text-white">Roadmap</a>

        <?php if (!$session->has('user')): ?>
            <a href="/login"
                class="inline-block bg-white hover:opacity-80 shadow-lg px-6 py-3 rounded-full text-[#514d4d]">
                Login
            </a>
        <?php else: ?>
            <form action="/logout" method="post" class="px-6 py-3 text-right">
                <button type="submit"
                    class="inline-block bg-white hover:opacity-80 shadow-lg px-6 py-3 rounded-full text-[#514d4d]">
                    Logout
                </button>
            </form>
        <?php endif; ?>
    </div>

    <script>
        const btn = document.getElementById('mobileMenuButton');
        const menu = document.getElementById('mobileMenu');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</header>