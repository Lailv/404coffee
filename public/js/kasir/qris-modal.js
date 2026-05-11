function openQrisModal() {
    const modal = document.getElementById('qrisModal');
    if (modal) {
        modal.classList.add('active');
    }
}

function closeQrisModal() {
    const modal = document.getElementById('qrisModal');
    if (modal) {
        modal.classList.remove('active');
    }
}

// Close modal kalau klik di luar modal-content
document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('qrisModal');

    if (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                closeQrisModal();
            }
        });
    }

    // Close modal dengan tombol Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeQrisModal();
        }
    });

});