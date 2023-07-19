<template>
    <admin-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tags Edit
            </h2>
        </template>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full flex mb-4 p-2">
                <Link
                    :href="route('admin.tags.index')"
                    class="px-4 py-2 bg-green-600 hover:bg-green-800 text-white rounded">
                    Tag Index
                </Link>
            </div>
            <section class="flex content-center">
                <form @submit.prevent="updateTag">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="w-fill space-y-1">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700" for="first-name">Tag
                                        name</label>
                                    <input
                                        v-model="form.tagName"
                                        autocomplete="given-name"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        type="text"/>
                                </div>
                                <div>
                                    <button class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white rounded"
                                            type="submit">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </admin-layout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    tag: Object,
});

const form = useForm({
    tagName: props.tag.tag_name,
});

function updateTag() {
    form.put('/admin/tags/' + props.tag.id);
}
</script>
