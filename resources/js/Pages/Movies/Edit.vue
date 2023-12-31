<template>
    <admin-layout title="Dashboard">
        <template #header>Movie Edit</template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto">
                <section class="container mx-auto p-6 font-mono">
                    <div class="w-full flex mb-4 p-2">
                        <Link
                            :href="route('admin.movies.index')"
                            class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                            Movie Index
                        </Link>
                    </div>

                    <div class="w-full mb-8 p-6 sm:max-w-md overflow-hidden bg-white rounded-lg shadow-lg">
                        <form @submit.prevent="submitMovie">
                            <div>
                                <InputLabel for="title" value="Title"/>
                                <TextInput
                                    id="title"
                                    v-model="form.title"
                                    autocomplete="title"
                                    autofocus
                                    class="mt-1 block w-full"
                                    required
                                    type="text"/>
                                <InputError :message="form.errors.title" class="mt-2 text-sm text-red-400"/>
                            </div>
                            <div>
                                <InputLabel for="runtime" value="Runtime"/>
                                <TextInput
                                    id="runtime"
                                    v-model="form.runtime"
                                    autocomplete="runtime"
                                    autofocus
                                    class="mt-1 block w-full"
                                    required
                                    type="text"/>
                                <InputError :message="form.errors.runtime" class="mt-2 text-sm text-red-400"/>
                            </div>

                            <div>
                                <InputLabel for="lang" value="Language"/>
                                <TextInput
                                    id="lang"
                                    v-model="form.lang"
                                    autocomplete="lang"
                                    autofocus
                                    class="mt-1 block w-full"
                                    required
                                    type="text"/>
                                <InputError :message="form.errors.lang" class="mt-2 text-sm text-red-400"/>
                            </div>

                            <div>
                                <InputLabel for="video_format" value="Format"/>
                                <TextInput
                                    id="video_format"
                                    v-model="form.video_format"
                                    autocomplete="video_format"
                                    autofocus
                                    class="mt-1 block w-full"
                                    required
                                    type="text"/>
                                <InputError :message="form.errors.video_format" class="mt-2 text-sm text-red-400"/>
                            </div>

                            <div>
                                <InputLabel for="rating" value="Rating"/>
                                <TextInput
                                    id="rating"
                                    v-model="form.rating"
                                    autocomplete="rating"
                                    autofocus
                                    class="mt-1 block w-full"
                                    required
                                    type="text"/>
                                <InputError :message="form.errors.rating" class="mt-2 text-sm text-red-400"/>
                            </div>

                            <div class="mt-4">
                                <InputLabel for="poster_path" value="Poster"/>
                                <TextInput
                                    id="poster_path"
                                    v-model="form.poster_path"
                                    autocomplete="poster_path"
                                    class="mt-1 block w-full"
                                    type="text"/>
                                <InputError :message="form.errors.poster_path" class="mt-2 text-sm text-red-400"/>
                            </div>

                            <div class="mt-4">
                                <InputLabel for="backdrop_path" value="Backdrop"/>
                                <TextInput
                                    id="backdrop_path"
                                    v-model="form.backdrop_path"
                                    autocomplete="backdrop_path"
                                    class="mt-1 block w-full"
                                    type="text"/>
                                <InputError :message="form.errors.backdrop_path" class="mt-2 text-sm text-red-400"/>
                            </div>

                            <div class="mt-4">
                                <InputLabel for="overview" value="Overview"/>
                                <TextInput
                                    id="overview"
                                    v-model="form.overview"
                                    autocomplete="overview"
                                    class="mt-1 block w-full"
                                    type="text"/>
                                <InputError :message="form.errors.overview" class="mt-2 text-sm text-red-400"/>
                            </div>

                            <div class="mt-4">
                                <InputLabel for="is_public" value="IsPublic"/>
                                <Checkbox
                                    id="is_public"
                                    name="is_public"
                                    v-model:checked="form.is_public"/>
                                <InputError :message="form.errors.is_public" class="mt-2 text-sm text-red-400"/>
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
import Checkbox from '@/Components/Checkbox.vue';

const props = defineProps({
    movie: Object,
});

const form = useForm({
    title: props.movie.title,
    poster_path: props.movie.poster_path,
    video_format: props.movie.video_format,
    runtime: props.movie.runtime,
    rating: props.movie.rating,
    backdrop_path: props.movie.backdrop_path,
    overview: props.movie.overview,
    is_public: !!props.movie.is_public,
    lang: props.movie.lang,
});

function submitMovie() {
    form.put('/admin/movies/' + props.movie.id);
}
</script>
