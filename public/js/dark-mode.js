/**
 * TaskManager - Dark Mode System Script
 * Handles theme toggling, localStorage persistence, anti-flash FOUC prevention, and Chart.js theme updates.
 */

(function () {
    // 1. Determine saved theme or system preference
    function getPreferredTheme() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark' || savedTheme === 'light') {
            return savedTheme;
        }
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    // 2. Immediate Theme Application (Anti-flash FOUC)
    const initialTheme = getPreferredTheme();
    document.documentElement.setAttribute('data-theme', initialTheme);

    // 3. Update Toggle Buttons across the page
    function updateToggleButtons(theme) {
        const toggleButtons = document.querySelectorAll('.dark-mode-toggle');
        toggleButtons.forEach(btn => {
            const icon = btn.querySelector('i');
            const textSpan = btn.querySelector('.toggle-text');

            if (theme === 'dark') {
                if (icon) icon.className = 'fa-solid fa-sun';
                if (textSpan) textSpan.textContent = 'Giao diện sáng';
                btn.setAttribute('title', 'Chuyển sang giao diện sáng');
                btn.setAttribute('aria-label', 'Chuyển sang giao diện sáng');
            } else {
                if (icon) icon.className = 'fa-solid fa-moon';
                if (textSpan) textSpan.textContent = 'Giao diện tối';
                btn.setAttribute('title', 'Chuyển sang giao diện tối');
                btn.setAttribute('aria-label', 'Chuyển sang giao diện tối');
            }
        });
    }

    // 4. Dynamically Update Chart.js Theme Elements
    function updateChartTheme(theme) {
        if (typeof Chart !== 'undefined' && window.myCharts) {
            const isDark = theme === 'dark';
            const textColor = isDark ? '#cbd5e1' : '#64748b';
            const gridColor = isDark ? 'rgba(255, 255, 255, 0.08)' : 'rgba(0, 0, 0, 0.05)';

            Object.values(window.myCharts).forEach(chart => {
                if (chart && chart.options) {
                    if (chart.options.scales) {
                        Object.values(chart.options.scales).forEach(scale => {
                            if (scale.ticks) scale.ticks.color = textColor;
                            if (scale.grid) scale.grid.color = gridColor;
                        });
                    }
                    if (chart.options.plugins && chart.options.plugins.legend) {
                        if (chart.options.plugins.legend.labels) {
                            chart.options.plugins.legend.labels.color = textColor;
                        }
                    }
                    if (chart.options.plugins && chart.options.plugins.tooltip) {
                        chart.options.plugins.tooltip.backgroundColor = isDark ? '#1e293b' : '#ffffff';
                        chart.options.plugins.tooltip.titleColor = isDark ? '#f8fafc' : '#1e293b';
                        chart.options.plugins.tooltip.bodyColor = isDark ? '#cbd5e1' : '#475569';
                        chart.options.plugins.tooltip.borderColor = isDark ? '#334155' : '#e2e8f0';
                        chart.options.plugins.tooltip.borderWidth = 1;
                    }
                    chart.update();
                }
            });
        }
    }

    // 5. Global Toggle Handler
    window.toggleDarkMode = function () {
        document.documentElement.classList.add('theme-transition');
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        document.documentElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);

        updateToggleButtons(newTheme);
        updateChartTheme(newTheme);

        setTimeout(() => {
            document.documentElement.classList.remove('theme-transition');
        }, 300);
    };

    // 6. DOM Ready Listener
    document.addEventListener('DOMContentLoaded', function () {
        const currentTheme = document.documentElement.getAttribute('data-theme') || getPreferredTheme();
        updateToggleButtons(currentTheme);

        document.addEventListener('click', function (e) {
            const toggleBtn = e.target.closest('.dark-mode-toggle');
            if (toggleBtn) {
                e.preventDefault();
                window.toggleDarkMode();
            }
        });
    });
})();
