<template>
    <admin-layout title="Dashboard">
        <template #header>Movie Attach</template>

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
                        <div class="flex space-x-2">
                            <div v-for="trailer in trailers" :key="trailer.id">
                                <Link
                                    :href="route('admin.trailers.destroy', trailer.id)"
                                    as="button"
                                    class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded"
                                    method="delete"
                                    type="button">
                                    {{ trailer.name }}
                                </Link>
                            </div>
                        </div>
                        <form @submit.prevent="submitTrailer">
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
                                <InputLabel for="embed_html" value="Embed"/>
                                <textarea
                                    id="embed_html"
                                    v-model="form.embed_html"
                                    autocomplete="embed_html"
                                    class="mt-1 block w-full"
                                    type="text"
                                ></textarea>
                                <InputError :message="form.errors.embed_html" class="mt-2 text-sm text-red-400"/>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                    class="ml-4">
                                    Add Trailer
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>

                    <div class="w-full mb-8 p-6 sm:max-w-md bg-white rounded-lg shadow-lg">
                        <div>
                            <div class="flex">
                                <div
                                    v-for="mc in movieCasts"
                                    :key="mc.id"
                                    class="m-2 p-1 text-xs">
                                    {{ mc.name }}
                                </div>
                            </div>
                            <form @submit.prevent="addCast">
                                <VueMultiselect
                                    v-model="castForm.casts"
                                    :clear-on-select="false"
                                    :close-on-select="true"
                                    :multiple="true"
                                    :options="casts"
                                    :preserve-search="true"
                                    label="name"
                                    placeholder="Add Casts"
                                    track-by="name">
                                </VueMultiselect>
                                <div class="mt-2">
                                    <PrimaryButton>Add Casts</PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="w-full mb-8 p-6 sm:max-w-md bg-white rounded-lg shadow-lg">
                        <div>
                            <div class="flex">
                                <div
                                    v-for="mt in movieTags"
                                    :key="mt.id"
                                    class="m-2 p-1 text-xs">
                                    {{ mt.name }}
                                </div>
                            </div>
                            <form @submit.prevent="addTag">
                                <VueMultiselect
                                    v-model="tagForm.tags"
                                    :clear-on-select="false"
                                    :close-on-select="true"
                                    :multiple="true"
                                    :options="tags"
                                    :preserve-search="true"
                                    label="tag_name"
                                    placeholder="Add Tags"
                                    track-by="tag_name">
                                </VueMultiselect>
                                <div class="mt-2">
                                    <PrimaryButton>Add Tags</PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </admin-layout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import VueMultiselect from 'vue-multiselect';

const props = defineProps({
    movie: Object,
    trailers: Array,
    casts: Array,
    tags: Array,
    movieCasts: Array,
    movieTags: Array,
});

const form = useForm({
    name: '',
    embed_html: '',
});

const castForm = useForm({
    casts: props.movieCasts,
});

const tagForm = useForm({
    tags: props.movieTags,
});

function submitTrailer() {
    form.post(`/admin/movies/${props.movie.id}/add-trailer`, {
        onSuccess: () => form.reset(),
    });
}

function addCast() {
    castForm.post(`/admin/movies/${props.movie.id}/add-casts`, {
        preserveState: true,
        preserveScroll: true,
    });
}

function addTag() {
    tagForm.post(`/admin/movies/${props.movie.id}/add-tags`, {
        preserveState: true,
        preserveScroll: true,
    });
}
</script>
<style src="vue-multiselect/dist/vue-multiselect.css"></style>
