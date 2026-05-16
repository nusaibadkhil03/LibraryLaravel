import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.addEventListener('DOMContentLoaded', () => {
    const counters = document.querySelectorAll('.counter');

    counters.forEach(counter => {
        const target = parseInt(counter.dataset.target || '0', 10);
        let current = 0;

        if (target <= 0) {
            counter.textContent = target;
            return;
        }

        const increment = Math.max(1, Math.ceil(target / 60));

        const updateCounter = () => {
            current += increment;

            if (current >= target) {
                counter.textContent = target;
            } else {
                counter.textContent = current;
                requestAnimationFrame(updateCounter);
            }
        };

        counter.textContent = 0;
        updateCounter();
    });
});