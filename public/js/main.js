import Popup from './utils/popup.js';

document.addEventListener('click', (e) => {

    // OPEN FROM URL
    const urlBtn = e.target.closest('[data-popup-url]');
    if (urlBtn) {
        Popup.openFromUrl(urlBtn.dataset.popupUrl);
        return;
    }

    // OPEN FROM INLINE HTML (rare but useful)
    const htmlBtn = e.target.closest('[data-popup-html]');
    if (htmlBtn) {
        Popup.open(htmlBtn.dataset.popupHtml);
        return;
    }

    // CLOSE
    if (
        e.target.closest('[data-popup-close]') ||
        !e.target.closest('[data-popup-box]')
    ) {
        Popup.close();
    }

});
