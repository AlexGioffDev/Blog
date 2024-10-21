<template>
    <div
        class="max-w-[62rem] h-[75vh] md:h-auto mx-auto grid md:grid-cols-3 gap-6 items-center px-4 overflow-y-auto"
    >
        <div class="md:col-span-2">
            <h1 class="text-3xl font-bold text-violet-600">{{ post.title }}</h1>
            <p class="text-xs text-violet-400 mb-4">
                By {{ post.user.username }} ({{ post.user.email }}) on
                {{ new Date(post.created_at).toLocaleDateString() }}
            </p>
            <img
                class="w-full h-auto rounded-lg mb-4 shadow-lg shadow-purple-800"
                :src="post.image_url"
                alt="post.title"
            />
            <div
                class="text-gray-800 mb-4 max-h-[15rem] overflow-auto font-mono text-justify"
            >
                <p>{{ post.body }}</p>
            </div>
        </div>
        <div
            class="border border-violet-800 rounded-lg p-4 max-h-[85vh] flex flex-col"
        >
            <div
                class="flex-1 overflow-y-auto flex flex-col gap-3 pb-5"
                v-if="post.comments.length > 0"
            >
                <div
                    class="flex flex-col"
                    v-for="comment in post.comments"
                    :key="comment.id"
                >
                    <div class="flex gap-x-4 items-center">
                        <div class="bg-violet-800 p-2 rounded-xl flex-1">
                            <p class="text-xs text-white font-mono">
                                {{ comment.body }}
                            </p>
                        </div>
                        <form
                            v-if="auth"
                            @submit.prevent="deleteComment(comment.id)"
                        >
                            <button
                                v-if="
                                    auth['user'] &&
                                    auth.user.id === comment.user.id
                                "
                                class="text-sm text-rose-700"
                            >
                                X
                            </button>
                        </form>
                    </div>
                    <p class="self-end text-sm text-violet-400">
                        by {{ comment.user.username }} on
                        {{ new Date(comment.created_at).toLocaleDateString() }}
                    </p>
                </div>
            </div>
            <div
                v-if="post.comments.length > 0"
                class="w-full h-1 bg-violet-900"
            />
            <div v-if="auth" class="mt-4 h-40">
                <form @submit.prevent="submit">
                    <textarea v-model="form.body"></textarea>
                    <button type="submit">Send</button>
                </form>
                <p v-if="errors['form.body']">
                    {{ errors }}
                </p>
            </div>
        </div>
    </div>
</template>

<script setup>
import BlogLayout from "../../layouts/BlogLayout.vue";
import { usePage, router } from "@inertiajs/vue3";
import { computed, reactive } from "vue";

defineOptions({ layout: BlogLayout });
const page = usePage();

const form = reactive({
    body: null,
});

function submit() {
    router.post("/comment", {
        _token: page.props.csrf_token,
        form,
        post_id: page.props.post.id,
        user_id: page.props.auth.user.id,
    });

    form.body = "";
}

function deleteComment(commentId) {
    router.delete(`/comment/${commentId}`, {
        _token: page.props.csrf_token,
    });
}

defineProps({
    post: {
        type: Object,
    },
    errors: {
        type: Object,
    },
    auth: {
        type: Object,
    },
});
</script>
