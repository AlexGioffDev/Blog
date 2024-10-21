<template>
    <div class="flex items-center justify-center p-4 w-full h-[50rem]">
        <div class="p-5 border border-teal-600 rounded-lg">
            <form class="flex flex-col gap-3" @submit.prevent="submit">
                <div class="flex items-center justify-between gap-3">
                    <label for="email">Email: </label>
                    <input
                        class="border border-teal-700 py-1 px-4 rounded-lg"
                        id="email"
                        name="email"
                        type="email"
                        required
                        v-model="form.email"
                    />
                </div>

                <div class="flex items-center justify-between gap-3">
                    <label for="password">Password: </label>
                    <input
                        class="border border-teal-700 py-1 px-4 rounded-lg"
                        id="password"
                        name="password"
                        type="password"
                        required
                        v-model="form.password"
                    />
                </div>

                <button
                    type="submit"
                    class="bg-teal-700 rounded-lg p-2 text-white mt-8"
                >
                    Submit
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import BlogLayout from "../../layouts/BlogLayout.vue";
import { router, usePage } from "@inertiajs/vue3";
import { reactive } from "vue";

const page = usePage();

const form = reactive({
    email: null,
    password: null,
});

function submit() {
    router.post("/login", {
        _token: page.props.csrf_token,
        form,
    });
}

defineOptions({ layout: BlogLayout });
</script>
