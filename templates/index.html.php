<?php include_once(__DIR__ . './commons/header.html.php') ?>

<div class="bg-gray-200 h-screen flex justify-center overflow-hidden items-center font-thin shadow-lg">
    <?php if( auth()->check() ): ?>
      <a href="<?= route('dashboard.links.index') ?>" class="px-8 rounded-lg bg-yellow-500 hover:opacity-60  text-gray-800 p-4 uppercase border-yellow-500 border-t border-b border-r">List Links</a>
      <a href="<?= route('logout') ?>" class="px-8 rounded-r-lg text-gray-800 hover:opacity-60 p-4 uppercase border-gray-500 border-t border-b border-r">Logout</a>
    <?php else: ?>
      <a href="<?= route('auth.index') ?>" class="px-8 rounded-lg bg-yellow-500 hover:opacity-60  text-gray-800 p-4 uppercase border-yellow-500 border-t border-b border-r">Login</a>
    <?php endif ?>
</div>

<?php include_once(__DIR__ . './commons/footer.html.php') ?>
