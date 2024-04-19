<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>


<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <!-- Your content -->
    <p class="mb-6">
      <a class="text-blue-500 underline" href="/notes">
        Go Back
      </a> 
    </p>
    <p>
      <?= htmlspecialchars($note['body']) ?>
    </p>

   <footer class="mt-6">
  <div class="display: flex-inline">
  <!-- EDIT BUTTON  -->
  <a href="/note/edit?id=<?= $note['id'] ?>" class="rounded-md bg-gray-500 px-3 py-1 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</a>
   
  
  <form method="POST" class="mt-6">
      <input type="hidden" name="_method" value="DELETE">
      <input type="hidden" name="id" value="<?= $note['id'] ?>">
      <button class="text-sm text-red-500 hover:underline">Delete</button>
    </form> 
  </div>
  
  </footer> 
    
   
  </div>
</main>

<?php require base_path('views/partials/footer.php') ?>