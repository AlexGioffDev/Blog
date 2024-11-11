<template>
    <div class="border border-gray-800 flex flex-col gap-5 rounded-md">
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
                        <span class="text-xs">{{ post.user.username }}</span>
                    </TagContainer>
                    on
                    {{ format(new Date(post.created_at), "MMMM dd, yyyy") }}
                </p>

                <TagContainer label="comments" v-if="post.comments_count > 0">
                    <p class="text-sm flex gap-2 items-center">
                        <CommentIcon />
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
</template>

<script setup>
import TagContainer from "../TagContainer/TagContainer.vue";
import CommentIcon from "../Icon/CommentIcon.vue";
import { format } from "date-fns";

defineProps({
    post: {
        type: Object,
        required: true,
    },
});
</script>
