<?php
$session = session();

if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}

$user = $session->get('user');

$errors = $session->getFlashdata('errors') ?? [];
$success = $session->getFlashdata('success') ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Fennekin Folios</title>
    <link rel="shortcut icon" type="image/png" href="/assets/bookstore_icon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap" rel="stylesheet">

    <style>
        body {
            background: url('/assets/background.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Roboto Slab', serif;
        }

        .overlay {
            background: linear-gradient(rgba(44, 41, 41, 0.6), rgba(225, 90, 55, 0.4));
        }

        .header-title {
            font-family: "Righteous", sans-serif;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <div class="flex flex-col min-h-screen overlay">

        <?= view('components/header', ['brandTitle' => 'Profile']) ?>

        <main class="flex-grow px-4 py-16">
            <div class="mx-auto max-w-3xl bg-white/90 backdrop-blur-sm rounded-3xl p-10 shadow-xl">
                <h1 class="text-3xl font-bold text-[#E15A37] header-title mb-4">Your Profile</h1>

                <?php if ($success): ?>
                    <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-700">
                        <?= esc($success) ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($errors)): ?>
                    <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-700">
                        <ul class="list-disc pl-5">
                            <?php foreach ($errors as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="flex flex-col md:flex-row gap-8">
                    <div class="flex-shrink-0">
                        <?php if (!empty($user['avatar_url'])): ?>
                            <img src="<?= esc($user['avatar_url']) ?>" alt="Avatar" class="w-40 h-40 rounded-full object-cover border-4 border-[#E15A37]">
                        <?php else: ?>
                            <div class="w-40 h-40 rounded-full bg-[#FCE77C] flex items-center justify-center text-5xl font-bold text-[#514d4d]">
                                <?= esc(substr($user['profile']['display_name'] ?? ($user['first_name'] ?? ''), 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <form action="/profile" method="post" enctype="multipart/form-data" class="flex-1 space-y-6">
                        <?= csrf_field() ?>

                        <div>
                            <label class="block text-sm font-semibold text-[#514d4d] mb-2">Display Name</label>
                            <input type="text" name="display_name" required
                                value="<?= esc($user['profile']['display_name'] ?? ($user['first_name'] . ' ' . $user['last_name'])) ?>"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-[#E15A37] focus:ring-[#fce77c]/60 focus:ring-4">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#514d4d] mb-2">Profile Photo</label>
                            <input type="file" name="avatar" accept="image/*"
                                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-[#E15A37] focus:ring-[#fce77c]/60 focus:ring-4">
                            <p class="mt-2 text-xs text-gray-600">Leave blank to keep current photo. Max 2MB.</p>
                        </div>

                        <button type="submit"
                            class="bg-[#E15A37] hover:bg-[#ED865A] py-4 rounded-full w-full font-semibold text-white text-lg">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </main>

        <?= view('components/footer') ?>
    </div>
</body>

</html>
