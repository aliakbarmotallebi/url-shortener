<?php include_once(__DIR__ . '/../commons/header.html.php') ?>

<div class="bg-gray-200 h-screen flex justify-center overflow-hidden items-center font-thin shadow-lg">
  <div class='lg:w-2/4 sm:w-1/2 md:w-1/3'>
    <div class='rounded-lg overflow-hidden mb-2 bg-white'>
      <div class='p-2 shadow bg-white'>
        <div class='flex gap-2'>
          <input onChange={this.setItem} class='border bg-gray-200 border-gray-300 text-gray-900 rounded flex-1 pl-1' type="text" />
          <button class='flex items-center px-2 py-1 border border-gray-300 text-gray-900 rounded-md disabled:opacity-50'>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add Url
          </button>
        </div>
      </div>

      <?php foreach($links as $link): ?>
      <div class="group text-gray-500 bg-white w-full cursor-pointer hover:shadow-lg transition delay-100 duration-200 ease-in-out hover:scale-[1.02] transform mb-1">
        <div class="hover:bg-blue-100 flex flex-row px-3 py-2 justify-between items-center rounded">
          <div class="flex">
            <svg class="w-2 group-hover:text-teal-500 text-gray-500 mx-2" viewBox="0 0 8 8" fill="currentColor">
              <circle cx="4" cy="4" r="3" />
            </svg>
            <div>
              <div class="ml-1">
                <a class="text-gray-900 text-lg" href="<?= $link->getUrlShort(); ?>" target="_blank">
                  <?= $link->getUrlShort(); ?>
                </a>
              </div>
              <div class="ml-1">
                <a class="text-gray-600 text-sm" href="<?= $link->url ?>" target="_blank">
                  <?= $link->url ?>
                </a>
              </div>
            </div>
          </div>
          <div>
            <button  class="text-gray-500 font-thin group-hover:text-red-500">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </button>
          </div>
        </div>
      </div>
      <?php endforeach ?>

      <button class='px-3 py-2 text-sm font-semibold border-t border-gray-300 text-gray-900 hover:bg-gray-700 hover:text-white animate transition-all mt-2 text-center w-full'>
          Delete All
      </button>
    </div>
  </div>
</div>

<?php include_once(__DIR__ . '/../commons/footer.html.php') ?>
