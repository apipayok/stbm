// utils/popup.js
// Generic popup utility — no business logic

const Popup = (() => {

    const overlayId = 'appPopup';
    const contentId = 'appPopupContent';

    function getOverlay() {
        return document.getElementById(overlayId);
    }

    function getContent() {
        return document.getElementById(contentId);
    }

    function open(html) {
        const overlay = getOverlay();
        const content = getContent();
        if (!overlay || !content) return;

        content.innerHTML = html;
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
    }

    async function openFromUrl(url) {
        const overlay = getOverlay();
        const content = getContent();
        if (!overlay || !content) return;

        content.innerHTML = `<p class="text-gray-500">Loading...</p>`;
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');

        const res = await fetch(url);
        const html = await res.text();

        content.innerHTML = html;
    }

    function close() {
        const overlay = getOverlay();
        if (!overlay) return;

        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
    }

    return {
        open,
        openFromUrl,
        close
    };

})();

export default Popup;
