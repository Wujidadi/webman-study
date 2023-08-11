import './bootstrap';

import components from './components';

createApp({
    data() {
        return {
            date: '2023-08-11',
        };
    },
    components,
})
    .use(createPinia())
    // .use(router)
    // .use(i18n)
    .mount('#app');
