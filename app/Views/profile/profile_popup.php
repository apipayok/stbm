<form action="<?= site_url('profile/edit') ?>" method="post">
    <?= csrf_field() ?>
    <input type="hidden" name="staffno" value="<?= esc($staffno) ?>">

    <!-- Username -->
    <label class="block mt-2 font-medium text-gray-700">Username</label>
    <input type="text" name="username" value="<?= esc($username) ?>"
        class="w-full border rounded px-2 py-1">

    <!-- Department -->
    <label class="block mt-2 font-medium text-gray-700">Department</label>
    <select name="department" class="w-full border rounded px-2 py-1">
        <?php if (!empty($departments)): ?>
            <?php foreach ($departments as $dept): ?>
                <option value="<?= esc($dept['DID']) ?>"
                    <?= ($dept['DID'] == ($department['department'] ?? '')) ? 'selected' : '' ?>>
                    <?= esc($dept['Ddesc']) ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option value="">No departments found</option>
        <?php endif; ?>
    </select>


    <!-- Buttons -->
    <div class="mt-4 flex justify-end gap-2">
        <button type="button" data-popup-close
            class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-100">
            Cancel
        </button>
        <button type="submit"
            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
            Save
        </button>
    </div>
</form>