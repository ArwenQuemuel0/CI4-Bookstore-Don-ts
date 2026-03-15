<?php
// Page: components/buttons/second_button
?>

<?php if ($disable ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block bg-[#c0c0c0] opacity-50 px-5 py-2 rounded-md font-semibold text-[#514d4d] text-sm transition-transform duration-200 cursor-not-allowed">
        <?= esc($label ?? 'Secondary') ?>
    </a>

<?php elseif ($dark ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block bg-[#fce77c] hover:bg-[#ed865a] px-5 py-2 rounded-md font-semibold text-[#514d4d] hover:text-white text-sm transition-transform duration-200">
        <?= esc($label ?? 'Secondary') ?>
    </a>

<?php else: ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block bg-[#ffefaa] hover:bg-[#fce77c] px-5 py-2 rounded-md font-semibold text-[#514d4d] hover:text-[#514d4d] text-sm transition-transform duration-200">
        <?= esc($label ?? 'Secondary') ?>
    </a>
<?php endif; ?>