<template>
    <section class="flex flex-col gap-y-4">
        <div
            class="flex justify-between py-2 items-center border-b border-cyan-700"
        >
            <h2 class="text-3xl uppercase font-bold text-cyan-900">Posts</h2>
            <a
                href="/dashboard/create"
                class="bg-violet-700 uppercase font-bold text-slate-200 text-sm p-2 rounded-xl"
            >
                New Post</a
            >
        </div>
        <div class="max-h-80 overflow-y-auto flex flex-col py-8">
            <div
                class="flex items-center text-sm justify-between even:bg-cyan-700 even:text-white p-8 border border-cyan-700 first:rounded-t-lg last:rounded-b-lg"
                v-for="post in posts"
            >
                <p class="font-bold">{{ post.title }}</p>
                <div class="flex gap-x-4">
                    <div v-if="isAdmin">
                        <form @submit.prevent="deletePost(post)">
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section v-if="isAdmin" class="flex flex-col gap-y-4">
        <h2
            class="border-b py-2 border-cyan-700 text-3xl uppercase font-bold text-cyan-900"
        >
            Users
        </h2>
        <div class="max-h-80 overflow-y-auto flex flex-col py-8">
            <div
                class="flex items-center text-sm justify-between even:bg-cyan-700 even:text-white p-8 border border-cyan-700 first:rounded-t-lg last:rounded-b-lg"
                v-for="user in users"
            >
                <p class="font-bold">{{ user.username }}</p>
                <div class="flex gap-3">
                    <div
                        v-if="
                            auth.user.username != user.username &&
                            user.role != 'ADMIN'
                        "
                    >
                        <form>
                            <select
                                class="text-slate-800 rounded-lg px-2 py-1 border border-violet-900"
                                v-model="user.role"
                                :disabled="user.role == 'ADMIN'"
                                @change="updateUserRole(user)"
                            >
                                <option value="ADMIN">ADMIN</option>
                                <option value="MOD">MOD</option>
                                <option value="USER">USER</option>
                            </select>
                        </form>
                    </div>
                    <div
                        v-if="
                            isAdmin &&
                            auth.user.username != user.username &&
                            user.role != 'ADMIN'
                        "
                    >
                        <form @submit.prevent="deleteUser(user)">
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import AdminLayout from "../../layouts/AdminLayout.vue";
import { usePage, router } from "@inertiajs/vue3";

const page = usePage();

function deletePost(post) {
    router.delete(`/posts/${post.id}`, {
        _token: page.props.csrf_token,
    });
}

function updateUserRole(user) {
    router.put(`/dashboard/user/${user.id}/role`, {
        role: user.role,
        _token: page.props.csrf_token,
    });
}

function deleteUser(user) {
    router.delete(`/dashboard/user/${user.id}`, {
        _token: page.props.csrf_token,
    });
}

defineOptions({ layout: AdminLayout });

defineProps({
    posts: {
        type: [Object, Array],
    },
    users: {
        type: [Object, Array],
    },
    auth: {
        type: Object,
    },
    isAdmin: {
        type: Boolean,
        deafult: false,
    },
});
</script>
