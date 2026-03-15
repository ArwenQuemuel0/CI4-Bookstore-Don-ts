<?php
// Component: components/cards/dashboard_cards.php
// Data contract:
// $totalBooks: int
// $registeredUsers: int
// $monthlySales: float|int
?>

<section class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 p-8">
    <!-- Total Books -->
    <div class="bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl transition-all duration-300 card-hover">
        <h3 class="mb-2 text-[#8B7E74] text-xl header-title">📘 Total Books</h3>
        <p class="font-bold text-gray-800 text-3xl">
            <?php echo esc($totalBooks ?? 0); ?>
        </p>
    </div>

    <!-- Registered Users -->
    <div class="bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl transition-all duration-300 card-hover">
        <h3 class="mb-2 text-[#8B7E74] text-xl header-title">👥 Registered Users</h3>
        <p class="font-bold text-gray-800 text-3xl">
            <?php echo esc($registeredUsers ?? 0); ?>
        </p>
    </div>

    <!-- Monthly Sales -->
    <div class="md:col-span-2 lg:col-span-1 bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl transition-all duration-300 card-hover">
        <h3 class="mb-2 text-[#8B7E74] text-xl header-title">💰 Monthly Sales</h3>
        <p class="font-bold text-gray-800 text-3xl">
            ₱<?php echo number_format($monthlySales ?? 0, 2); ?>
        </p>
    </div>
</section>