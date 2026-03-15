<?php
// Page: components/buttons/border_button
?>

<?php if ($disable ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block bg-[#ffffff] opacity-50 px-5 py-2 border-[#fce77c] border-2 rounded-md font-semibold text-[#c0c0c0] text-sm transition-transform duration-200 cursor-not-allowed">
        <?= esc($label ?? 'Border') ?>
    </a>

<?php elseif ($dark ?? false) : ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block hover:bg-[#ed865a] px-5 py-2 border-[#fce77c] border-2 rounded-md font-semibold text-[#fce77c] hover:text-white text-sm transition-transform duration-200">
        <?= esc($label ?? 'Border') ?>
    </a>

<?php else: ?>
    <a href="<?= esc($href ?? '#') ?>"
        class="inline-block hover:bg-[#ed865a] px-5 py-2 border-[#fce77c] border-2 rounded-md font-semibold text-[#514d4d] hover:text-white text-sm transition-transform duration-200">
        <?= esc($label ?? 'Border') ?>
    </a>
<?php endif; ?>