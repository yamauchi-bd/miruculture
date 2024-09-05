document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('detailModal');
    const modalContent = document.getElementById('modalContent');
    const closeModal = document.getElementById('closeModal');
    const showDetailButtons = document.querySelectorAll('.show-details');

    // 詳細表示ボタンのクリックイベント
    showDetailButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const detailContent = document.getElementById(targetId).innerHTML;
            modalContent.innerHTML = detailContent;
            modal.classList.remove('hidden');
        });
    });

    // モーダルを閉じる
    closeModal.addEventListener('click', function() {
        modal.classList.add('hidden');
    });

    // モーダル外をクリックして閉じる
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
});