import './bootstrap';
import Alpine from 'alpinejs'

window.Alpine = Alpine
Alpine.start()

// Show loading indicator during page transitions
document.addEventListener('DOMContentLoaded', () => {
    const loading = document.createElement('div');
    loading.innerHTML = `
        <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50 hidden" id="loadingIndicator">
            <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-indigo-500"></div>
        </div>
    `;
    document.body.appendChild(loading);

    // Show loading on form submissions
    document.addEventListener('submit', () => {
        document.getElementById('loadingIndicator').classList.remove('hidden');
    });

    // Show loading on link clicks (except for certain actions)
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        if (link && !e.ctrlKey && !e.shiftKey && !e.metaKey && !e.defaultPrevented) {
            const href = link.getAttribute('href');
            if (href && href !== '#' && !href.startsWith('javascript:')) {
                document.getElementById('loadingIndicator').classList.remove('hidden');
            }
        }
    });
});

// Hide loading indicator when page is fully loaded
window.addEventListener('load', () => {
    document.getElementById('loadingIndicator')?.classList.add('hidden');
});
