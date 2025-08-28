<template>

    <Head>
        <title>Edit User</title>
    </Head>
    <h1 class="text-3xl">Edit User</h1>
    <form @submit.prevent="submit" class="max-w-md mx-auto mt-6">
        <div class="mb-6">
            <label for="name" class="block text-gray-700 mb-2 uppercase text-xs">Name</label>
            <input v-model="form.name" id="name" type="text" class="border border-gray-400 rounded px-2 py-1 w-full"
                name="name" />
            <p v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></p>
        </div>
        <div class="mb-6">
            <label for="email" class="block text-gray-700 mb-2 uppercase text-xs">Email</label>
            <input v-model="form.email" id="email" type="email" class="border border-gray-400 rounded px-2 py-1 w-full"
                name="email" />
            <p v-if="form.errors.email" v-text="form.errors.email" class="text-red-500 text-xs mt-1"></p>
        </div>
        <div class="mb-6">
            <label for="password" class="block text-gray-700 mb-2 uppercase text-xs">Password</label>
            <input v-model="form.password" id="password" type="password"
                class="border border-gray-400 rounded px-2 py-1 w-full" name="password" />
            <p v-if="form.errors.password" v-text="form.errors.password" class="text-red-500 text-xs mt-1"></p>
        </div>
        <div class="mb-6">
            <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-600"
                :disabled="form.processing">Update</button>
        </div>
    </form>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3'

// Assign props to a variable
const props = defineProps({
    user: Object
})

// Initialize form using props.user
const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: '',
})

// Submit handler using PUT
const submit = () => {
    form.put(`/users/${props.user.id}`)
}
</script>
