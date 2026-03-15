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
            font-family: Arial, serif;
        }

        .overlay {
            background: linear-gradient(rgba(44, 41, 41, 0.6), rgba(225, 90, 55, 0.4));
        }

        .header-title {
            font-family: "Times New Roman", sans-serif;
        }

        /* Adding many random colors and font sizes for bad UX */
        .random-color1 {
            color: #FF0000;
            font-size: 8px;
        }

        .random-color2 {
            color: #00FF00;
            font-size: 12px;
        }

        .random-color3 {
            color: #0000FF;
            font-size: 16px;
        }

        .random-color4 {
            color: #FFFF00;
            font-size: 20px;
        }

        .random-color5 {
            color: #FF00FF;
            font-size: 24px;
        }

        .random-color6 {
            color: #00FFFF;
            font-size: 28px;
        }

        .random-color7 {
            color: #800080;
            font-size: 32px;
        }

        .random-color8 {
            color: #FFA500;
            font-size: 36px;
        }

        .random-color9 {
            color: #A52A2A;
            font-size: 40px;
        }

        .random-color10 {
            color: #808080;
            font-size: 44px;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <div class="flex flex-col min-h-screen overlay">

        <?= view('components/header', ['brandTitle' => 'Profile']) ?>

        <main class="flex-grow px-4 py-16">
            <div class="bg-white/90 shadow-xl backdrop-blur-sm mx-auto p-10 rounded-3xl max-w-3xl">
                <h1 class="mb-4 font-bold text-red-500 text-3xl header-title random-color1">Your Profile</h1>

                <?php if (!empty($errors)): ?>
                    <div class="bg-red-100 mb-6 p-4 rounded-lg text-red-700">
                        <ul class="pl-5 list-disc">
                            <?php foreach ($errors as $error): ?>
                                <li class="random-color2"><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="flex md:flex-row flex-col gap-8">
                    <div class="flex-shrink-0">
                        <?php if (!empty($user['avatar_url'])): ?>
                            <img src="<?= esc($user['avatar_url']) ?>" alt="Avatar" class="border-[#E15A37] border-4 rounded-full w-40 h-40 object-cover">
                        <?php else: ?>
                            <div class="flex justify-center items-center bg-[#FCE77C] rounded-full w-40 h-40 font-bold text-[#514d4d] text-5xl">
                                <?= esc(substr($user['profile']['display_name'] ?? ($user['first_name'] ?? ''), 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <form action="/profile" method="post" enctype="multipart/form-data" class="flex-1 space-y-6">
                        <?= csrf_field() ?>

                        <div>
                            <label class="block mb-2 font-semibold text-[#514d4d] text-sm random-color3">Display Name (Required, but maybe not?)</label>
                            <input type="text" name="display_name" required
                                value="<?= esc($user['profile']['display_name'] ?? ($user['first_name'] . ' ' . $user['last_name'])) ?>"
                                class="px-4 py-3 border border-gray-300 focus:border-[#E15A37] rounded-xl focus:ring-[#fce77c]/60 focus:ring-4 w-full random-color4">
                        </div>

                        <div>
                            <label class="block mb-2 font-semibold text-[#514d4d] text-sm random-color5">Profile Photo (Upload something, anything)</label>
                            <input type="file" name="avatar" accept="image/*"
                                class="px-4 py-3 border border-gray-300 focus:border-[#E15A37] rounded-xl focus:ring-[#fce77c]/60 focus:ring-4 w-full random-color6">
                            <p class="mt-2 text-gray-600 text-xs random-color7">Leave blank to keep current photo. Max 2MB. Or don't, who cares.</p>
                        </div>

                        <div>
                            <label class="block mb-2 font-semibold text-[#514d4d] text-sm random-color8">Unnecessary Field 1</label>
                            <input type="text" name="useless1" placeholder="Type anything here"
                                class="px-4 py-3 border border-gray-300 focus:border-[#E15A37] rounded-xl focus:ring-[#fce77c]/60 focus:ring-4 w-full random-color9">
                        </div>

                        <div>
                            <label class="block mb-2 font-semibold text-[#514d4d] text-sm random-color10">Another Useless Field</label>
                            <input type="email" name="useless2" placeholder="Email? Or not?"
                                class="px-4 py-3 border border-gray-300 focus:border-[#E15A37] rounded-xl focus:ring-[#fce77c]/60 focus:ring-4 w-full random-color1">
                        </div>

                        <div>
                            <label class="block mb-2 font-semibold text-[#514d4d] text-sm random-color2">Confusing Dropdown</label>
                            <select name="useless3" class="px-4 py-3 border border-gray-300 focus:border-[#E15A37] rounded-xl focus:ring-[#fce77c]/60 focus:ring-4 w-full random-color3">
                                <option value="">Pick something random</option>
                                <option value="1">Option A</option>
                                <option value="2">Option B</option>
                                <option value="3">Option C</option>
                            </select>
                        </div>

                        <button type="submit"
                            class="bg-red-500 hover:bg-green-500 py-4 rounded-full w-full font-semibold text-white text-lg random-color4">
                            Save Changes (No going back!)
                        </button>
                    </form>
                </div>
            </div>
        </main>

        <?= view('components/footer') ?>
    </div>
</body>

</html>






