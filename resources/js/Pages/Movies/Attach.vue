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
                                    class="px-4 py-2 bg-red-500 hover:bg-red-700 rounded"
                                    method="delete"
                                    as="button"
                                    type="button"
                                    :href="route('admin.trailers.destroy', trailer.id)">
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
                                    Update
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>

                    <div class="w-full mb-8 p-6 sm:max-w-md overflow-hidden bg-white rounded-lg shadow-lg">
                        Cast form
                    </div>

                    <div class="w-full mb-8 p-6 sm:max-w-md overflow-hidden bg-white rounded-lg shadow-lg">
                        Tag form
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

const props = defineProps({
    movie: Object,
    trailers: Array,
});

const form = useForm({
    name: '',
    embed_html: '',
});

function submitTrailer() {
    form.post(`/admin/movies/${props.movie.id}/add-trailer`, {
        onSuccess: ()=> form.reset()
    });
}
</script>
