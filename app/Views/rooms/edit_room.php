<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto px-4 mt-8">
    <h2 class="mb-6 text-2xl font-bold">Edit Room</h2>

    <form action="<?= base_url('admin/rooms/edit/' . $room['roomId']) ?>" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6 max-w-2xl">
        <?= csrf_field() ?>

        <div class="mb-4">
            <label for="roomId" class="block text-sm font-medium text-gray-700 mb-2">Room ID</label>
            <input type="text" name="roomId" id="roomId" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
            value="<?= esc($room['roomId'] ?? '') ?>" required>
        </div>

        <div class="mb-4">
            <label for="roomName" class="block text-sm font-medium text-gray-700 mb-2">Room Name</label>
            <input type="text" name="roomName" id="roomName" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" 
            value="<?= esc($room['roomName'] ?? '') ?>" required>
        </div>

        <div class="mb-6">
            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
            <select name="status" id="status" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="available" <?= (isset($room['status']) && $room['status'] === 'available') ? 'selected' : '' ?>>Available</option>
                <option value="hidden" <?= (isset($room['status']) && $room['status'] === 'hidden') ? 'selected' : '' ?>>Hidden</option>
            </select>
        </div>

        <?php if (!empty($room['image'])): ?>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                <img src="<?= base_url('uploads/rooms/' . esc($room['image'])) ?>" alt="<?= esc($room['roomName']) ?>" class="w-48 h-32 object-cover rounded mb-2">
            </div>
        <?php endif; ?>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Upload New Image</label>
            <input type="file" name="image" id="image" accept="image/*"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded">Save Changes</button>
            <a href="<?= base_url('admin/rooms/view') ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded">Cancel</a>
        </div>
    </form>

</div>

<?= $this->endSection() ?>