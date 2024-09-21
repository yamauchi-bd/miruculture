document.addEventListener('DOMContentLoaded', function() {
    const postContainers = document.querySelectorAll('.post-container');
    
    postContainers.forEach(container => {
        const toggleButton = container.querySelector('.toggle-details');
        const detailsSection = container.querySelector('.post-details');
        const arrowDown = container.querySelector('.arrow-down');
        const arrowUp = container.querySelector('.arrow-up');
        const summaries = container.querySelectorAll('.factor-summary');
        const fulls = container.querySelectorAll('.factor-full');
        const satisfactionReasons = container.querySelectorAll('.satisfaction-reason');
        const toggleText = container.querySelector('.toggle-text');
        
        toggleButton.addEventListener('click', function(e) {
            e.stopPropagation();
            
            if (detailsSection.classList.contains('hidden')) {
                // 詳細を表示
                detailsSection.classList.remove('hidden');
                arrowDown.classList.add('hidden');
                arrowUp.classList.remove('hidden');
                summaries.forEach(summary => summary.classList.add('hidden'));
                fulls.forEach(full => full.classList.remove('hidden'));
                satisfactionReasons.forEach(reason => reason.classList.remove('hidden'));
                toggleText.textContent = '閉じる';
            } else {
                // 詳細を非表示
                detailsSection.classList.add('hidden');
                arrowDown.classList.remove('hidden');
                arrowUp.classList.add('hidden');
                summaries.forEach(summary => summary.classList.remove('hidden'));
                fulls.forEach(full => full.classList.add('hidden'));
                satisfactionReasons.forEach(reason => reason.classList.add('hidden'));
                toggleText.textContent = 'もっと見る';
            }
        });
        
        container.addEventListener('click', function() {
            toggleButton.click();
        });
    });
});