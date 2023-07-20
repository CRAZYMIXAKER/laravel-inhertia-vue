<template>
    <admin-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Movies Index
            </h2>
        </template>

        <div class="py-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <section class="container mx-auto p-6 font-mono">
                    <div class="w-full flex mb-4 p-2 justify-end">
                        <form class="flex space-x-4 shadow bg-white rounded-md m-2 p-2">
                            <div class="p-1 flex items-center">
                                <label class="block text-sm font-medium text-gray-700 mr-4" for="tmdb_id_g">
                                    Movie Tmdb Id
                                </label>
                                <div class="relative rounded-md shadow-sm">
                                    <input
                                        id="tmdb_id_g"
                                        v-model="movieTMDBId"
                                        class="px-3 py-2 border border-gray-300 rounded"
                                        name="tmdb_id_g"
                                        placeholder="Movie ID"/>
                                </div>
                            </div>
                            <div class="p-1">
                                <button
                                    class="inline-flex items-center justify-center py-2 px-4 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-green-700 transition duration-150 ease-in-out disabled:opacity-50"
                                    type="button"
                                    @click="generateMovie">
                                    <svg
                                        v-if="showSpinner"
                                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none"
                                        viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <circle
                                            class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4">
                                        </circle>
                                        <path
                                            class="opacity-75"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                            fill="currentColor">
                                        </path>
                                    </svg>
                                    <span>Generate</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="w-full mb-8 overflow-hidden bg-white rounded-lg shadow-lg">
                        <div class="p-2 m-2">
                            <div class="flex justify-between">
                                <div class="flex-1 mr-3">
                                    <div class="relative">
                                        <div class="absolute flex items-center ml-2 h-full">
                                            <svg class="w-4 h-4 fill-current text-primary-gray-dark" fill="none"
                                                 viewBox="0 0 16 16"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M15.8898 15.0493L11.8588 11.0182C11.7869 10.9463 11.6932 10.9088 11.5932 10.9088H11.2713C12.3431 9.74952 12.9994 8.20272 12.9994 6.49968C12.9994 2.90923 10.0901 0 6.49968 0C2.90923 0 0 2.90923 0 6.49968C0 10.0901 2.90923 12.9994 6.49968 12.9994C8.20272 12.9994 9.74952 12.3431 10.9088 11.2744V11.5932C10.9088 11.6932 10.9495 11.7869 11.0182 11.8588L15.0493 15.8898C15.1961 16.0367 15.4336 16.0367 15.5805 15.8898L15.8898 15.5805C16.0367 15.4336 16.0367 15.1961 15.8898 15.0493ZM6.49968 11.9994C3.45921 11.9994 0.999951 9.54016 0.999951 6.49968C0.999951 3.45921 3.45921 0.999951 6.49968 0.999951C9.54016 0.999951 11.9994 3.45921 11.9994 6.49968C11.9994 9.54016 9.54016 11.9994 6.49968 11.9994Z">
                                                </path>
                                            </svg>
                                        </div>

                                        <input
                                            v-model="movieFilters.search"
                                            class="px-8 py-3 w-full md:w-2/6 rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm"
                                            placeholder="Search by title"
                                            type="text"/>
                                    </div>
                                </div>
                                <div class="flex">
                                    <select
                                        v-model="movieFilters.perPage"
                                        class="px-4 py-3 w-full rounded-md bg-gray-100 border-transparent focus:border-gray-500 focus:bg-white focus:ring-0 text-sm"
                                        @change="movieFilters.perPage === $event.target.value">
                                        <option :selected="movieFilters.perPage === 5" value="5">5 Per Page</option>
                                        <option :selected="movieFilters.perPage === 10" value="10">10 Per Page</option>
                                        <option :selected="movieFilters.perPage === 15" value="15">15 Per Page</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="w-full overflow-x-auto">
                            <Table>
                                <template #tableHead>
                                    <TableHead class="cursor-pointer" @click="sort('title')">
                                        <div class="flex space-x-4 content-center">
                                            <span>Title</span>
                                            <svg
                                                v-if="movieFilters.column === 'title' && movieFilters.direction === 'desc'"
                                                class="h-5 w-5 text-indigo-700"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17 13l-5 5m0 0l-5-5m5 5V6"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"/>
                                            </svg>

                                            <svg
                                                v-if="movieFilters.column === 'title' && movieFilters.direction === 'asc'"
                                                class="h-5 w-5 text-indigo-700"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 11l5-5m0 0l5 5m-5-5v12"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"/>
                                            </svg>
                                        </div>
                                    </TableHead>
                                    <TableHead class="cursor-pointer" @click="sort('rating')">
                                        <div class="flex space-x-4 content-center">
                                            <span>Rating</span>
                                            <svg
                                                v-if="movieFilters.column === 'rating' && movieFilters.direction === 'desc'"
                                                class="h-5 w-5 text-indigo-700"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17 13l-5 5m0 0l-5-5m5 5V6"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"/>
                                            </svg>
                                            <svg
                                                v-if="movieFilters.column === 'rating' && movieFilters.direction === 'asc'"
                                                class="h-5 w-5 text-indigo-700"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 11l5-5m0 0l5 5m-5-5v12"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"/>
                                            </svg>
                                        </div>
                                    </TableHead>
                                    <TableHead class="cursor-pointer  space-x-2" @click="sort('visits')">
                                        <div class="flex space-x-4 content-center">
                                            <span>Visits</span>
                                            <svg
                                                v-if="movieFilters.column === 'visits' && movieFilters.direction === 'desc'"
                                                class="h-5 w-5 text-indigo-700"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17 13l-5 5m0 0l-5-5m5 5V6"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"/>
                                            </svg>
                                            <svg
                                                v-if="movieFilters.column === 'visits' && movieFilters.direction === 'asc'"
                                                class="h-5 w-5 text-indigo-700" fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 11l5-5m0 0l5 5m-5-5v12"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"/>
                                            </svg>
                                        </div>
                                    </TableHead>
                                    <TableHead>Poster</TableHead>
                                    <TableHead>Public</TableHead>
                                    <TableHead>Manage</TableHead>
                                </template>
                                <TableRow v-for="movie in movies.data" :key="movie.id">
                                    <TableData>{{ movie.title }}</TableData>
                                    <TableData>{{ movie.rating }}</TableData>
                                    <TableData>{{ movie.visits }}</TableData>
                                    <TableData>
                                        <img
                                            :src="`https://www.themoviedb.org/t/p/w220_and_h330_face/${ movie.poster_path }`"
                                            class="h-12 w-12 rounded">
                                    </TableData>
                                    <TableData>
                                        <span
                                            v-if="movie.is_public"
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Published
                                        </span>
                                        <span
                                            v-else
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Unpublished
                                        </span>
                                    </TableData>
                                    <TableData>
                                        <div class="flex space-x-2">
                                            <ButtonLink :link="route('admin.movies.attach', movie.id)">
                                                Attach
                                            </ButtonLink>
                                            <ButtonLink :link="route('admin.movies.edit', movie.id)">Edit</ButtonLink>
                                            <ButtonLink
                                                :link="route('admin.movies.destroy', movie.id)"
                                                as="button"
                                                class="bg-red-500 hover:bg-red-700"
                                                method="delete"
                                                type="button">
                                                Delete
                                            </ButtonLink>
                                        </div>
                                    </TableData>
                                </TableRow>
                            </Table>
                            <div v-if="movies?.data.length > 0" class="m-2 p-2">
                                <Pagination :links="movies.links"/>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </admin-layout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { router } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import { reactive, ref, watch } from 'vue';
import Table from '@/Components/Table.vue';
import TableHead from '@/Components/TableHead.vue';
import TableRow from '@/Components/TableRow.vue';
import TableData from '@/Components/TableData.vue';
import ButtonLink from '@/Components/ButtonLink.vue';
import { pickBy, throttle } from 'lodash';

const props = defineProps({
    movies: Object,
    filters: Object,
});

const movieFilters = reactive({
    search: props.filters.search,
    perPage: props.filters.perPage ?? 5,
    column: props.filters.column,
    direction: props.filters.direction,
});
const showSpinner = ref(false);
const movieTMDBId = ref('');

watch(movieFilters, throttle(() => {
        let query = pickBy(movieFilters);
        let queryRoute = route('admin.movies.index', Object.keys(query).length ? query : {
            remember: 'forget',
        });
        router.get(queryRoute, {}, {
            preserveState: true,
            replace: true,
        });
    }, 500),
    {
        deep: true,
    });

function sort(column) {
    movieFilters.column = column;
    movieFilters.direction = movieFilters.direction === 'asc' ? 'desc' : 'asc';
}

function generateMovie() {
    router.post('/admin/movies', {
        'movieTMDBId': movieTMDBId.value,
    }, {
        onStart: () => showSpinner.value = true,
        onFinish: () => {
            movieTMDBId.value = '';
            showSpinner.value = false;
        },
    });
}
</script>
