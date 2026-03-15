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

        .dashboard-header {
            background-color: #E15A37;
            color: #fff;
        }

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

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(225, 90, 55, 0.3);
        }

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
            </div>

            <div class="overflow-x-auto">
                <table class="bg-white border border-[#FCE77C] rounded-xl min-w-full overflow-hidden">
                    <thead class="bg-[#E15A37] text-white">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">ID</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Requested Book</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Message</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Requester</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Date</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#FCE77C]">

                        <?php if (!empty($requests)): ?>
                            <?php foreach ($requests as $req): ?>
                                <tr class="hover:bg-[#FFF8E7] transition">

                                    <!-- ID -->
                                    <td class="px-6 py-4 text-gray-800 whitespace-nowrap">
                                        REQ-<?= esc($req->id) ?>
                                    </td>

                                    <!-- Requested Book -->
                                    <td class="px-6 py-4 font-semibold text-gray-900 whitespace-nowrap max-w-[250px] truncate">
                                        <?= esc($req->requested_data) ?>
                                    </td>

                                    <!-- Message -->
                                    <td class="px-6 py-4 text-gray-700 italic whitespace-nowrap max-w-[250px] truncate">
                                        <?= esc($req->message ?: '—') ?>
                                    </td>

                                    <!-- Requester -->
                                    <td class="px-6 py-4 text-gray-700 whitespace-nowrap">
                                        <?= esc($req->requester_name) ?>
                                    </td>

                                    <!-- DATE Column -->
                                    <td class="px-6 py-4 text-gray-700 whitespace-nowrap text-center">
                                        <?= esc(date('Y-m-d', strtotime($req->created_at))) ?>
                                    </td>

                                    <!-- STATUS DROPDOWN -->
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        <form action="/admin/requests/updateStatus/<?= esc($req->id) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <select name="status"
                                                onchange="this.form.submit()"
                                                class="px-3 py-2 border border-[#FCE77C] rounded-lg bg-white text-gray-700">
                                                <option value="pending" <?= $req->status === 'pending'   ? 'selected' : '' ?>>Pending</option>
                                                <option value="completed" <?= $req->status === 'completed' ? 'selected' : '' ?>>Completed</option>
                                                <option value="rejected" <?= $req->status === 'rejected'  ? 'selected' : '' ?>>Rejected</option>
                                            </select>
                                        </form>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-600">
                                    No requests found.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>

                </table>
            </div>


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