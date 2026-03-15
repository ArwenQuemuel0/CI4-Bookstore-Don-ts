<?php
// Component: components/cta.php
// Usage example:
// <?= view('components/cta', [
//     'heading' => 'Discover Your Next Favorite Book',
//     'sub' => 'Dive into enchanting tales that spark your imagination and stay with you forever.',
//     'primary' => ['label' => 'Start Reading Now', 'href' => '/shop']
// ]) 
?>

<section id="cta-section"
    class="relative bg-cover bg-center py-10 md:py-16 w-full overflow-hidden text-gray-900"
    style="background-image: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.4)), url('https://www.ahouseinthehills.com/wp-content/uploads/2024/11/Bedroom.jpeg');">

    <!-- Animated overlay particles -->
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <div class="top-4 left-6 absolute bg-[#F5F0EC] rounded-full w-2 h-2 animate-ping"></div>
        <div class="top-12 right-12 absolute bg-[#C7BBB0] rounded-full w-1 h-1 animate-bounce"></div>
        <div class="bottom-10 left-1/2 absolute bg-white/50 rounded-full w-2 h-2 animate-pulse"></div>
    </div>

    <!-- Gradient overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-black/50 via-transparent to-black/30"></div>

    <!-- Container -->
    <div class="z-10 relative flex lg:flex-row flex-col justify-center items-center gap-8 lg:gap-12 mx-auto px-6 max-w-6xl">

        <!-- CTA Box -->
        <div class="z-20 relative flex-1 bg-white/25 shadow-xl hover:shadow-2xl backdrop-blur-md p-6 md:p-8 lg:p-10 border border-white/20 rounded-xl w-full lg:max-w-4xl text-left hover:scale-[1.02] transition-all hover:-translate-y-1 duration-700 transform">

            <!-- Decorative book icon -->
            <div class="-top-3 left-1/2 absolute flex justify-center items-center bg-gradient-to-r from-[#F5F0EC] to-[#C7BBB0] shadow-lg rounded-full w-8 h-8 -translate-x-1/2">
                <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                    </path>
                </svg>
            </div>

            <?php if (!empty($heading)): ?>
                <h2 class="mb-3 font-['Righteous'] font-bold text-[#F5F0EC] text-2xl md:text-3xl leading-snug hover:scale-105 transition duration-500 transform">
                    <?= esc($heading) ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($sub)): ?>
                <p class="opacity-90 hover:opacity-100 mb-5 text-[#C7BBB0] text-base md:text-lg leading-relaxed transition duration-500">
                    <?= esc($sub) ?>
                </p>
            <?php endif; ?>

            <div class="flex sm:flex-row flex-col justify-center lg:justify-start gap-3">
                <?php if (!empty($primary)): ?>
                    <?= view('components/buttons/primary_button', [
                        'label' => $primary['label'],
                        'href' => $primary['href'],
                        'class' => 'text-sm md:text-base px-5 py-2.5 bg-gradient-to-r from-[#F5F0EC] to-[#C7BBB0] hover:from-[#C7BBB0] hover:to-[#F5F0EC] text-gray-900 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300'
                    ]) ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Book Image -->
        <div class="z-10 flex flex-1 justify-center lg:justify-start items-center opacity-0 motion-safe:opacity-100 mt-6 lg:mt-0 w-full transition-all translate-y-6 motion-safe:translate-y-0 duration-[1200ms] ease-out delay-300">
            <img src="https://chairish-prod.freetls.fastly.net/image/product/master/f07c0e6c-6ce0-4d9e-8f96-c63846e62ddb/decorative-books-smore-book-bundle-1-foot-of-brown-books-7973"
                alt="BooksInARow"
                class="drop-shadow-xl hover:drop-shadow-2xl rounded-xl w-full max-w-[560px] lg:max-w-[640px] object-contain -rotate-2 hover:rotate-0 transition duration-700 transform">
        </div>
    </div>
</section>