<template>
    <div
        class="border rounded-full py-1 px-2 text-white inline-block"
        :class="[bgColor]"
    >
        <slot />
    </div>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    label: {
        type: String,
        default: "user",
    },
});

const bgColor = computed(() => {
    switch (props.label) {
        case "user":
            return "bg-violet-800";
        case "comments":
            return "bg-rose-800";
        default:
            return "bg-violet-500";
    }
});
</script>
