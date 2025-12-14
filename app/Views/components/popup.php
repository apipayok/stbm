<div id="appPopup"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl shadow-xl w-full max-w-xl p-6 relative"
         data-popup-box>

        <button
            class="absolute top-3 right-3 text-gray-500 hover:text-black"
            data-popup-close>
            ✕
        </button>

        <!-- Utility slot -->
        <div id="appPopupContent"></div>

    </div>
</div>
