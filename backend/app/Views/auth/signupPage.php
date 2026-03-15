<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Achlys' Bookstore – Sign Up</title>
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

        .header-title {
            font-family: "Righteous", sans-serif;
        }

        input:focus {
            transition: all 0.3s ease;
            transform: scale(1.02);
        }

        button {
            transition: all 0.3s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(139, 126, 116, 0.3);
        }

        .bookstore-gradient {
            position: relative;
            background: url('https://static.vecteezy.com/system/resources/previews/022/336/538/non_2x/coffee-and-book-minimalist-background-illustration-ai-generative-free-photo.jpg') no-repeat center center;
            background-size: cover;
        }

        .bookstore-gradient::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(44, 41, 41, 0.85), rgba(139, 126, 116, 0.6));
            z-index: 0;
        }

        .bookstore-gradient>div {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body class="text-gray-100">
    <div class="flex flex-col min-h-screen overlay">

        <main class="flex md:flex-row flex-col flex-grow">

            <!-- LEFT SECTION -->
            <div class="flex flex-col justify-center items-center p-12 md:w-2/3 text-white bookstore-gradient">
                <div class="space-y-6 max-w-md text-center">
                    <h2 class="font-bold text-4xl md:text-5xl header-title">Join the Achlys Community</h2>
                    <p class="text-white/90 text-lg">
                        Unlock a world of stories, connect with fellow readers, and keep track of your literary adventures.
                    </p>
                </div>
            </div>

            <!-- RIGHT SECTION (FORM) -->
            <div class="flex justify-center items-center bg-white px-6 py-16 md:w-1/3">

                <div class="bg-white bg-opacity-90 shadow-2xl p-10 rounded-2xl w-full max-w-md">

                    <!-- Header -->
                    <div class="mb-8 text-center">
                        <img src="/assets/circle_logo.png" alt="Achlys Circle Logo" class="mx-auto mb-4 w-16 h-16">
                        <h2 class="font-bold text-gray-900 text-3xl header-title">Create Account</h2>
                        <p class="mt-2 text-gray-600">Discover stories that speak to you</p>
                    </div>

                    <!-- SIGNUP FORM -->
                    <form class="space-y-5" action="/signupPage" method="post" novalidate>
                        <?= csrf_field() ?>

                        <!-- FIRST NAME -->
                        <div>
                            <label class="block mb-2 font-semibold text-gray-700">First Name</label>
                            <input type="text" name="first_name" required
                                value="<?= esc($old['first_name'] ?? '') ?>"
                                placeholder="Enter your first name"
                                class="px-4 py-4 border-2 <?= isset($errors['first_name']) ? 'border-red-500' : 'border-gray-200' ?> rounded-xl w-full text-gray-900 focus:outline-none focus:ring-[#8B7E74]/20"
                                aria-invalid="<?= isset($errors['first_name']) ? 'true' : 'false' ?>">
                            <?php if (!empty($errors['first_name'])): ?>
                                <p class="mt-2 text-red-600 text-sm"><?= esc($errors['first_name']) ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- MIDDLE NAME -->
                        <div>
                            <label class="block mb-2 font-semibold text-gray-700">Middle Name (Optional)</label>
                            <input type="text" name="middle_name"
                                value="<?= esc($old['middle_name'] ?? '') ?>"
                                placeholder="Enter your middle name"
                                class="px-4 py-4 border-2 <?= isset($errors['middle_name']) ? 'border-red-500' : 'border-gray-200' ?> rounded-xl w-full text-gray-900 focus:outline-none focus:ring-[#8B7E74]/20"
                                aria-invalid="<?= isset($errors['middle_name']) ? 'true' : 'false' ?>">
                            <?php if (!empty($errors['middle_name'])): ?>
                                <p class="mt-2 text-red-600 text-sm"><?= esc($errors['middle_name']) ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- LAST NAME -->
                        <div>
                            <label class="block mb-2 font-semibold text-gray-700">Last Name</label>
                            <input type="text" name="last_name" required
                                value="<?= esc($old['last_name'] ?? '') ?>"
                                placeholder="Enter your last name"
                                class="px-4 py-4 border-2 <?= isset($errors['last_name']) ? 'border-red-500' : 'border-gray-200' ?> rounded-xl w-full text-gray-900 focus:outline-none focus:ring-[#8B7E74]/20"
                                aria-invalid="<?= isset($errors['last_name']) ? 'true' : 'false' ?>">
                            <?php if (!empty($errors['last_name'])): ?>
                                <p class="mt-2 text-red-600 text-sm"><?= esc($errors['last_name']) ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- EMAIL -->
                        <div>
                            <label class="block mb-2 font-semibold text-gray-700">Email Address</label>
                            <input type="email" name="email" required
                                value="<?= esc($old['email'] ?? '') ?>"
                                placeholder="Enter your email"
                                class="px-4 py-4 border-2 <?= isset($errors['email']) ? 'border-red-500' : 'border-gray-200' ?> rounded-xl w-full text-gray-900 focus:outline-none focus:ring-[#8B7E74]/20"
                                aria-invalid="<?= isset($errors['email']) ? 'true' : 'false' ?>">
                            <?php if (!empty($errors['email'])): ?>
                                <p class="mt-2 text-red-600 text-sm"><?= esc($errors['email']) ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- PASSWORD -->
                        <div>
                            <label class="block mb-2 font-semibold text-gray-700">Password</label>

                            <div class="relative">
                                <input type="password" id="password" name="password" required
                                    placeholder="Create a password"
                                    class="px-4 py-4 border-2 <?= isset($errors['password']) ? 'border-red-500' : 'border-gray-200' ?> rounded-xl w-full text-gray-900 focus:outline-none focus:ring-[#8B7E74]/20"
                                    aria-invalid="<?= isset($errors['password']) ? 'true' : 'false' ?>">

                                <button type="button" aria-label="Toggle password visibility"
                                    id="togglePasswordBtn"
                                    class="top-4 right-4 absolute p-1">
                                    <svg id="icon-eye" xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                            d="M2.5 12s4-7 9.5-7 9.5 7 9.5 7-4 7-9.5 7S2.5 12 2.5 12z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>

                                    <svg id="icon-eye-off" xmlns="http://www.w3.org/2000/svg"
                                        class="hidden w-5 h-5 text-gray-500" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                            d="M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>

                            <?php if (!empty($errors['password'])): ?>
                                <p class="mt-2 text-red-600 text-sm"><?= esc($errors['password']) ?></p>
                            <?php endif; ?>

                            <!-- Password Requirements -->
                            <div id="password-requirements" class="space-y-1 mt-2 text-gray-700 text-sm">
                                <p id="req-length" class="text-red-500">• At least 8 characters</p>
                                <p id="req-number" class="text-red-500">• Contains a number</p>
                                <p id="req-upper" class="text-red-500">• Contains an uppercase letter</p>
                                <p id="req-lower" class="text-red-500">• Contains a lowercase letter</p>
                                <p id="req-special" class="text-red-500">• Contains a special character (!@#$%^&*)</p>
                            </div>

                            <!-- Strength Meter -->
                            <div class="mt-3">
                                <div class="bg-gray-200 rounded-full w-full h-2 overflow-hidden">
                                    <div id="strengthBar" class="bg-red-500 w-0 h-full transition-all"></div>
                                </div>
                                <p id="strengthText" class="mt-1 text-gray-600 text-xs">Strength: —</p>
                            </div>
                        </div>

                        <!-- CONFIRM PASSWORD -->
                        <div>
                            <label class="block mb-2 font-semibold text-gray-700">Confirm Password</label>

                            <div class="relative">
                                <input type="password" id="password_confirm" name="password_confirm" required
                                    placeholder="Confirm your password"
                                    class="px-4 py-4 border-2 <?= isset($errors['password_confirm']) ? 'border-red-500' : 'border-gray-200' ?> rounded-xl w-full text-gray-900 focus:outline-none focus:ring-[#8B7E74]/20"
                                    aria-invalid="<?= isset($errors['password_confirm']) ? 'true' : 'false' ?>">

                                <button type="button" id="toggleConfirmBtn" class="top-4 right-4 absolute p-1">
                                    <svg id="icon-eye2" xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                            d="M2.5 12s4-7 9.5-7 9.5 7 9.5 7-4 7-9.5 7S2.5 12 2.5 12z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>

                                    <svg id="icon-eye-off2" xmlns="http://www.w3.org/2000/svg"
                                        class="hidden w-5 h-5 text-gray-500" fill="none" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6"
                                            d="M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>

                            <?php if (!empty($errors['password_confirm'])): ?>
                                <p class="mt-2 text-red-600 text-sm"><?= esc($errors['password_confirm']) ?></p>
                            <?php endif; ?>

                            <!-- Match Indicator -->
                            <p id="matchText" class="mt-2 text-red-500 text-sm">• Passwords must match</p>
                        </div>

                        <!-- SUBMIT -->
                        <button type="submit"
                            class="bg-[#8B7E74] hover:bg-[#A99D92] py-4 rounded-full w-full font-semibold text-white text-lg">
                            Create Account
                        </button>
                    </form>

                    <!-- LINKS -->
                    <div class="space-y-2 mt-6 text-center">
                        <p class="text-gray-700">
                            Already have an account?
                            <a href="/loginPage" class="font-semibold text-[#8B7E74] hover:text-[#A99D92]">
                                Log in here
                            </a>
                        </p>

                        <?= view('components/buttons/back_button', [
                            'href' => '/',
                            'label' => 'Back to Home'
                        ]) ?>
                    </div>

                </div>
            </div>

        </main>
    </div>

    <script>
        // Eye toggle (main password)
        document.getElementById("togglePasswordBtn").addEventListener("click", function() {
            const input = document.getElementById("password");
            const eye = document.getElementById("icon-eye");
            const eyeOff = document.getElementById("icon-eye-off");

            const isHidden = input.type === "password";
            input.type = isHidden ? "text" : "password";
            eye.classList.toggle("hidden");
            eyeOff.classList.toggle("hidden");
        });

        // Eye toggle (confirm password)
        document.getElementById("toggleConfirmBtn").addEventListener("click", function() {
            const input = document.getElementById("password_confirm");
            const eye = document.getElementById("icon-eye2");
            const eyeOff = document.getElementById("icon-eye-off2");

            const isHidden = input.type === "password";
            input.type = isHidden ? "text" : "password";
            eye.classList.toggle("hidden");
            eyeOff.classList.toggle("hidden");
        });

        // Password strength + requirements
        const passwordInput = document.getElementById("password");
        const strengthBar = document.getElementById("strengthBar");
        const strengthText = document.getElementById("strengthText");

        const reqs = {
            length: document.getElementById("req-length"),
            number: document.getElementById("req-number"),
            upper: document.getElementById("req-upper"),
            lower: document.getElementById("req-lower"),
            special: document.getElementById("req-special"),
        };

        passwordInput.addEventListener("input", function() {
            const val = passwordInput.value;
            let score = 0;

            const tests = {
                length: val.length >= 8,
                number: /\d/.test(val),
                upper: /[A-Z]/.test(val),
                lower: /[a-z]/.test(val),
                special: /[^A-Za-z0-9]/.test(val),
            };

            for (const key in tests) {
                if (tests[key]) {
                    reqs[key].classList.remove("text-red-500");
                    reqs[key].classList.add("text-green-600");
                    score++;
                } else {
                    reqs[key].classList.add("text-red-500");
                    reqs[key].classList.remove("text-green-600");
                }
            }

            // Strength bar visuals
            const widths = ["0%", "20%", "40%", "60%", "80%", "100%"];
            const colors = ["gray", "red", "orange", "yellow", "limegreen", "green"];

            strengthBar.style.width = widths[score];
            strengthBar.style.backgroundColor = colors[score];

            const labels = ["—", "Very Weak", "Weak", "Okay", "Strong", "Very Strong"];
            strengthText.textContent = "Strength: " + labels[score];
        });

        // Password match indicator
        const confirmInput = document.getElementById("password_confirm");
        const matchText = document.getElementById("matchText");

        function updateMatch() {
            if (confirmInput.value === passwordInput.value && confirmInput.value !== "") {
                matchText.textContent = "• Passwords match";
                matchText.classList.remove("text-red-500");
                matchText.classList.add("text-green-600");
            } else {
                matchText.textContent = "• Passwords must match";
                matchText.classList.add("text-red-500");
                matchText.classList.remove("text-green-600");
            }
        }

        passwordInput.addEventListener("input", updateMatch);
        confirmInput.addEventListener("input", updateMatch);
    </script>

</body>

</html>