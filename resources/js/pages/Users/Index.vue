<template>

    <Head>
        <title>Users</title>
        <meta name="description" content="user info" head-key="description" />
    </Head>
    <div class="flex justify-between mb-3">
        <div class="flex items-center">
            <h1 class="text-2xl">Users</h1>
            <Link v-if="can.createUser" href="/users/create" class="text-blue-500 text-sm ml-3">Add New User</Link>
        </div>
        <input v-model="search" type="text" name="search" id="search" placeholder="Search..."
            class="px-2 py-1 border rounded-xl">
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700">Email</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                <tr v-for="user in users.data" :key="user.id">
                    <td class="px-6 py-4 text-sm text-gray-900">{{ user.name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        <Link :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
                        Edit
                        </Link>
                        <Link :href="`/users/${user.id}/`" method="delete"
                            class="text-indigo-600 hover:text-indigo-900">
                        Delete
                        </Link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- pagination -->
    <Pagination :links="users.links" />
</template>
<script setup>
import { ref, watch } from 'vue';
import Pagination from '../../shared/Pagination.vue';
import { router } from '@inertiajs/vue3';
// import { throttle } from 'lodash';//calls after every time set period
import { debounce } from 'lodash'; //after set time it calls once when typing completes
debounce
let props = defineProps({
    users: Object,
    auth: Object,
    errors: Object,
    filters: Object,
    can: Object,
});

let search = ref(props.filters.search);
watch(search, debounce(function (value) {

    router.get("/users",
        { search: value },
        {
            preserveState: true,
            preserveScroll: true,
            replace: true,
            only: ['users'], // only fetch users prop
        });
}, 500)

);
</script>
