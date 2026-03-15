<?php
$session = session();
$uri = service('uri');
$currentPath = $uri->getPath();
// IMPORTANT: $stocks comes from Admin::stockPage() controller
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

        .dashboard-header {
            background-color: #E15A37;
            color: #fff;
        }

        .sidebar {
            background-color: #E15A37;
            color: #fff;
        }

        .sidebar-link {
            transition: 0.2s ease;
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
            <h1 class="text-3xl tracking-wide header-title">Stock Management</h1>
            <div class="flex items-center space-x-4">
                <span class="font-semibold">
                    Welcome, <?= esc($session->get('user')['first_name'] ?? 'Admin') ?>
                </span>
            </div>
        </header>

        <!-- Stock Card -->
        <div class="bg-white shadow-xl mx-auto mt-6 p-8 border border-[#FCE77C] rounded-2xl max-w-7xl card-hover">

            <div class="flex justify-between items-center mb-6">
                <h2 class="font-bold text-[#E15A37] text-4xl header-title">📦 Stock List</h2>

                <button onclick="openAddBook()"
                    class="hover:bg-[#ED865A] px-6 py-3 rounded-full font-semibold text-lg transition accent-yellow">
                    ➕ Add New Book
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="border border-[#FCE77C] rounded-xl w-full">
                    <thead class="bg-[#E15A37] text-white">
                        <tr>
                            <th class="px-6 py-3 text-left uppercase">ID</th>
                            <th class="px-6 py-3 text-left uppercase">Image</th>
                            <th class="px-6 py-3 text-left uppercase">Title</th>
                            <th class="px-6 py-3 text-left uppercase">Description</th>
                            <th class="px-6 py-3 text-center uppercase">Quantity</th>
                            <th class="px-6 py-3 text-center uppercase">Price</th>
                            <th class="px-6 py-3 text-center uppercase">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-[#FCE77C]">

                        <?php if (!empty($stocks)): ?>
                            <?php foreach ($stocks as $book): ?>
                                <tr class="hover:bg-[#FFF8E7] transition">

                                    <td class="px-6 py-4 text-gray-800">BK-<?= esc($book->id) ?></td>

                                    <td class="px-6 py-4">
                                        <?php if (!empty($book->image)): ?>
                                            <img src="<?= esc($book->image) ?>" class="w-14 h-20 object-cover rounded shadow">
                                        <?php else: ?>
                                            <span class="text-gray-500 italic">No image</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="px-6 py-4 font-semibold text-gray-900"><?= esc($book->name) ?></td>

                                    <td class="px-6 py-4 text-gray-700">
                                        <?= esc(substr($book->description, 0, 60)) ?>...
                                    </td>

                                    <td class="px-6 py-4 font-bold text-gray-800 text-center"><?= esc($book->quantity) ?></td>

                                    <td class="px-6 py-4 font-semibold text-[#E15A37] text-center">
                                        ₱<?= number_format($book->price, 2) ?>
                                    </td>

                                    <td class="px-6 py-4 text-center whitespace-nowrap">

                                        <!-- EDIT -->
                                        <a href="#"
                                            onclick="openEditBook(
                                                '<?= $book->id ?>',
                                                `<?= addslashes($book->name) ?>`,
                                                `<?= addslashes($book->image) ?>`,
                                                `<?= addslashes($book->description) ?>`,
                                                '<?= $book->price ?>',
                                                '<?= $book->quantity ?>'
                                            )"
                                            class="mx-2 font-semibold text-[#E15A37] hover:text-[#ED865A]">
                                            ✏️ Edit
                                        </a>

                                        <!-- DELETE -->
                                        <a href="#"
                                            onclick="openDeleteBook('<?= $book->id ?>', `<?= addslashes($book->name) ?>`)"
                                            class="mx-2 font-semibold text-red-500 hover:text-red-600">
                                            🗑️ Delete
                                        </a>

                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-6 text-gray-600">
                                    No stock items found.
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

    <!-- ADD BOOK MODAL -->
    <dialog id="addBookModal" class="p-0 rounded-2xl w-[95%] max-w-lg backdrop:bg-black/60">
        <form method="post" action="/admin/stocks/create"
            class="bg-white p-6 rounded-2xl border border-[#FCE77C] shadow-xl space-y-4">

            <?= csrf_field() ?>

            <h3 class="text-3xl font-bold text-[#E15A37] header-title mb-4">Add New Book</h3>

            <div class="grid grid-cols-1 gap-3">
                <input type="text" name="name" placeholder="Book Title" class="border border-[#FCE77C] px-3 py-2 rounded-lg" required>
                <input type="text" name="image" placeholder="Image URL" class="border border-[#FCE77C] px-3 py-2 rounded-lg">
                <textarea name="description" placeholder="Book Description" rows="4" class="border border-[#FCE77C] px-3 py-2 rounded-lg" required></textarea>
                <input type="number" step="0.01" name="price" placeholder="Price" class="border border-[#FCE77C] px-3 py-2 rounded-lg" required>
                <input type="number" name="quantity" placeholder="Stock Quantity" class="border border-[#FCE77C] px-3 py-2 rounded-lg" required>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeAddBook()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-[#E15A37] text-white rounded-lg hover:bg-[#ED865A]">Add Book</button>
            </div>
        </form>
    </dialog>

    <!-- EDIT BOOK MODAL -->
    <dialog id="editBookModal" class="p-0 rounded-2xl w-[95%] max-w-lg backdrop:bg-black/60">
        <form method="post" id="editBookForm"
            class="bg-white p-6 rounded-2xl border border-[#FCE77C] shadow-xl space-y-4">

            <?= csrf_field() ?>

            <h3 class="text-3xl font-bold text-[#E15A37] header-title mb-4">✏️ Edit Book</h3>

            <input type="hidden" name="id" id="edit_id">

            <div class="grid grid-cols-1 gap-3">
                <input type="text" id="edit_name" name="name" class="border border-[#FCE77C] px-3 py-2 rounded-lg" required>
                <input type="text" id="edit_image" name="image" class="border border-[#FCE77C] px-3 py-2 rounded-lg">
                <textarea id="edit_description" name="description" rows="4" class="border border-[#FCE77C] px-3 py-2 rounded-lg" required></textarea>
                <input type="number" step="0.01" id="edit_price" name="price" class="border border-[#FCE77C] px-3 py-2 rounded-lg" required>
                <input type="number" id="edit_quantity" name="quantity" class="border border-[#FCE77C] px-3 py-2 rounded-lg" required>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeEditBook()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-[#E15A37] text-white rounded-lg hover:bg-[#ED865A]">Save Changes</button>
            </div>
        </form>
    </dialog>

    <!-- DELETE BOOK MODAL -->
    <dialog id="deleteBookModal" class="p-0 rounded-2xl w-[90%] max-w-md backdrop:bg-black/60">

        <form method="post" id="deleteBookForm"
            class="bg-white p-6 rounded-2xl border border-[#FCE77C] shadow-xl">

            <?= csrf_field() ?>

            <h3 class="text-2xl font-bold text-[#E15A37] header-title mb-4">⚠️ Delete Book</h3>

            <p class="text-gray-700 mb-6">
                Are you sure you want to delete
                <strong id="delete_book_name"></strong>?
                This action cannot be undone.
            </p>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeDeleteBook()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg">
                    Cancel
                </button>

                <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Delete
                </button>
            </div>

        </form>

    </dialog>


    <!-- JS for Modals -->
    <script>
        function openAddBook() {
            document.getElementById('addBookModal').showModal();
        }

        function closeAddBook() {
            document.getElementById('addBookModal').close();
        }

        function openEditBook(id, name, image, description, price, quantity) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_image').value = image;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_price').value = price;
            document.getElementById('edit_quantity').value = quantity;

            document.getElementById('editBookForm').action = `/admin/stocks/update/${id}`;

            document.getElementById('editBookModal').showModal();
        }

        function closeEditBook() {
            document.getElementById('editBookModal').close();
        }

        function openDeleteBook(id, name) {
            document.getElementById('delete_book_name').textContent = name;

            // Set form action with ID
            document.getElementById('deleteBookForm').action = `/admin/stocks/delete/${id}`;

            document.getElementById('deleteBookModal').showModal();
        }

        function closeDeleteBook() {
            document.getElementById('deleteBookModal').close();
        }
    </script>

</body>

</html>