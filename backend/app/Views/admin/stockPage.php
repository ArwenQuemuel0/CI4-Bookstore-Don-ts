<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Stock Management | Achlys' Bookstore Admin</title>
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

    <!-- ✅ Stock Page Header -->
    <header class="flex justify-between items-center shadow-md px-6 py-4 text-gray-100 custom-neutral">
        <h1 class="text-3xl tracking-wide header-title">Stock Management</h1>
        <div class="flex items-center space-x-4">
            <span class="font-semibold">Welcome, Admin</span>
            <img src="/assets/profile_placeholder.png" alt="Admin Avatar" class="border border-[#A99D92] rounded-full w-10 h-10">
        </div>
    </header>

    <main class="flex-grow p-10">
        <div class="bg-white shadow-xl mx-auto p-8 border border-[#E5E0DC] rounded-2xl max-w-7xl">
            <div class="flex justify-between items-center mb-8">
                <h2 class="font-bold text-[#8B7E74] text-4xl header-title">📦 Stock List</h2>
                <a href="/admin/stocks/add" class="px-6 py-3 rounded-full font-semibold text-lg btn-main">➕ Add New Book</a>
            </div>

            <!-- Search and Filters -->
            <div class="flex md:flex-row flex-col justify-between gap-4 mb-6">
                <input type="text" placeholder="Search book title..." class="px-4 py-2 border border-[#E5E0DC] rounded-lg focus:outline-none focus:ring-[#8B7E74]/50 focus:ring-2 w-full md:w-1/3" />

                <select class="px-4 py-2 border border-[#E5E0DC] rounded-lg focus:outline-none focus:ring-[#8B7E74]/50 focus:ring-2 w-full md:w-1/5">
                    <option>All Categories</option>
                    <option>Fiction</option>
                    <option>Non-fiction</option>
                    <option>Science</option>
                    <option>Business</option>
                </select>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="bg-white border border-[#E5E0DC] rounded-xl min-w-full overflow-hidden">
                    <thead class="bg-[#8B7E74] text-white">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Book ID</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Title</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Author</th>
                            <th class="px-6 py-3 font-semibold text-sm text-left uppercase">Category</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Stock</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Price</th>
                            <th class="px-6 py-3 font-semibold text-sm text-center uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#E5E0DC]">
                        <?php
                        $stocks = [
                            ['id' => 'BK-001', 'title' => 'The Lord of the Rings', 'author' => 'J.R.R. Tolkien', 'category' => 'Fantasy', 'stock' => 34, 'price' => 199],
                            ['id' => 'BK-002', 'title' => 'Atomic Habits', 'author' => 'James Clear', 'category' => 'Self-help', 'stock' => 50, 'price' => 299],
                            ['id' => 'BK-003', 'title' => 'Sapiens: A Brief History of Humankind', 'author' => 'Yuval Noah Harari', 'category' => 'History', 'stock' => 20, 'price' => 259],
                        ];
                        ?>

                        <?php foreach ($stocks as $book): ?>
                            <tr class="hover:bg-[#F9F7F4] transition">
                                <td class="px-6 py-4 text-gray-800"><?php echo esc($book['id']); ?></td>
                                <td class="px-6 py-4 font-semibold text-gray-900"><?php echo esc($book['title']); ?></td>
                                <td class="px-6 py-4 text-gray-700"><?php echo esc($book['author']); ?></td>
                                <td class="px-6 py-4 text-gray-700"><?php echo esc($book['category']); ?></td>
                                <td class="px-6 py-4 font-bold text-gray-800 text-center"><?php echo esc($book['stock']); ?></td>
                                <td class="px-6 py-4 font-semibold text-[#8B7E74] text-center">₱<?php echo number_format($book['price'], 2); ?></td>
                                <td class="px-6 py-4 text-center">
                                    <a href="/admin/stocks/edit/<?php echo esc($book['id']); ?>" class="mx-2 font-semibold text-[#8B7E74] hover:text-[#A99D92]">✏️ Edit</a>
                                    <a href="/admin/stocks/delete/<?php echo esc($book['id']); ?>" class="mx-2 font-semibold text-red-500 hover:text-red-600" onclick="return confirm('Are you sure you want to delete this book?')">🗑️ Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Summary Cards -->
            <section class="gap-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-10">
                <div class="bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl">
                    <h3 class="mb-2 text-[#8B7E74] text-xl header-title">📘 Total Books</h3>
                    <p class="font-bold text-gray-800 text-3xl">3</p>
                </div>

                <div class="bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl">
                    <h3 class="mb-2 text-[#8B7E74] text-xl header-title">📦 Total Stock</h3>
                    <p class="font-bold text-gray-800 text-3xl">104</p>
                </div>

                <div class="bg-white shadow-md p-6 border border-[#E5E0DC] rounded-xl">
                    <h3 class="mb-2 text-[#8B7E74] text-xl header-title">💰 Monthly Sales</h3>
                    <p class="font-bold text-gray-800 text-3xl">₱58,200</p>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <?= view('components/footer') ?>
</body>

</html>