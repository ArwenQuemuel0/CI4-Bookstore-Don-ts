<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Achlys' Bookstore</title>
    <link rel="shortcut icon" type="image/png" href="/assets/bookstore_icon.ico" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto Slab', serif;
            background-color: #f9f8f6;
        }

        .header-title {
            font-family: "Righteous", sans-serif;
            font-weight: 400;
        }

        .custom-neutral {
            background-color: #8B7E74;
        }

        .sidebar-link {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: #A99D92;
            color: #fff;
        }
    </style>
</head>

<body class="flex min-h-screen">

    <?php
    // sample activities, you can remove this in production
    $activities = $activities ?? [
        [
            'user' => 'Mary Arwen Quemuel',
            'action' => 'Added a new eBook: “Digital Design”',
            'date' => 'Nov 2, 2025'
        ],
        [
            'user' => 'Adrian Guillermo',
            'action' => 'Updated account information',
            'date' => 'Nov 1, 2025'
        ],
        [
            'user' => 'Guest',
            'action' => 'Purchased “The Origin of Species”',
            'date' => 'Oct 31, 2025'
        ]
    ];
    ?>

    <main class="flex-1 bg-white/90 backdrop-blur-sm">

        <header class="flex justify-between items-center shadow-md px-6 py-4 text-gray-100 custom-neutral">
            <h1 class="text-3xl tracking-wide header-title">Dashboard Overview</h1>
            <div class="flex items-center space-x-4">
                <span class="font-semibold">Welcome, <?= esc($adminFirstName ?? 'Admin') ?></span>
                <img src="/assets/profile_placeholder.png" alt="Admin Avatar" class="border border-[#A99D92] rounded-full w-10 h-10">
            </div>
        </header>

        <!-- Dashboard Cards -->
        <?= view('components/cards/dashboard_cards', [
            'totalBooks' => 245,
            'registeredUsers' => $clientsCount ?? 1024,
            'monthlySales' => 58200
        ]) ?>

        <!-- Recent Activity -->
        <?= view('components/cards/recentact_card', [
            'activities' => $activities
        ]) ?>

    </main>

    <!-- Sidebar -->
    <aside class="flex flex-col bg-[#8B7E74] w-64 text-gray-100">
        <div class="p-6 border-[#A99D92] border-b text-center">
            <img src="/assets/circle_logo.png" alt="Achlys Logo" class="mx-auto mb-3 w-16 h-16">
            <h2 class="text-2xl header-title">Admin Panel</h2>
        </div>

        <nav class="flex-1 space-y-2 p-4">
            <a href="/admin/adminDashboard" class="block bg-[#A99D92]/30 px-4 py-3 rounded-lg sidebar-link">📊 Dashboard</a>
            <a href="#" class="block px-4 py-3 rounded-lg sidebar-link">📚 Stocks Page</a>
            <a href="#" class="block px-4 py-3 rounded-lg sidebar-link">👤 Accounts Page</a>
            <a href="#" class="block px-4 py-3 rounded-lg sidebar-link">📝 Requests Page</a>
        </nav>

        <div class="p-4 border-[#A99D92]/30 border-t">
            <!-- Logout must POST to /logout -->
            <form action="/logout" method="post">
                <?= csrf_field() ?>
                <button
                    type="submit"
                    class="bg-[#A99D92] hover:bg-[#7C6F66] py-2 rounded-lg w-full text-center transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

</body>

</html>