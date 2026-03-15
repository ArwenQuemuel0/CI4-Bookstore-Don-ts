<?php
$session = session();
$uri = service('uri');
$currentPath = $uri->getPath();

// Sample stock data
$stocks = [
    ['id' => 'BK-001', 'title' => 'The Lord of the Rings', 'author' => 'J.R.R. Tolkien', 'category' => 'Fantasy', 'stock' => 34, 'price' => 199],
    ['id' => 'BK-002', 'title' => 'Atomic Habits', 'author' => 'James Clear', 'category' => 'Self-help', 'stock' => 50, 'price' => 299],
    ['id' => 'BK-003', 'title' => 'Sapiens: A Brief History of Humankind', 'author' => 'Yuval Noah Harari', 'category' => 'History', 'stock' => 20, 'price' => 259],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management | Fennekin Folios Admin</title>
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
            <h1 class="text-3xl tracking-wide header-title">Stock Management</h1>
            <div class="flex items-center space-x-4">
                <span class="font-semibold">Welcome, <?= esc($session->get('user')['first_name'] ?? 'Admin') ?></span>
            </div>
        </header>

        <!-- Stock Card -->
        <div class="bg-white shadow-xl mx-auto mt-6 p-8 border border-[#FCE77C] rounded-2xl max-w-7xl card-hover">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-bold text-[#E15A37] text-4xl header-title">📦 Stock List</h2>
                <a href="/admin/stocks/add" class="hover:bg-[#ED865A] px-6 py-3 rounded-full font-semibold text-lg transition accent-yellow">➕ Add New Book</a>
            </div>

            <div class="overflow-x-auto">
                <table class="border border-[#FCE77C] rounded-xl w-full">
                    <thead class="bg-[#E15A37] text-white">
                        <tr>
                            <th class="px-6 py-3 text-left uppercase">Book ID</th>
                            <th class="px-6 py-3 text-left uppercase">Title</th>
                            <th class="px-6 py-3 text-left uppercase">Author</th>
                            <th class="px-6 py-3 text-left uppercase">Category</th>
                            <th class="px-6 py-3 text-center uppercase">Stock</th>
                            <th class="px-6 py-3 text-center uppercase">Price</th>
                            <th class="px-6 py-3 text-center uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#FCE77C]">
                        <?php foreach ($stocks as $book): ?>
                            <tr class="hover:bg-[#FFF8E7] transition">
                                <td class="px-6 py-4 text-gray-800"><?= esc($book['id']) ?></td>
                                <td class="px-6 py-4 font-semibold text-gray-900"><?= esc($book['title']) ?></td>
                                <td class="px-6 py-4 text-gray-700"><?= esc($book['author']) ?></td>
                                <td class="px-6 py-4 text-gray-700"><?= esc($book['category']) ?></td>
                                <td class="px-6 py-4 font-bold text-gray-800 text-center"><?= esc($book['stock']) ?></td>
                                <td class="px-6 py-4 font-semibold text-[#E15A37] text-center">₱<?= number_format($book['price'], 2) ?></td>
                                <td class="px-6 py-4 text-center">
                                    <a href="/admin/stocks/edit/<?= esc($book['id']) ?>" class="mx-2 font-semibold text-[#E15A37] hover:text-[#ED865A]">✏️ Edit</a>
                                    <a href="/admin/stocks/delete/<?= esc($book['id']) ?>" class="mx-2 font-semibold text-red-500 hover:text-red-600" onclick="return confirm('Are you sure?')">🗑️ Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
            <a href="/admin/stockPage" class="block bg-[#ED865A]/30 hover:bg-[#ED865A] px-4 py-3 rounded-lg hover:text-white sidebar-link">📚 Stocks Page</a>
            <a href="/admin/accountsPage" class="block hover:bg-[#ED865A] px-4 py-3 rounded-lg hover:text-white sidebar-link">👤 Accounts Page</a>
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