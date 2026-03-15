<div class="flex flex-col bg-teal-500 shadow-lg hover:shadow-2xl p-8 border border-yellow-500 rounded-2xl transition-all duration-300 card-hover">
    <div class="flex-grow text-white text-center">
        <?php echo $content ?? ''; ?>
    </div>

    <?php if (!empty($link)): ?>
        <a href="<?php echo esc($link); ?>"
            class="inline-block bg-red-500 hover:bg-green-500 mt-4 px-4 py-2 rounded-full font-semibold text-white text-sm transition">
            Read more
        </a>
    <?php endif; ?>
</div>