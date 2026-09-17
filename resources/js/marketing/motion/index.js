import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { initHomeReveals } from './home-reveals';
import { initWorkflowDemos } from './workflow-demo';

gsap.registerPlugin(ScrollTrigger);

export function initMarketingMotion() {
    const cleanups = [];

    try {
        cleanups.push(initHomeReveals(gsap, ScrollTrigger));
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
