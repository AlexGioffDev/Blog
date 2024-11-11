<template>
    <header
        class="w-full p-5 flex justify-between items-center bg-cyan-700 text-white"
    >
        <a href="/">Byte Bistro</a>
        <div class="flex gap-x-4 items-center">
            <form @submit.prevent="submit">
                <button type="submit" href="/logout">Logout</button>
            </form>
        </div>
    </header>
    <div class="bg-slate-200 h-screen">
        <main class="max-w-7xl mx-auto pt-8 max-h-[80%] overflow-auto">
            <slot />
        </main>
    </div>
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
