<template>
    <div class="mt-4 flex gap-2">
        <template v-for="(link, index) in links" :key="index">
            <Link v-if="link.url" :href="link.url" v-html="link.label" class="px-3 py-1 rounded text-sm" :class="{
                'bg-indigo-600 text-white pointer-events-none': link.active,
                'hover:underline text-indigo-600': !link.active
            }" />
            <span v-else v-html="link.label" class="px-3 py-1 rounded text-sm text-gray-500 cursor-not-allowed" />
        </template>
    </div>
</template>
<script>
export default {
    props: { links: Array },
}
</script>
