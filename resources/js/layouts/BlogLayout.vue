<template>
    <header
        class="w-full p-5 border-b-[0.5px] border-b-gray-100 flex justify-between items-center"
    >
        <a href="/">Byte Bistro</a>

        <div v-if="!user" class="flex gap-3">
            <a href="/register">Register</a>
            <a href="/login">Login</a>
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
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const user = computed(() => page.props.auth.user);
</script>
