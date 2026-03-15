<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Achlys' Bookstore – Roadmap</title>
    <link rel="shortcut icon" type="image/png" href="/assets/bookstore_icon.ico" />
    <script src="https://cdn.tailwindcss.com"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto Slab', serif;
        }

        .heading {
            font-family: 'Righteous', sans-serif;
        }
    </style>
</head>

<body class="bg-fixed bg-cover bg-center text-[#3c2f2f] flex flex-col min-h-screen"
    style="background-image: url('https://cdn.pixabay.com/photo/2017/10/15/08/56/neutral-2852878_1280.jpg');">

    <!-- HEADER -->
    <?= view('components/header.php') ?>

    <!-- Page wrapper -->
    <div class="flex-grow bg-gradient-to-b from-[rgba(100,92,92,0.6)] to-[rgba(139,126,116,0.4)] px-4 py-10">
        <div class="mx-auto max-w-5xl">

            <!-- Page Header -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-10 text-white">
                <div>
                    <h1 class="text-4xl tracking-wide heading drop-shadow-sm">Achlys Bookstore Roadmap</h1>
                    <p class="mt-2 text-[#F5F0EC] text-sm">
                        A visual overview of our bookstore’s ongoing and upcoming milestones.
                    </p>
                </div>
            </div>

            <!-- Cards -->
            <div class="space-y-5">
                <?= view('components/cards/roadmap_cards', [
                    "title" => "User Management",
                    "description" => "Manage user accounts for customers and staff, including roles, profile updates, and account management tools.",
                    "status" => "In Progress",
                    "priority" => "High",
                    "statusClass" => "bg-[#ffb74d]"
                ]) ?>

                <?= view('components/cards/roadmap_cards', [
                    "title" => "Community Features",
                    "description" => "Introduce book clubs, discussion boards, and author Q&A sessions to engage readers more deeply.",
                    "status" => "In Progress",
                    "priority" => "High",
                    "statusClass" => "bg-[#ffb74d]"
                ]) ?>

                <?= view('components/cards/roadmap_cards', [
                    "title" => "E-Book Service Management",
                    "description" => "Manage e-books in the catalog, adjust pricing, and handle digital access for online readers.",
                    "status" => "Planned",
                    "priority" => "Medium",
                    "statusClass" => "bg-[#64b5f6]"
                ]) ?>

                <?= view('components/cards/roadmap_cards', [
                    "title" => "Recommendation Engine",
                    "description" => "Suggest personalized titles based on reader preferences and browsing history.",
                    "status" => "Planned",
                    "priority" => "Medium",
                    "statusClass" => "bg-[#64b5f6]"
                ]) ?>

                <?= view('components/cards/roadmap_cards', [
                    "title" => "Book Request System",
                    "description" => "Let users request unavailable books and get notified when they’re restocked or released.",
                    "status" => "Backlog",
                    "priority" => "Low",
                    "statusClass" => "bg-[#73397e]"
                ]) ?>

            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <?= view('components/footer.php') ?>

</body>

</html>