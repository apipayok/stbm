<?php $pager->setSurroundCount(1); ?>

<div class="flex items-center justify-center space-x-1">
    <!-- Previous -->
    <?php if ($pager->hasPreviousPage()): ?>
        <a href="<?= $pager->getPreviousPage() ?>"
           class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
           ‹
        </a>
    <?php else: ?>
        <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded cursor-not-allowed">‹</span>
    <?php endif; ?>

    <!-- Next -->
    <?php if ($pager->hasNextPage()): ?>
        <a href="<?= $pager->getNextPage() ?>"
           class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
           ›
        </a>
    <?php else: ?>
        <span class="px-3 py-1 bg-gray-100 text-gray-400 rounded cursor-not-allowed">›</span>
    <?php endif; ?>
</div>
