export function initProjectShowcase(gsap, ScrollTrigger) {
    const roots = [...document.querySelectorAll('[data-project-showcase]')];
    const cleanups = [];

    roots.forEach((root) => {
        const stories = [...root.querySelectorAll('[data-project-story]')];
        const media = [...root.querySelectorAll('[data-project-media]')];
        if (stories.length === 0 || media.length === 0) return;

        const activate = (slug, animate = true) => {
            stories.forEach((story) => story.classList.toggle('is-active', story.dataset.projectStory === slug));
            media.forEach((item) => {
                const isActive = item.dataset.projectMedia === slug;
                item.classList.toggle('is-active', isActive);
                if (animate) {
                    gsap.to(item, { autoAlpha: isActive ? 1 : 0, duration: 0.24, ease: 'power2.out', overwrite: true });
                } else {
                    gsap.set(item, { autoAlpha: isActive ? 1 : 0 });
                }
            });
        };

        const focusListeners = stories.map((story) => {
            const onFocus = () => activate(story.dataset.projectStory);
            story.addEventListener('focusin', onFocus);
            return () => story.removeEventListener('focusin', onFocus);
        });

        const mediaContext = gsap.matchMedia();
        mediaContext.add('(min-width: 1025px) and (min-height: 720px) and (prefers-reduced-motion: no-preference)', () => {
            root.dataset.enhanced = 'true';
            activate(stories[0].dataset.projectStory, false);
            const triggers = stories.map((story) => ScrollTrigger.create({
                trigger: story,
                start: 'top 58%',
                end: 'bottom 42%',
                onEnter: () => activate(story.dataset.projectStory),
                onEnterBack: () => activate(story.dataset.projectStory),
            }));

            const syncLocation = () => {
                const target = window.location.hash ? document.getElementById(window.location.hash.slice(1)) : null;
                if (target?.matches('[data-project-story]')) activate(target.dataset.projectStory, false);
            };
            window.addEventListener('hashchange', syncLocation);
            window.addEventListener('popstate', syncLocation);
            syncLocation();

            return () => {
                triggers.forEach((trigger) => trigger.kill());
                window.removeEventListener('hashchange', syncLocation);
                window.removeEventListener('popstate', syncLocation);
                delete root.dataset.enhanced;
                media.forEach((item) => gsap.set(item, { clearProps: 'opacity,visibility' }));
            };
        });

        cleanups.push(() => {
            focusListeners.forEach((cleanup) => cleanup());
            mediaContext.revert();
        });
    });

    return () => cleanups.forEach((cleanup) => cleanup());
}
