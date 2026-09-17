import './bootstrap';

const navigationToggle = document.querySelector('[data-nav-toggle]');
const navigation = document.querySelector('[data-nav]');

navigationToggle?.addEventListener('click', () => {
    const isOpen = navigation?.classList.toggle('open') ?? false;
    navigationToggle.setAttribute('aria-expanded', String(isOpen));
});

navigation?.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', () => {
        navigation.classList.remove('open');
        navigationToggle?.setAttribute('aria-expanded', 'false');
    });
});

const inquiryForm = document.querySelector('[data-inquiry-form]');

if (inquiryForm) {
    const interest = inquiryForm.querySelector('[data-interest]');
    const productSlug = inquiryForm.querySelector('[data-product-slug]');
    const submit = inquiryForm.querySelector('[data-submit]');

    const syncProductSlug = () => {
        productSlug.value = ['szervizpro', 'foodshop'].includes(interest.value) ? interest.value : '';
    };

    interest?.addEventListener('change', syncProductSlug);
    syncProductSlug();

    inquiryForm.addEventListener('submit', () => {
        submit.disabled = true;
        submit.textContent = 'Beküldés folyamatban…';
    });
}
