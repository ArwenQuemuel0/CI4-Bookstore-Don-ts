<?php
// Page: components/buttons/primary_button
?>

<?php if ($disable ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block bg-[#c0c0c0] opacity-50 px-5 py-2 rounded-md font-semibold text-[#514d4d] text-sm transition-transform duration-200 cursor-not-allowed">
        <?= esc($label ?? 'Primary') ?>
    </a>

<?php elseif ($dark ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block bg-[#fce77c] hover:bg-[#ed865a] px-5 py-2 rounded-md font-semibold text-[#514d4d] text-sm transition-transform duration-200">
        <?= esc($label ?? 'Primary') ?>
    </a>

<?php else: ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block bg-[#e15a37] hover:bg-[#ed865a] px-5 py-2 rounded-md font-semibold text-white text-sm transition-transform duration-200">
        <?= esc($label ?? 'Primary') ?>
    </a>
<?php endif; ?>