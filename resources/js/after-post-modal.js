document.addEventListener('DOMContentLoaded', function() {
    const shareModal = document.getElementById('shareModal');
    const closeModal = document.getElementById('closeModal');

    if (shareModal) {
        shareModal.classList.remove('hidden');

        closeModal.addEventListener('click', function() {
            shareModal.classList.add('hidden');
        });

        // モーダル外をクリックしても閉じる
        shareModal.addEventListener('click', function(e) {
            if (e.target === shareModal) {
                shareModal.classList.add('hidden');
            }
        });
    }
});