<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    type: {
        type: String,
        default: "submit",
    },
    href: {
        type: String,
        default: "",
    },
});

const classes =
    "inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150";
</script>

<template>
    <Link v-if="href"
          :href="href"
          :class="classes">
    <slot />
    </Link>
    <button v-else
            :type="type"
            :class="classes">
        <slot />
    </button>
</template>
