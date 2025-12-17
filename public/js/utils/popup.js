// utils/popup.js
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

        overlay.classList.remove('hidden');
        overlay.classList.add('flex');

        // Show temporary loading
        content.innerHTML = `<p class="text-gray-500">Loading...</p>`;

        try {
            const res = await fetch(url);

            // Check content type
            const contentType = res.headers.get('Content-Type') || '';

            if (contentType.includes('application/pdf')) {
                // PDF: embed in iframe
                content.innerHTML = `<iframe src="${url}" class="w-full h-[80vh]" frameborder="0"></iframe>`;
            } else {
                // HTML/other: get as text and insert
                const html = await res.text();
                content.innerHTML = html;
            }
        } catch (err) {
            content.innerHTML = `<p class="text-red-500">Failed to load content.</p>`;
            console.error(err);
        }
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
