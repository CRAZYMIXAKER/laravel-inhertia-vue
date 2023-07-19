<template>
    <admin-layout title="Dashboard">
        <template #header>
            Genre Edit
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto">
                <section class="container mx-auto p-6 font-mono">
                    <div class="w-full flex mb-4 p-2">
                        <Link
                            :href="route('admin.genres.index')"
                            class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                            genre Index
                        </Link>
                    </div>

                    <div class="w-full mb-8 p-6 sm:max-w-md overflow-hidden bg-white rounded-lg shadow-lg">
                        <form @submit.prevent="submitGenre">
                            <div>
                                <InputLabel for="title" value="Title"/>
                                <TextInput
                                    id="name"
                                    v-model="form.title"
                                    autocomplete="title"
                                    autofocus
                                    class="mt-1 block w-full"
                                    required
                                    type="text"
                                />
                                <InputError :message="form.errors.title" class="mt-2 text-sm text-red-400"/>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                    class="ml-4">
                                    Update
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </admin-layout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    genre: Object,
});

const form = useForm({
    title: props.genre.title,
});

function submitGenre() {
    form.put('/admin/genres/' + props.genre.id);
}
</script>
