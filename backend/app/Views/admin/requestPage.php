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

    <!-- ✅ Page Header -->
    <header class="flex justify-between items-center shadow-md px-6 py-4 text-gray-100 custom-neutral">
        <h1 class="text-3xl tracking-wide header-title">Book Requests</h1>
        <div class="flex items-center space-x-4">
            <span class="font-semibold">Welcome, Admin</span>
            <img src="/assets/profile_placeholder.png" alt="Admin Avatar" class="border border-[#A99D92] rounded-full w-10 h-10">
        </div>
    </header>

    <main class="flex-grow p-10">
        <div class="bg-white shadow-xl mx-auto p-8 border border-[#E5E0DC] rounded-2xl max-w-7xl">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-bold text-[#8B7E74] text-4xl header-title">📚 Manage Requests</h2>
                <a href="/admin/requests/add" class="px-6 py-3 rounded-full font-semibold text-lg btn-main">➕ New Request</a>
            </div>

            <!-- Filters -->
            <div class="flex md:flex-row flex-col justify-between gap-4 mb-6">
                <input type="text" placeholder="Search by requester or title..." class="px-4 py-2 border border-[#E5E0DC] rounded-lg focus:outline-none focus:ring-[#8B7E74]/50 focus:ring-2 w-full md:w-1/3" />

                <select class="px-4 py-2 border border-[#E5E0DC] rounded-lg focus:outline-none focus:ring-[#8B7E74]/50 focus:ring-2 w-full md:w-1/5">
                    <option>All Statuses</option>
                    <option>Pending</option>
                    <option>Approved</option>
                    <option>Denied</option>
                </select>
            </div>

            <!-- Requests Table -->
            <div class="overflow-x-auto">
                <table class="bg-white border border-[#E5E0DC] rounded-xl min-w-full overflow-hidden">
                    <thead class="bg-[#8B7E74] text-white">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Request ID</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Book Title</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Requester</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Date Requested</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Status</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E5E0DC]">
                        <?php
                        $requests = [
                            ['id' => 'REQ-002', 'book' => 'Atomic Habits', 'requester' => 'Adrian Guillermo', 'date' => '2025-10-28', 'status' => 'Approved'],
                        ];
                        ?>

                        <?php foreach ($requests as $req): ?>
                            <tr class="hover:bg-[#F9F7F4] transition">
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
                                        <a href="/admin/requests/view/<?php echo esc($req['id']); ?>" class="mx-2 font-semibold text-[#8B7E74] hover:text-[#A99D92]">👁️ View</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Summary Cards -->
            <section class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-10">
                <div class="bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl">
                    <h3 class="mb-2 text-[#8B7E74] text-xl header-title">🕒 Pending Requests</h3>
                    <p class="font-bold text-gray-800 text-3xl">1</p>
                </div>

                <div class="bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl">
                    <h3 class="mb-2 text-[#8B7E74] text-xl header-title">✅ Approved Requests</h3>
                    <p class="font-bold text-gray-800 text-3xl">1</p>
                </div>

                <div class="bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl">
                    <h3 class="mb-2 text-[#8B7E74] text-xl header-title">❌ Denied Requests</h3>
                    <p class="font-bold text-gray-800 text-3xl">1</p>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <?= view('components/footer') ?>
</body>

</html>