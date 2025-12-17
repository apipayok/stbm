<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!-- Popup Content injected via generic Popup.js -->
<div class="flex flex-col h-full">

    <!-- Header -->
    <div class="flex justify-between items-center p-4 border-b">
        <h3 class="text-lg font-semibold">Resit Tempahan</h3>
        <button
            onclick="Popup.close()"
            class="text-gray-500 hover:text-black text-xl">
            ✕
        </button>
    </div>

    <!-- PDF Viewer -->
    <iframe
        src="<?= site_url('dashboard/view/' . $bookingId) ?>"
        class="w-full flex-1 border-0">
    </iframe>

    <!-- Footer -->
    <div class="flex justify-end gap-3 p-4 border-t">
        <a
            href="<?= site_url('dashboard/view/' . $bookingId) ?>"
            download
            class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
            Download PDF
        </a>

        <button
            onclick="Popup.close()"
            class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">
            Close
        </button>
    </div>

</div>

<?= $this->endSection() ?>
