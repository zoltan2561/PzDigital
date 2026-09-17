import './bootstrap';
import { initMarketingMotion } from './marketing/motion/index.js';

const navigationToggle = document.querySelector('[data-nav-toggle]');
const navigation = document.querySelector('[data-nav]');

const closeNavigation = (restoreFocus = false) => {
    navigation?.classList.remove('open');
    navigationToggle?.setAttribute('aria-expanded', 'false');
    if (restoreFocus) navigationToggle?.focus();
};

navigationToggle?.addEventListener('click', () => {
    const isOpen = navigation?.classList.toggle('open') ?? false;
    navigationToggle.setAttribute('aria-expanded', String(isOpen));
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && navigation?.classList.contains('open')) {
        closeNavigation(true);
    }
});

navigation?.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
        closeNavigation();
    });
});

const inquiryForm = document.querySelector('[data-inquiry-form]');

if (inquiryForm) {
    const interest = inquiryForm.querySelector('[data-interest]');
    const productSlug = inquiryForm.querySelector('[data-product-slug]');
    const projectSlug = inquiryForm.querySelector('[data-project-slug]');
    const submit = inquiryForm.querySelector('[data-submit]');

    const syncCatalogSelection = () => {
        const selected = interest.selectedOptions[0];
        productSlug.value = selected?.dataset.productOption ?? '';

        if (interest.value !== 'project_reference') {
            projectSlug.value = '';
        } else {
            projectSlug.value = selected?.dataset.projectOption ?? projectSlug.value;
        }
    };

    interest?.addEventListener('change', syncCatalogSelection);
    syncCatalogSelection();

    inquiryForm.addEventListener('submit', () => {
        submit.disabled = true;
        submit.textContent = 'Beküldés folyamatban…';
    });
}

const destroyMarketingMotion = initMarketingMotion();
window.addEventListener('pagehide', destroyMarketingMotion, { once: true });
