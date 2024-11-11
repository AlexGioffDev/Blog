<template>
    <header
        class="w-full p-5 border-b-[0.5px] border-b-gray-100 flex justify-between items-center"
    >
        <a href="/">Byte Bistro</a>

        <div v-if="!user" class="flex gap-3">
            <a href="/register">Register</a>
            <a href="/login">Login</a>
        </div>
        <div class="flex gap-x-4 items-center" v-else>
            <p class="text-md">
                Hello,
                <span class="italic text-purple-700 capitalize">{{
                    user.username
                }}</span>
            </p>
            <a v-if="user['role'] == 'ADMIN'" href="/dashboard">Dashboard</a>
            <form @submit.prevent="submit">
                <button
                    class="bg-white rounded-xl py-1 px-2 text-purple-900 border border-purple-900 hover:text-white hover:bg-purple-900 transition-all duration-300 cursor-pointer"
                    type="submit"
                    href="/logout"
                >
                    Logout
                </button>
            </form>
        </div>
    </header>
    <main class="max-w-7xl mx-auto mt-5">
        <slot />
    </main>

    <footer class="fixed bottom-0 w-full">
        <p>&copy; {{ new Date().getFullYear() }} Byte Bistro</p>
    </footer>
</template>

<script setup>
import { computed } from "vue";
import { router, usePage } from "@inertiajs/vue3";

const page = usePage();

function submit() {
    router.post("/logout", {
        _token: page.props.csrf_token,
    });
}

const user = computed(() => page.props.auth.user);
</script>
