<template>
    <admin-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Casts Edit
            </h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto">
                <section class="container mx-auto p-6 font-mono">
                    <div class="w-full flex mb-4 p-2">
                        <Link
                            :href="route('admin.casts.index')"
                            class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                            Cast Index
                        </Link>
                    </div>

                    <div class="w-full mb-8 p-6 sm:max-w-md overflow-hidden bg-white rounded-lg shadow-lg">
                        <form @submit.prevent="submitCast">
                            <div>
                                <InputLabel for="name" value="Name"/>
                                <TextInput
                                    id="name"
                                    v-model="form.name"
                                    autocomplete="name"
                                    autofocus
                                    class="mt-1 block w-full"
                                    required
                                    type="text"
                                />
                                <InputError :message="form.errors.name" class="mt-2 text-sm text-red-400"/>
                            </div>

                            <div class="mt-4">
                                <InputLabel for="poster_path" value="Poster"/>
                                <TextInput
                                    id="poster_path"
                                    v-model="form.poster_path"
                                    autocomplete="username"
                                    class="mt-1 block w-full"
                                    type="text"
                                />
                                <InputError :message="form.errors.poster_path" class="mt-2 text-sm text-red-400"/>
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
import { defineProps } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    cast: Object,
});

const form = useForm({
    name: props.cast.name,
    poster_path: props.cast.poster_path,
});

function submitCast() {
    form.put('/admin/casts/' + props.cast.id);
}
</script>
