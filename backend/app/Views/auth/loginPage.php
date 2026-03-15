<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Fennekin Folios – Login</title>
    <link rel="shortcut icon" type="image/png" href="/assets/bookstore_icon.ico" />
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&family=Roboto+Slab:wght@100..900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto Slab', serif;
        }

        .header-title,
        h1,
        h2,
        h3,
        h4,
        .heading {
            font-family: "Righteous", sans-serif;
            font-weight: 400;
        }

        input:focus {
            transition: all 0.3s ease;
            transform: scale(1.02);
        }

        button {
            transition: all 0.3s ease;
        }

        /* ORANGE SHADOW */
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(225, 90, 55, 0.35);
        }

        /* NEW BACKGROUND IMAGE */
        .bookstore-gradient {
            position: relative;
            background: url('/assets/background.png') no-repeat center center;
            background-size: cover;
        }

        /* FENNEKIN ORANGE OVERLAY */
        .bookstore-gradient::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(44, 41, 41, 0.85), rgba(225, 90, 55, 0.55));
            z-index: 0;
        }

        .bookstore-gradient>div {
            position: relative;
            z-index: 1;
        }

        /* INPUT FOCUS RING (CREAM YELLOW) */
        .focus-ring:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(252, 231, 124, 0.6);
        }

        /* PRIMARY ORANGE BUTTON */
        .btn-primary {
            background-color: #e15a37;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #ed865a;
        }

        /* LINKS — ORANGE WITH LIGHT HOVER */
        .link {
            color: #e15a37;
        }

        .link:hover {
            color: #ed865a;
        }
    </style>
</head>

<body class="flex flex-col min-h-screen text-gray-100">

    <main class="flex md:flex-row flex-col flex-grow">

        <!-- Left Section -->
        <div class="flex flex-col justify-center items-center p-12 md:w-2/3 text-white bookstore-gradient">
            <div class="space-y-6 max-w-md text-center">
                <h2 class="font-bold text-4xl md:text-5xl header-title">Welcome to Fennekin Folios</h2>
                <p class="text-white/90 text-lg leading-relaxed">
                    From rare collections to modern favorites, your next great story awaits.
                    Join our community of passionate readers and explore the world through books.
                </p>
            </div>
        </div>

        <!-- Right Section (Login Form) -->
        <div class="flex justify-center items-center bg-white px-6 py-16 md:w-1/3">
            <div class="bg-white shadow-2xl p-10 rounded-2xl w-full max-w-md">

                <!-- Header -->
                <div class="mb-8 text-center">
                    <img src="/assets/fennekin.png" alt="Fennekin Logo" class="mx-auto mb-4 w-16 h-16">
                    <h2 class="font-bold text-[#514d4d] text-3xl header-title">Welcome Back</h2>
                    <p class="mt-2 text-[#514d4d]/80">Log in to continue your reading journey</p>
                </div>

                <!-- Login Form -->
                <form action="/loginPage" method="post" class="space-y-5">
                    <?= csrf_field() ?>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block mb-2 font-semibold text-[#514d4d]">Email Address</label>
                        <input type="email" name="email" id="email" required
                            value="<?= esc($old['email'] ?? '') ?>"
                            placeholder="Enter your email"
                            class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none focus-ring text-gray-900 focus:ring-[#fce77c]/60 focus:ring-4 <?= isset($errors['email']) ? 'border-red-500' : 'border-gray-300' ?>">
                        <?php if (!empty($errors['email'])): ?>
                            <p class="mt-1 text-red-600 text-sm"><?= esc($errors['email']) ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <label for="password" class="block mb-2 font-semibold text-[#514d4d]">Password</label>

                        <div class="relative">
                            <input type="password" name="password" id="password" required
                                placeholder="Enter your password"
                                class="w-full pr-10 px-4 py-3 border-2 rounded-xl text-gray-900 text-base focus:outline-none focus:ring-[#fce77c]/60 focus:ring-4 <?= isset($errors['password']) ? 'border-red-500' : 'border-gray-300' ?>">

                            <!-- Eye toggle -->
                            <button type="button" id="togglePasswordBtn"
                                class="right-3 absolute inset-y-0 flex items-center text-gray-500">
                                <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M2.5 12s4-7 9.5-7 9.5 7 9.5 7-4 7-9.5 7S2.5 12 2.5 12z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg" class="hidden w-5 h-5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                        d="M3 3l18 18"></path>
                                </svg>
                            </button>
                        </div>

                        <?php if (!empty($errors['password'])): ?>
                            <p class="mt-1 text-red-600 text-sm"><?= esc($errors['password']) ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="py-3 rounded-full focus:outline-none w-full font-semibold text-lg btn-primary">
                        Log In
                    </button>

                    <!-- Sign Up -->
                    <p class="mt-4 text-[#514d4d] text-sm text-center">
                        Don’t have an account?
                        <a href="/signupPage" class="font-semibold link">Create one now</a>
                    </p>

                    <!-- Back to Home -->
                    <?= view('components/buttons/back_button', [
                        'href' => '/',
                        'label' => 'Back to Home'
                    ]) ?>

                </form>

            </div>
        </div>

    </main>

    <script>
        const toggleBtn = document.getElementById("togglePasswordBtn");
        const passwordInput = document.getElementById("password");
        const iconEye = document.getElementById("icon-eye");
        const iconEyeOff = document.getElementById("icon-eye-off");

        toggleBtn.addEventListener("click", () => {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
            iconEye.classList.toggle("hidden");
            iconEyeOff.classList.toggle("hidden");
        });
    </script>

</body>

</html>