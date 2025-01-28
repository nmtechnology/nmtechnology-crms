<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="block w-full px-4 py-2 text-start text-sm leading-5 bg-gray-700 text-accent transition duration-150 ease-in-out hover:bg-gray-600 focus:bg-accent focus:text-white focus:outline-none"
    >
        <slot />
    </Link>
</template>
