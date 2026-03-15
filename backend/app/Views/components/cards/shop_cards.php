<?php
// Component: components/cards/shop_card.php
// $title, $description, $price, $image
?>

<div class="flex flex-col bg-indigo-500 shadow-lg hover:shadow-2xl p-6 border border-yellow-500 rounded-2xl transition-all duration-300 card-hover">

    <!-- Image Section -->
    <div class="flex justify-center items-center bg-yellow-200 mb-4 rounded-xl w-full h-56 overflow-hidden">
        <?php if (!empty($image)): ?>
            <img src="<?= esc($image) ?>"
                alt="Product: <?= esc($title) ?>"
                class="rounded-xl w-full h-full object-cover"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
        <?php endif; ?>
        <div class="hidden flex justify-center items-center bg-gradient-to-br from-red-500/20 to-transparent rounded-xl w-full h-56 text-3xl">
            📖
        </div>
    </div>

    <!-- Title -->
    <h4 class="mb-2 font-semibold text-white text-2xl text-center header-title">
        <?= esc($title ?? '') ?>
    </h4>

    <!-- Description -->
    <p class="flex-grow mb-4 text-white text-center leading-relaxed">
        <?= esc($description ?? '') ?>
    </p>

    <!-- Price and Button -->
    <div class="flex justify-between items-center mt-auto">
        <span class="font-bold text-yellow-300 text-xl">
            ₱<?= esc($price ?? '') ?>
        </span>
        <a href="/loginPage"
            class="bg-red-500 hover:bg-green-500 px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-red-500 font-semibold text-white text-sm transition">
            Add to Cart
        </a>
    </div>
</div>