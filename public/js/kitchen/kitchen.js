// =============================================================================
// CLOCK
// =============================================================================

function updateClock() {

    const el = document.getElementById('kitchen-clock');

    if (el) {

        const now = new Date();

        el.textContent = now.toLocaleTimeString('id-ID');
    }
}

updateClock();
setInterval(updateClock, 1000);

// =============================================================================
// AUDIO
// =============================================================================

const sound = document.getElementById('notifSound');

// UNLOCK AUDIO — browser butuh interaksi user dulu
document.body.addEventListener(

    'click',

    () => {

        sound.play()
            .then(() => {
                sound.pause();
                sound.currentTime = 0;
            })
            .catch(() => {});
    },

    { once: true }
);

// =============================================================================
// POLLING — CEK ORDER BARU TIAP 5 DETIK
// =============================================================================

let currentOrderCount = document.querySelectorAll('.order-card').length;

setInterval(async () => {

    try {

        const response = await fetch('/kitchen');

        const html = await response.text();

        const parser = new DOMParser();

        const doc = parser.parseFromString(html, 'text/html');

        const newCount = doc.querySelectorAll('.order-card').length;

        // ADA ORDER BARU
        if (newCount > currentOrderCount) {

            sound.currentTime = 0;
            await sound.play();

            currentOrderCount = newCount;

            setTimeout(() => {
                location.reload();
            }, 1200);

            return;
        }

        // ORDER BERKURANG — ada yang di-done
        if (newCount < currentOrderCount) {

            currentOrderCount = newCount;
            location.reload();

            return;
        }

        currentOrderCount = newCount;

    } catch (error) {

        console.error('Polling error:', error);
    }

}, 5000);