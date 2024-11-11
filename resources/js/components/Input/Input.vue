<template>
    <div class="flex items-center justify-between gap-3">
        <label :for="id">{{ label }}</label>
        <input
            :id="id"
            :name="name"
            :type="type"
            :required="required"
            class="border border-teal-700 py-1 px-4 rounded-lg"
            v-model="internalValue"
        />
    </div>
</template>

<script setup>
import { computed, toRefs } from "vue";

const props = defineProps({
    modelValue: {
        tpye: [String, Number],
        required: true,
    },
    id: {
        type: String,
        required: true,
    },
    name: {
        type: String,
        required: true,
    },
    label: {
        type: String,
        required: true,
    },
    type: {
        type: String,
        default: "text",
    },
    required: {
        type: Boolean,
        default: true,
    },
});

const { modelValue } = toRefs(props);
const internalValue = computed({
    get: () => modelValue.value,
    set: (value) => {
        emit("update:modelValue", value);
    },
});

const emit = defineEmits(["update:modelValue"]);
</script>
