<?php
// Component: components/cards/product_card.php
// Data contract:
// $title: string
// $description: string
// $price: string|int
// $image: string|null
?>

<div class="bg-white p-2 border">

    <!-- Image Section -->
    <div class="bg-gray-100 w-full h-32 overflow-hidden">
        <?php if (!empty($image)): ?>
            <img
                src="<?php echo esc($image); ?>"
                alt="Product: <?php echo esc($title); ?>"
                class="w-full h-full object-cover">
        <?php endif; ?>
        <div class="flex justify-center items-center bg-gray-200 w-full h-32 text-xl">
            📖
        </div>
    </div>

    <!-- Title -->
    <h4 class="font-bold text-gray-800 text-lg">
        <?php echo esc($title ?? ''); ?>
    </h4>

    <!-- Description -->
    <p class="text-gray-600 text-sm">
        <?php echo esc($description ?? ''); ?>
    </p>

    <!-- Price and Button -->
    <div class="flex justify-between items-center">
        <span class="font-bold text-red-600">
            ₱<?php echo esc($price ?? ''); ?>
        </span>
        <a href="/loginPage"
            class="bg-red-600 px-3 py-1 text-white text-xs">
            Buy Now
        </a>
    </div>
</div>