<?php
// Component: components/cards/how_cards.php
// Data contract:
// $number: string
// $title: string
// $description: string
?>

<div class="flex flex-col bg-white shadow-lg hover:shadow-2xl p-6 border border-gray-200/50 rounded-2xl transition-all duration-300 card-hover">
    <!-- Number Circle -->
    <div class="flex justify-center items-center bg-[#8B7E74] text-white text-xl font-bold w-12 h-12 rounded-full mx-auto mb-4">
        <?php echo esc($number ?? ''); ?>
    </div>

    <!-- Title -->
    <h4 class="mb-2 font-semibold text-gray-900 text-2xl header-title text-center">
        <?php echo esc($title ?? ''); ?>
    </h4>

    <!-- Description -->
    <p class="flex-grow mb-4 text-gray-700 leading-relaxed text-center">
        <?php echo esc($description ?? ''); ?>
    </p>
</div>