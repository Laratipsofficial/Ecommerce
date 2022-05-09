<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    type: {
        type: String,
        default: "submit",
    },
    href: {
        type: String,
        default: "",
    },
    color: {
        type: String,
        default: "black",
    },
});

const colorClasses = computed(() => {
    return {
        black: "bg-gray-800 hover:bg-gray-700 active:bg-gray-900 focus:border-gray-900 focus:shadow-outline-gray",
        red: "bg-red-600 hover:bg-red-500 active:bg-red-700 focus:border-red-700 focus:shadow-outline-red",
        green: "bg-green-600 hover:bg-green-500 active:bg-green-700 focus:border-green-700 focus:shadow-outline-green",
    }[props.color];
});

const classes = `inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none transition ease-in-out duration-150 ${colorClasses.value}`;
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
