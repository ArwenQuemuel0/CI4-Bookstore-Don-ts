<?php
// Component: components/cards/dashboard_cards.php
?>

<style>
    .card-hover {
        transition: all 0.1s ease;
    }

    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 0, 0, 0.5);
    }
</style>

<section class="flex justify-center p-8">
    <div class="gap-8 grid grid-cols-1 md:grid-cols-2 w-full max-w-5xl">

        <!-- Total Books -->
        <div class="bg-red-500 shadow-md p-6 border border-green-500 rounded-xl card-hover">
            <h3 class="mb-2 text-yellow-300 text-xl header-title">📘 Total Books</h3>
            <p class="font-bold text-white text-3xl">
                <?= esc($totalBooks ?? 0) ?>
            </p>
        </div>

        <!-- Registered Users -->
        <div class="bg-green-500 shadow-md p-6 border border-red-500 rounded-xl card-hover">
            <h3 class="mb-2 text-pink-300 text-xl header-title">👥 Registered Users</h3>
            <p class="font-bold text-white text-3xl">
                <?= esc($registeredUsers ?? 0) ?>
            </p>
        </div>

    </div>
</section>