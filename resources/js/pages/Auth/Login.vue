<template>

    <Head>
        <title>Login</title>
    </Head>
    <main class="grid place-items-center min-h-screen">
        <section class="bg-white rounded-xl mx-auto mt-6 border p-6" style="width: 30%;">
            <h1 class="text-3xl mb-4">Login</h1>
            <form @submit.prevent="submit">
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 mb-2 uppercase text-xs">Email</label>
                    <input v-model="form.email" id="email" type="email"
                        class="border border-gray-400 rounded px-2 py-1 w-full" name="email" />
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
                        :disabled="form.processing">Login</button>
                </div>
            </form>
        </section>
    </main>

</template>
<script>
export default {
    layout: null
}
</script>
<script setup>
import { useForm } from '@inertiajs/vue3';

let form = useForm({
    'email': '',
    'password': ''
})

let submit = () => {
    form.post('/login');

}
</script>
