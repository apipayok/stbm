import Popup from './utils/popup.js';
import DonePopup from './utils/donePopup.js';

document.addEventListener('click', (e) => {

    // OPEN FROM URL
    const urlBtn = e.target.closest('[data-popup-url]');
    if (urlBtn) {
        Popup.openFromUrl(urlBtn.dataset.popupUrl);
        return;
    }

    // OPEN FROM INLINE HTML
    const htmlBtn = e.target.closest('[data-popup-html]');
    if (htmlBtn) {
        Popup.open(htmlBtn.dataset.popupHtml);
        return;
    }

    // CLOSE GENERIC POPUP
    if (
        e.target.closest('[data-popup-close]') ||
        !e.target.closest('[data-popup-box]')
    ) {
        Popup.close();
    }

    // DONE POPUP (example trigger)
    const doneBtn = e.target.closest('[data-done-popup]');
    if (doneBtn) {
        const message = doneBtn.dataset.doneMessage || 'Done!';
        DonePopup.show(message);
        return;
    }


});

window.confirmAction = function(el, message = "Confirm?", doneMessage = "Done!", duration = 1500) {
    if (!window.confirm(message)) return false; // browser confirm

    DonePopup.show(doneMessage, duration);     // show popup

    setTimeout(() => {
        // Submit form if element is a form
        if (el.tagName.toLowerCase() === 'form') {
            el.submit();
        }
        // Redirect if element is a link
        else if (el.tagName.toLowerCase() === 'a') {
            const url = el.getAttribute('href');
            if (url) window.location.href = url;
        }
    }, duration);

    return false; // prevent immediate action
};
