<template>
    <div class="flex items-center justify-center p-4 w-full h-[50rem]">
        <div class="p-5 border border-teal-600 rounded-lg">
            <form class="flex flex-col gap-3" @submit.prevent="submit">
                <Input
                    label="Email: "
                    id="email"
                    name="email"
                    v-model="form.email"
                    type="email"
                />

                <Input
                    label="Password: "
                    id="password"
                    name="password"
                    v-model="form.password"
                    type="password"
                />

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
import Input from "../../components/Input/Input.vue";

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
