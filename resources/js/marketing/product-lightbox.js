export function initProductLightbox() {
    const dialog = document.querySelector('[data-product-lightbox]');
    if (!dialog || typeof dialog.showModal !== 'function') return;

    const links = [...document.querySelectorAll('[data-product-lightbox-open]')];
    const image = dialog.querySelector('[data-product-lightbox-image]');
    const caption = dialog.querySelector('[data-product-lightbox-caption]');
    const count = dialog.querySelector('[data-product-lightbox-count]');
    let currentIndex = 0;
    let trigger = null;

    const show = (index) => {
        currentIndex = (index + links.length) % links.length;
        const link = links[currentIndex];
        image.src = link.getAttribute('href');
        image.alt = link.querySelector('img')?.alt ?? '';
        caption.textContent = link.closest('figure')?.querySelector('figcaption strong')?.textContent ?? '';
        count.textContent = `${currentIndex + 1} / ${links.length}`;
    };

    links.forEach((link, index) => link.addEventListener('click', (event) => {
        event.preventDefault();
        trigger = link;
        show(index);
        dialog.showModal();
    }));

    dialog.querySelector('[data-product-lightbox-prev]').addEventListener('click', () => show(currentIndex - 1));
    dialog.querySelector('[data-product-lightbox-next]').addEventListener('click', () => show(currentIndex + 1));
    dialog.querySelector('[data-product-lightbox-close]').addEventListener('click', () => dialog.close());
    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) dialog.close();
    });
    dialog.addEventListener('keydown', (event) => {
        if (event.key === 'ArrowLeft') show(currentIndex - 1);
        if (event.key === 'ArrowRight') show(currentIndex + 1);
    });
    dialog.addEventListener('close', () => trigger?.focus());
}
