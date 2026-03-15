<?php
// Component: components/cards/roadmap_cards.php
// Data contract:
// $title: string
// $description: string
// $status: string
// $priority: string
// $statusClass: string
?>

<div class="bg-lime-500/90 shadow-lg hover:shadow-2xl backdrop-blur-sm p-7 border border-white/20 rounded-2xl transition-all hover:-translate-y-1 duration-300">
    <div class="flex justify-between items-start">
        <h2 class="font-semibold text-black text-xl"><?php echo esc($title ?? ''); ?></h2>
        <span class="status px-3 py-1 rounded-full text-white text-xs font-semibold <?php echo esc($statusClass ?? ''); ?>">
            <?php echo esc($status ?? ''); ?>
        </span>
    </div>
    <p class="mt-2 text-black text-sm">
        <?php echo esc($description ?? ''); ?>
    </p>
    <p class="mt-3 font-medium text-red-500 text-xs">
        Priority: <?php echo esc($priority ?? ''); ?>
    </p>
</div>