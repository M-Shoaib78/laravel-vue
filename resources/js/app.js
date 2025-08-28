import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/vue3'
import Layout from './shared/Layout.vue'  // Your default layout component
import '../css/app.css'                   // Make sure Tailwind CSS is loaded

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`]


        // Ensure the default layout is applied if none is specified
        if (page.default.layout === undefined) {
            page.default.layout = Layout
        }

        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component('Link', Link)  // Register Inertia's Link globally
            .component('Head', Head)  // Register Inertia's Head for meta tags
            .mount(el)
    },
    title: title => "My App-" + title,
})
