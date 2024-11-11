<template>
    <div class="flex items-center justify-center p-4 w-full h-[50rem]">
        <div class="p-5 border border-teal-600 rounded-lg">
            <form class="flex flex-col gap-3" @submit.prevent="submit">
                <Input
                    v-model="form.username"
                    id="username"
                    name="username"
                    label="Username: "
                />

                <Input
                    v-model="form.email"
                    id="email"
                    name="email"
                    type="email"
                    label="Email: "
                />

                <Input
                    v-model="form.password"
                    id="password"
                    name="password"
                    label="Password: "
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
import { router, usePage } from "@inertiajs/vue3";
import { reactive } from "vue";

import BlogLayout from "../../layouts/BlogLayout.vue";
import Input from "../../components/Input/Input.vue";

const page = usePage();

const form = reactive({
    username: null,
    email: null,
    password: null,
});

function submit() {
    router.post("/register", {
        _token: page.props.csrf_token,
        form,
    });
}

defineOptions({ layout: BlogLayout });
</script>
