document.addEventListener('DOMContentLoaded', function () {

    // JS for the hamburger menu
    const toggleBtn = document.getElementById('menu-toggle');
    const navMenu = document.getElementById('primary-menu');

    if (toggleBtn && navMenu) {
        toggleBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const isOpen = navMenu.classList.toggle('is-open');
            toggleBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            toggleBtn.setAttribute('aria-label', isOpen ? 'Close main menu' : 'Open main menu');
        });

        // Close on Escape key (WCAG Best Practice)
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && navMenu.classList.contains('is-open')) {
                navMenu.classList.remove('is-open');
                toggleBtn.setAttribute('aria-expanded', 'false');
                toggleBtn.setAttribute('aria-label', 'Open main menu');
                toggleBtn.focus();
            }
        });
    }

    // category filter on webshop collapses when opened under 1024px width screen
    if (window.innerWidth <= 1024) {
        document.querySelectorAll('.category-collapsible').forEach(el => el.removeAttribute('open'));
    }

    // test drive page logic
    const form = document.getElementById('testRideForm');
    if (form) {
        const steps = Array.from(form.querySelectorAll('.form-step'));
        const indicators = Array.from(document.querySelectorAll('.step-indicator'));
        const progressFill = document.getElementById('progressFill');
        let currentStep = 1;

        function goToStep(targetStep) {
            steps.forEach((step) => {
                const isTarget = parseInt(step.dataset.step, 10) === targetStep;
                step.hidden = !isTarget;
                step.classList.toggle('active', isTarget);
            });

            indicators.forEach((indicator) => {
                const stepNum = parseInt(indicator.dataset.step, 10);
                indicator.classList.toggle('active', stepNum === targetStep);
                indicator.classList.toggle('completed', stepNum < targetStep);
            });

            if (progressFill) {
                progressFill.style.width = `${(targetStep / steps.length) * 100}%`;
            }

            // Accessibility focus: move focus to the first interactive input in new step
            const activeStep = steps.find(s => parseInt(s.dataset.step, 10) === targetStep);
            if (activeStep) {
                const firstControl = activeStep.querySelector('input:not([type="hidden"]), select, textarea');
                if (firstControl) firstControl.focus();
            }

            currentStep = targetStep;
        }

        function isStepValid(stepNumber) {
            const activeStep = steps.find(s => parseInt(s.dataset.step, 10) === stepNumber);
            if (!activeStep) return true;

            const inputs = Array.from(activeStep.querySelectorAll('input[required], select[required], textarea[required]'));
            for (const input of inputs) {
                if (!input.checkValidity()) {
                    input.reportValidity();
                    return false;
                }
            }
            return true;
        }

        // Next step button listeners
        form.querySelectorAll('.next-step').forEach((btn) => {
            btn.addEventListener('click', () => {
                if (isStepValid(currentStep) && currentStep < steps.length) {
                    goToStep(currentStep + 1);
                }
            });
        });

        // Previous step button listeners
        form.querySelectorAll('.prev-step').forEach((btn) => {
            btn.addEventListener('click', () => {
                if (currentStep > 1) {
                    goToStep(currentStep - 1);
                }
            });
        });
    }

});