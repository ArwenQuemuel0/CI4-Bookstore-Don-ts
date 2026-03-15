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
            background-color: #f8f7f5;
            font-family: 'Roboto Slab', serif;
        }

        .header-title {
            font-family: 'Righteous', sans-serif;
        }

        .custom-neutral {
            background-color: #8B7E74;
        }

        .btn-main {
            background-color: #8B7E74;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-main:hover {
            background-color: #A99D92;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(139, 126, 116, 0.3);
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">

    <!-- ✅ Accounts Page Header -->
    <header class="flex justify-between items-center shadow-md px-6 py-4 text-gray-100 custom-neutral">
        <h1 class="text-3xl tracking-wide header-title">User Accounts</h1>
        <div class="flex items-center space-x-4">
            <span class="font-semibold">Welcome, Admin</span>
            <img src="/assets/profile_placeholder.png" alt="Admin Avatar" class="border border-[#A99D92] rounded-full w-10 h-10">
        </div>
    </header>

    <main class="flex-grow p-10">
        <div class="bg-white shadow-xl mx-auto p-8 border border-[#E5E0DC] rounded-2xl max-w-7xl">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-bold text-[#8B7E74] text-4xl header-title">👥 Manage Accounts</h2>
                <a href="/admin/accounts/add" class="px-6 py-3 rounded-full font-semibold text-lg btn-main">➕ Add New User</a>
            </div>

            <!-- Search and Filter -->
            <div class="flex md:flex-row flex-col justify-between gap-4 mb-6">
                <input type="text" placeholder="Search name or email..." class="px-4 py-2 border border-[#E5E0DC] rounded-lg focus:outline-none focus:ring-[#8B7E74]/50 focus:ring-2 w-full md:w-1/3" />

                <select class="px-4 py-2 border border-[#E5E0DC] rounded-lg focus:outline-none focus:ring-[#8B7E74]/50 focus:ring-2 w-full md:w-1/5">
                    <option>All Roles</option>
                    <option>Admin</option>
                    <option>Client</option>
                </select>
            </div>

            <!-- Accounts Table -->
            <div class="overflow-x-auto">
                <table class="bg-white border border-[#E5E0DC] rounded-xl min-w-full overflow-hidden">
                    <thead class="bg-[#8B7E74] text-white">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">User ID</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Full Name</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Email</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Role</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Status</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E5E0DC]">
                        <?php
                        $accounts = [
                            ['id' => 'USR-001', 'name' => 'Mary Arwen L. Quemuel', 'email' => 'mlquemuel@fit.edu.ph', 'role' => 'Admin', 'status' => 'Active'],
                            ['id' => 'USR-002', 'name' => 'Adrian Aseñas Guillermo', 'email' => 'aaguillermo@fit.edu.ph', 'role' => 'Client', 'status' => 'Active'],
                            ['id' => 'USR-003', 'name' => 'Sophia Dela Cruz', 'email' => 'sdelacruz@fit.edu.ph', 'role' => 'Client', 'status' => 'Suspended'],
                        ];
                        ?>

                        <?php foreach ($accounts as $user): ?>
                            <tr class="hover:bg-[#F9F7F4] transition">
                                <td class="px-6 py-4 text-gray-800"><?php echo esc($user['id']); ?></td>
                                <td class="px-6 py-4 font-semibold text-gray-900"><?php echo esc($user['name']); ?></td>
                                <td class="px-6 py-4 text-gray-700"><?php echo esc($user['email']); ?></td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-sm font-semibold
                                        <?php echo $user['role'] === 'Admin' ? 'bg-[#8B7E74] text-white' : 'bg-[#E5E0DC] text-gray-800'; ?>">
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
                                    <a href="/admin/accounts/edit/<?php echo esc($user['id']); ?>" class="mx-2 font-semibold text-[#8B7E74] hover:text-[#A99D92]">✏️ Edit</a>
                                    <a href="/admin/accounts/delete/<?php echo esc($user['id']); ?>" class="mx-2 font-semibold text-red-500 hover:text-red-600" onclick="return confirm('Are you sure you want to delete this account?')">🗑️ Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Summary Cards -->
            <section class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-10">
                <div class="bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl">
                    <h3 class="mb-2 text-[#8B7E74] text-xl header-title">👥 Total Users</h3>
                    <p class="font-bold text-gray-800 text-3xl">3</p>
                </div>

                <div class="bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl">
                    <h3 class="mb-2 text-[#8B7E74] text-xl header-title">🧑‍💼 Admin Accounts</h3>
                    <p class="font-bold text-gray-800 text-3xl">1</p>
                </div>

                <div class="bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl">
                    <h3 class="mb-2 text-[#8B7E74] text-xl header-title">🧾 Client Accounts</h3>
                    <p class="font-bold text-gray-800 text-3xl">2</p>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <?= view('components/footer') ?>
</body>

</html>