document.addEventListener('DOMContentLoaded', function() {

    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    const decidingFactorsSection = document.getElementById('deciding-factors-content');
    const companyCultureSection = document.getElementById('company-culture-content');
    const postContainers = document.querySelectorAll('.post-container');
    
    function toggleDetails(container, isExpanding) {
        const arrowDown = container.querySelector('.arrow-down');
        const arrowUp = container.querySelector('.arrow-up');
        const summaries = container.querySelectorAll('.factor-summary');
        const fulls = container.querySelectorAll('.factor-full');
        const hiddenCultureDetails = container.querySelectorAll('.culture-detail');
        const toggleText = container.querySelector('.toggle-text');

        arrowDown.classList.toggle('hidden', isExpanding);
        arrowUp.classList.toggle('hidden', !isExpanding);
        summaries.forEach(summary => summary.classList.toggle('hidden', isExpanding));
        fulls.forEach(full => full.classList.toggle('hidden', !isExpanding));
        hiddenCultureDetails.forEach(detail => detail.classList.toggle('hidden', !isExpanding));
        toggleText.textContent = isExpanding ? '閉じる' : 'もっと見る';
    }

    postContainers.forEach(container => {
        const toggleButton = container.querySelector('.toggle-details');
        
        toggleButton.addEventListener('click', function(e) {
            e.stopPropagation();
            const isExpanding = this.querySelector('.toggle-text').textContent === 'もっと見る';
            toggleDetails(container, isExpanding);
        });
        
        container.addEventListener('click', function() {
            toggleButton.click();
        });
    });

    let decidingFactorsChartInstance = null;

    function initDecidingFactorsChart() {
        // 既存の決め手グラフの初期化コード
        // ...
    }

    function setActiveTab(tabName) {
        tabButtons.forEach(button => {
            const isActive = button.dataset.tab === tabName;
            button.classList.toggle('bg-white', isActive);
            button.classList.toggle('border-cyan-500', isActive);
            button.classList.toggle('text-cyan-600', isActive);
            button.classList.toggle('bg-gray-50', !isActive);
            button.classList.toggle('border-transparent', !isActive);
            button.classList.toggle('text-gray-400', !isActive);
        });

        tabContents.forEach(content => {
            content.classList.toggle('hidden', content.id !== tabName + '-content');
        });

        if (tabName === 'deciding-factors' && !decidingFactorsChartInstance) {
            initDecidingFactorsChart();
        }
    }

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            setActiveTab(this.dataset.tab);
        });
    });

    // 初期状態でのアクティブタブの設定
    setActiveTab('deciding-factors');
});