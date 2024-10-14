<template>
    <Pagination class="mt-4 px-8" :links="posts.links" />

    <div
        class="mt-4 grid md:grid-cols-3 gap-16 max-h-[75vh] overflow-y-auto p-5"
    >
        <div
            class="border border-gray-800 flex flex-col gap-5 rounded-md"
            v-for="post in posts.data"
            :key="post.id"
        >
            <img
                class="h-60 w-full object-cover rounded-t-md overflow-hidden"
                :src="post.image_url"
                alt="post.title"
            />
            <div class="p-2 grid grid-cols-1 gap-3">
                <div class="flex justify-between items-center">
                    <p class="text-xs text-gray-600">
                        By
                        <TagContainer>
                            <span class="text-xs">{{
                                post.user.username
                            }}</span>
                        </TagContainer>
                        on
                        {{ format(new Date(post.created_at), "MMMM dd, yyyy") }}
                    </p>

                    <TagContainer
                        label="comments"
                        v-if="post.comments_count > 0"
                    >
                        <p class="text-sm flex gap-2 items-center">
                            <svg
                                class="h-5 w-5"
                                width="12"
                                height="12"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path
                                    d="M12 20l-3 -3h-2a3 3 0 0 1 -3 -3v-6a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-2l-3 3"
                                />
                                <line x1="8" y1="9" x2="16" y2="9" />
                                <line x1="8" y1="13" x2="14" y2="13" />
                            </svg>
                            {{ post.comments_count }}
                        </p>
                    </TagContainer>
                </div>
                <p class="uppercase font-bold text-lg">{{ post.title }}</p>
                <p class="font-mono font-light text-xs text-gray-700">
                    {{ post.body.slice(0, 130) }}...
                </p>

                <a
                    :href="`/posts/${post.id}`"
                    class="text-[10px] font-mono text-blue-500 cursor-pointer w-[82px]"
                >
                    Read more ->
                </a>
            </div>
        </div>
    </div>
</template>

<script setup>
import Pagination from "../../components/Pagination.vue";
import BlogLayout from "../../layouts/BlogLayout.vue";
import TagContainer from "../../components/TagContainer.vue";
import { format } from "date-fns";

defineOptions({ layout: BlogLayout });

defineProps({
    posts: {
        type: [Object, Array],
    },
});
</script>
