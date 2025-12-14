
<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Create Announcement</h2>

    <form action="<?= site_url('admin/dashboard/announcement') ?>" method="post" class="space-y-5">
        <?= csrf_field() ?>

        <!-- Title -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
            <input type="text" name="title"
                   class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                   placeholder="Enter announcement title" required>
        </div>

        <!-- Content -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Content</label>
            <textarea name="content" rows="5"
                      class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-green-600 focus:outline-none"
                      placeholder="Write announcement details..." required></textarea>
        </div>

        <!-- Actions -->
        <div class="flex justify-end gap-3">
            <a href="<?= site_url('/') ?>"
               class="px-5 py-2 rounded-md bg-gray-300 hover:bg-gray-400 text-gray-800">
                Cancel
            </a>

            <button type="submit"
                    class="px-5 py-2 rounded-md bg-green-600 hover:bg-green-700 text-white font-semibold">
                Publish
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
```
