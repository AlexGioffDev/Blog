<template>
    <div
        class="mx-auto w-[50rem] border border-cyan-700 rounded-lg flex flex-col p-4 gap-y-3 items-center"
    >
        <h2 class="uppercase font-bold text-3xl text-cyan-800">
            Create A New Post
        </h2>
        <form class="flex flex-col gap-y-4" @submit.prevent="createPost">
            <div class="flex gap-x-4 items-center justify-center">
                <label for="title" class="font-semibold uppercase">Title</label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    placeholder="Title of the post"
                    required
                    class="rounded-lg p-2 focus:outline-none text-black"
                    v-model="form.title"
                />
            </div>
            <div class="flex gap-x-4 items-center justify-center">
                <label for="image_url" class="font-semibold uppercase"
                    >Image</label
                >
                <input
                    type="text"
                    name="image_url"
                    id="image_url"
                    placeholder="https://picsum.photos/seed/800/640/480"
                    required
                    class="rounded-lg p-2 focus:outlin-none text-black"
                    v-model="form.image_url"
                />
            </div>
            <div class="flex flex-col gap-y-4 items-center justify-center">
                <label for="body" class="font-semibold uppercase">Body</label>
                <textarea
                    class="border-2 border-cyan-900 rounded-lg p-4 resize-none w-full min-h-32 max-h-32 focus:outline-none"
                    required
                    v-model="form.body"
                ></textarea>
            </div>
            <button
                class="bg-cyan-900 rounded-xl uppercase font-bold text-white"
                type="submit"
            >
                Submit
            </button>
        </form>
    </div>
</template>

<script setup>
import { router, usePage } from "@inertiajs/vue3";
import { reactive } from "vue";

const page = usePage();

const form = reactive({
    title: null,
    image_url: null,
    body: null,
});

function createPost() {
    router.post("/dashoboard/post/create", {
        _token: page.props.csrf_token,
        form,
    });
}

import AdminLayout from "../../layouts/AdminLayout.vue";

defineOptions({ layout: AdminLayout });
</script>
