<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Requests | Achlys' Bookstore Admin</title>
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

        /* Header */
        .dashboard-header {
            background-color: #E15A37;
            color: #fff;
        }

        /* Sidebar */
        .sidebar {
            background-color: #E15A37;
            color: #fff;
        }

        .sidebar-link {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: #ED865A;
            color: #fff;
        }

        /* Cards hover */
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(225, 90, 55, 0.3);
        }

        /* Accent highlights */
        .accent-yellow {
            background-color: #FCE77C;
        }
    </style>
</head>

<body class="flex min-h-screen">

    <main class="flex-1 bg-white/90 backdrop-blur-sm">

        <!-- Header -->
        <header class="flex justify-between items-center shadow-md px-6 py-4 dashboard-header">
            <h1 class="text-3xl tracking-wide header-title">Book Requests</h1>
            <div class="flex items-center space-x-4">
                <span class="font-semibold">Welcome, <?= esc($adminFirstName ?? 'Admin') ?></span>
            </div>
        </header>

        <div class="bg-white shadow-xl mx-auto mt-6 p-8 border border-[#FCE77C] rounded-2xl max-w-7xl card-hover">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-bold text-[#E15A37] text-4xl header-title">📚 Manage Requests</h2>
                <a href="/admin/requests/add" class="hover:bg-[#ED865A] px-6 py-3 rounded-full font-semibold text-lg transition accent-yellow">➕ New Request</a>
            </div>

            <!-- Filters -->
            <div class="flex md:flex-row flex-col justify-between gap-4 mb-6">
                <input type="text" placeholder="Search by requester or title..." class="px-4 py-2 border border-[#FCE77C] rounded-lg focus:outline-none focus:ring-[#E15A37]/50 focus:ring-2 w-full md:w-1/3" />

                <select class="px-4 py-2 border border-[#FCE77C] rounded-lg focus:outline-none focus:ring-[#E15A37]/50 focus:ring-2 w-full md:w-1/5">
                    <option>All Statuses</option>
                    <option>Pending</option>
                    <option>Approved</option>
                    <option>Denied</option>
                </select>
            </div>

            <!-- Requests Table -->
            <div class="overflow-x-auto">
                <table class="bg-white border border-[#FCE77C] rounded-xl min-w-full overflow-hidden">
                    <thead class="bg-[#E15A37] text-white">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Request ID</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Book Title</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Requester</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Date Requested</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Status</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#FCE77C]">
                        <?php
                        $requests = [
                            ['id' => 'REQ-002', 'book' => 'Atomic Habits', 'requester' => 'Adrian Guillermo', 'date' => '2025-10-28', 'status' => 'Approved'],
                        ];
                        ?>

                        <?php foreach ($requests as $req): ?>
                            <tr class="hover:bg-[#FFF8E7] transition">
                                <td class="px-6 py-4 text-gray-800"><?php echo esc($req['id']); ?></td>
                                <td class="px-6 py-4 font-semibold text-gray-900"><?php echo esc($req['book']); ?></td>
                                <td class="px-6 py-4 text-gray-700"><?php echo esc($req['requester']); ?></td>
                                <td class="px-6 py-4 text-gray-700 text-center"><?php echo esc($req['date']); ?></td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        <?php
                                        if ($req['status'] === 'Approved') echo 'bg-green-100 text-green-700';
                                        elseif ($req['status'] === 'Denied') echo 'bg-red-100 text-red-700';
                                        else echo 'bg-yellow-100 text-yellow-700';
                                        ?>">
                                        <?php echo esc($req['status']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <?php if ($req['status'] === 'Pending'): ?>
                                        <a href="/admin/requests/approve/<?php echo esc($req['id']); ?>" class="mx-2 font-semibold text-green-600 hover:text-green-700">✅ Approve</a>
                                        <a href="/admin/requests/deny/<?php echo esc($req['id']); ?>" class="mx-2 font-semibold text-red-600 hover:text-red-700">❌ Deny</a>
                                    <?php else: ?>
                                        <a href="/admin/requests/view/<?php echo esc($req['id']); ?>" class="mx-2 font-semibold text-[#E15A37] hover:text-[#ED865A]">👁️ View</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Summary Cards -->
            <section class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-10">
                <div class="bg-white shadow-md p-6 border border-[#FCE77C] rounded-xl card-hover">
                    <h3 class="mb-2 text-[#E15A37] text-xl header-title">🕒 Pending Requests</h3>
                    <p class="font-bold text-gray-800 text-3xl">1</p>
                </div>

                <div class="bg-white shadow-md p-6 border border-[#FCE77C] rounded-xl card-hover">
                    <h3 class="mb-2 text-[#E15A37] text-xl header-title">✅ Approved Requests</h3>
                    <p class="font-bold text-gray-800 text-3xl">1</p>
                </div>

                <div class="bg-white shadow-md p-6 border border-[#FCE77C] rounded-xl card-hover">
                    <h3 class="mb-2 text-[#E15A37] text-xl header-title">❌ Denied Requests</h3>
                    <p class="font-bold text-gray-800 text-3xl">1</p>
                </div>
            </section>
        </div>

    </main>

    <!-- Sidebar -->
    <aside class="flex flex-col w-64 sidebar">
        <div class="p-6 border-[#FCE77C] border-b text-center">
            <img src="/assets/fenecircle_logo.png" alt="Fennekin Folios Logo" class="mx-auto mb-3 w-16 h-16">
            <h2 class="text-white text-2xl header-title">Admin Panel</h2>
        </div>

        <nav class="flex-1 space-y-2 p-4">
            <a href="/admin/adminDashboard" class="block hover:bg-[#ED865A] px-4 py-3 rounded-lg hover:text-white sidebar-link">📊 Dashboard</a>
            <a href="/admin/stockPage" class="block hover:bg-[#ED865A] px-4 py-3 rounded-lg hover:text-white sidebar-link">📚 Stocks Page</a>
            <a href="/admin/accountsPage" class="block hover:bg-[#ED865A] px-4 py-3 rounded-lg hover:text-white sidebar-link">👤 Accounts Page</a>
            <a href="/admin/requestPage" class="block bg-[#ED865A]/30 hover:bg-[#ED865A] px-4 py-3 rounded-lg hover:text-white sidebar-link">📝 Requests Page</a>
        </nav>

        <div class="p-4 border-[#FCE77C]/30 border-t">
            <form action="/logout" method="post">
                <?= csrf_field() ?>
                <button type="submit" class="bg-[#FCE77C] hover:bg-[#ED865A] py-2 rounded-lg w-full font-semibold text-[#514D4D] text-center transition">
                    Logout
                </button>
            </form>
        </div>
    </aside>

</body>

</html>