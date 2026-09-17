import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { initHero } from './hero';
import { initProjectShowcase } from './project-showcase';
import { initWorkflowDemos } from './workflow-demo';

gsap.registerPlugin(ScrollTrigger);

export function initMarketingMotion() {
    const cleanups = [];

    try {
        cleanups.push(initHero(gsap));
        cleanups.push(initProjectShowcase(gsap, ScrollTrigger));
        cleanups.push(initWorkflowDemos());
    } catch (error) {
        document.querySelectorAll('[data-motion-ready], [data-enhanced]').forEach((element) => {
            delete element.dataset.motionReady;
            delete element.dataset.enhanced;
        });
        console.error('A marketinganimációk progresszív inicializálása sikertelen.', error);
    }

    return () => cleanups.filter(Boolean).forEach((cleanup) => cleanup());
}
