<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Accounts | Achlys' Bookstore Admin</title>
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
                <h2 class="font-bold text-[#E15A37] text-4xl header-title">👥 Manage Accounts</h2>
                <a href="/admin/accounts/add" class="hover:bg-[#ED865A] px-6 py-3 rounded-full font-semibold text-lg transition accent-yellow">➕ Add New User</a>
            </div>

            <!-- Search and Filter -->
            <div class="flex md:flex-row flex-col justify-between gap-4 mb-6">
                <input type="text" placeholder="Search name or email..." class="px-4 py-2 border border-[#FCE77C] rounded-lg focus:outline-none focus:ring-[#E15A37]/50 focus:ring-2 w-full md:w-1/3" />

                <select class="px-4 py-2 border border-[#FCE77C] rounded-lg focus:outline-none focus:ring-[#E15A37]/50 focus:ring-2 w-full md:w-1/5">
                    <option>All Roles</option>
                    <option>Admin</option>
                    <option>Client</option>
                </select>
            </div>

            <!-- Accounts Table -->
            <div class="overflow-x-auto">
                <table class="bg-white border border-[#FCE77C] rounded-xl min-w-full overflow-hidden">
                    <thead class="bg-[#E15A37] text-white">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">User ID</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Full Name</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Email</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Role</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Status</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#FCE77C]">
                        <?php
                        $accounts = [
                            ['id' => 'USR-001', 'name' => 'Mary Arwen L. Quemuel', 'email' => 'mlquemuel@fit.edu.ph', 'role' => 'Admin', 'status' => 'Active'],
                            ['id' => 'USR-002', 'name' => 'Adrian Aseñas Guillermo', 'email' => 'aaguillermo@fit.edu.ph', 'role' => 'Client', 'status' => 'Active'],
                            ['id' => 'USR-003', 'name' => 'Sophia Dela Cruz', 'email' => 'sdelacruz@fit.edu.ph', 'role' => 'Client', 'status' => 'Suspended'],
                        ];
                        ?>

                        <?php foreach ($accounts as $user): ?>
                            <tr class="hover:bg-[#FFF8E7] transition">
                                <td class="px-6 py-4 text-gray-800"><?php echo esc($user['id']); ?></td>
                                <td class="px-6 py-4 font-semibold text-gray-900"><?php echo esc($user['name']); ?></td>
                                <td class="px-6 py-4 text-gray-700"><?php echo esc($user['email']); ?></td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        <?php echo $user['role'] === 'Admin' ? 'bg-[#E15A37] text-white' : 'bg-[#FCE77C] text-gray-800'; ?>">
                                        <?php echo esc($user['role']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        <?php echo $user['status'] === 'Active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'; ?>">
                                        <?php echo esc($user['status']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="/admin/accounts/edit/<?php echo esc($user['id']); ?>" class="mx-2 font-semibold text-[#E15A37] hover:text-[#ED865A]">✏️ Edit</a>
                                    <a href="/admin/accounts/delete/<?php echo esc($user['id']); ?>" class="mx-2 font-semibold text-red-500 hover:text-red-600" onclick="return confirm('Are you sure you want to delete this account?')">🗑️ Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Summary Cards -->
            <section class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-10">
                <div class="bg-white shadow-md p-6 border border-[#FCE77C] rounded-xl card-hover">
                    <h3 class="mb-2 text-[#E15A37] text-xl header-title">👥 Total Users</h3>
                    <p class="font-bold text-gray-800 text-3xl">3</p>
                </div>

                <div class="bg-white shadow-md p-6 border border-[#FCE77C] rounded-xl card-hover">
                    <h3 class="mb-2 text-[#E15A37] text-xl header-title">🧑‍💼 Admin Accounts</h3>
                    <p class="font-bold text-gray-800 text-3xl">1</p>
                </div>

                <div class="bg-white shadow-md p-6 border border-[#FCE77C] rounded-xl card-hover">
                    <h3 class="mb-2 text-[#E15A37] text-xl header-title">🧾 Client Accounts</h3>
                    <p class="font-bold text-gray-800 text-3xl">2</p>
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
            <a href="/admin/accountsPage" class="block bg-[#ED865A]/30 hover:bg-[#ED865A] px-4 py-3 rounded-lg hover:text-white sidebar-link">👤 Accounts Page</a>
            <a href="/admin/requestPage" class="block hover:bg-[#ED865A] px-4 py-3 rounded-lg hover:text-white sidebar-link">📝 Requests Page</a>
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