<?php
include 'header.php';
?>
<main class="py-5">
  <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-3xl font-bold leading-tight text-gray-900 mb-4">Contact Us</h2>
    <div class="mb-8 h-1 w-24 bg-black"></div>
    <form method="post" action="#" class="space-y-4">
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
      </div>
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
      </div>
      <div>
        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
        <textarea name="message" id="message" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required></textarea>
      </div>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Send Message</button>
    </form>
  </div>
</main>
<?php include 'footer.php'; ?>
