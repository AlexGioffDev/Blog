<template>
    <div class="flex items-center justify-center p-4 w-full h-[50rem]">
        <div class="p-5 border border-teal-600 rounded-lg">
            <form class="flex flex-col gap-3" @submit.prevent="submit">
                <div v-if="errors.length" class="text-red-500">
                    <ul>
                        <li v-for="(error, index) in errors" :key="index">
                            {{ error }}
                        </li>
                    </ul>
                </div>
                <div class="flex items-center justify-between gap-3">
                    <label for="username">Username: </label>
                    <input
                        class="border border-teal-700 py-1 px-4 rounded-lg"
                        id="username"
                        name="username"
                        type="text"
                        required
                        v-model="form.username"
                    />
                </div>
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
import { reactive, ref } from "vue";

const page = usePage();

const form = reactive({
    username: null,
    email: null,
    password: null,
});

const errors = ref([]);

function submit() {
    errors.value = [];
    router
        .post("/register", {
            _token: page.props.csrf_token,
            form,
        })
        .then(() => {
            console.log("Success");
        })
        .catch((error) => {
            if (error.response && error.response.status === 422) {
                errors.value = Object.values(error.response.data.errors).flat();
            }
        });
}

defineOptions({ layout: BlogLayout });
</script>
