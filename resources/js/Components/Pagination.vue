<template>
    <div class="flex">
        <template v-for="(link, key) in links" :key="key">
            <div
                v-if="link.url === null"
                class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded"
                v-html="link.label">

            </div>
            <Link
                v-else
                :class="{'bg-indigo-200': link.active}"
                :href="link.url"
                class="mr-1 mr-1 px-4 py-3 text-sm leading-4 border rounded focus:text-indigo-500 focus:border-indigo-500 hover:bg-white"
                v-html="link.label"/>
        </template>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

defineProps({
    links: Array,
});
</script>

<style lang="scss" scoped>

</style>
