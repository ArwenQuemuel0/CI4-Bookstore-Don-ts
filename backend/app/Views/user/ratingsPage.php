<?php
$session = session();

if (!$session->has('user')) {
    return redirect()->to('/loginPage');
}

$user = $session->get('user');

$errors = $session->getFlashdata('errors') ?? [];
$success = $session->getFlashdata('success') ?? null;
$old = $session->getFlashdata('old') ?? [];

$existingRating = $old['existing_rating'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Us | Fennekin Folios</title>
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

        .star {
            cursor: pointer;
            transition: transform 0.1s ease;
        }

        .star:hover {
            transform: scale(1.1);
        }

        .star-filled {
            color: #E15A37;
        }

        .star-empty {
            color: rgba(255, 255, 255, 0.65);
        }
    </style>
</head>

<body class="flex flex-col min-h-screen">
    <div class="flex flex-col min-h-screen overlay">

        <?= view('components/header', ['brandTitle' => 'Rate Us']) ?>

        <main class="flex-grow px-4 py-16">
            <div class="mx-auto max-w-3xl bg-white/90 backdrop-blur-sm rounded-3xl p-10 shadow-xl">
                <h1 class="text-3xl font-bold text-[#E15A37] header-title mb-4">Rate Your Experience</h1>
                <p class="mb-8 text-gray-700">Every rating helps us improve. Your feedback is appreciated!</p>

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

                <form action="/ratings" method="post" class="space-y-6">
                    <?= csrf_field() ?>
                    <input type="hidden" name="rating" id="ratingValue" value="<?= esc($old['rating'] ?? $existingRating ?? 0) ?>">

                    <div class="flex items-center gap-2">
                        <?php for ($i = 1; $i <= 5; $i++):
                            $filled = ($old['rating'] ?? $existingRating ?? 0) >= $i;
                        ?>
                            <span class="star <?= $filled ? 'star-filled' : 'star-empty' ?>" data-value="<?= $i ?>" aria-label="<?= $i ?> star">
                                ★
                            </span>
                        <?php endfor; ?>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-[#514d4d] mb-2">Optional comment</label>
                        <textarea name="comment" rows="4"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:border-[#E15A37] focus:ring-[#fce77c]/60 focus:ring-4"><?= esc($old['comment'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="bg-[#E15A37] hover:bg-[#ED865A] py-4 rounded-full w-full font-semibold text-white text-lg">
                        Submit Rating
                    </button>
                </form>
            </div>
        </main>

        <?= view('components/footer') ?>
    </div>

    <script>
        const stars = document.querySelectorAll('.star');
        const ratingValue = document.getElementById('ratingValue');

        function setStars(value) {
            stars.forEach(star => {
                const starValue = Number(star.dataset.value);
                if (starValue <= value) {
                    star.classList.add('star-filled');
                    star.classList.remove('star-empty');
                } else {
                    star.classList.add('star-empty');
                    star.classList.remove('star-filled');
                }
            });
        }

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const value = Number(star.dataset.value);
                ratingValue.value = value;
                setStars(value);
            });
        });

        setStars(Number(ratingValue.value) || 0);
    </script>
</body>

</html>