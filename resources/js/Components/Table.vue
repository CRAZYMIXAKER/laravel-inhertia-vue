<template>
    <table class="w-full">
        <thead>
        <tr
            class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <slot name="tableHead"/>
        </tr>
        </thead>
        <tbody class="bg-white">
            <slot/>
        </tbody>
    </table>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
