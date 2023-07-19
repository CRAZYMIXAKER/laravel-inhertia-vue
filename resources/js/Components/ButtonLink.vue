<template>
    <Link
        :href="link"
        class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
        <slot/>
    </Link>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    link: {
        type: String,
        required: true,
    },
});
</script>
