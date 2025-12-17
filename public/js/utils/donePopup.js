// utils/donePopup.js
// Simple “Done” popup utility — vanilla JS

const DonePopup = (() => {

    const overlayId = 'donePopupOverlay';
    const messageId = 'donePopupMessage';

    function createIfNotExists() {
        if (document.getElementById(overlayId)) return;

        const overlay = document.createElement('div');
        overlay.id = overlayId;
        overlay.style = `
            display:none;
            position:fixed;
            top:0; left:0;
            width:100%; height:100%;
            background:rgba(0,0,0,0.5);
            justify-content:center;
            align-items:center;
            z-index:9999;
        `;

        const content = document.createElement('div');
        content.style = `
            background:white;
            padding:30px 40px;
            border-radius:12px;
            text-align:center;
            font-size:18px;
            font-weight:bold;
            display:flex;
            flex-direction:column;
            gap:10px;
            min-width:200px;
        `;

        const check = document.createElement('span');
        check.textContent = '✔';
        check.style.color = 'green';
        check.style.fontSize = '40px';

        const msg = document.createElement('div');
        msg.id = messageId;
        msg.textContent = 'Done!';

        content.appendChild(check);
        content.appendChild(msg);
        overlay.appendChild(content);
        document.body.appendChild(overlay);
    }

    function show(message = 'Done!', duration = 1500) {
        createIfNotExists();

        const overlay = document.getElementById(overlayId);
        const msg = document.getElementById(messageId);

        msg.textContent = message;
        overlay.style.display = 'flex';

        setTimeout(() => {
            overlay.style.display = 'none';
        }, duration);
    }

    return { show };

})();
export default DonePopup;
