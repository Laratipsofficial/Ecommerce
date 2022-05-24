<script setup>
defineProps({
    isLoading: {
        type: Boolean,
        default: false,
    },
    noPadding: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
        <div v-if="isLoading"
             class="w-full bg-gray-200 h-1">
            <div class="bg-blue-600 h-1 animate-progress"></div>
        </div>

        <div v-if="$slots.header"
             class="px-6 py-2 font-bold bg-gray-50 border-b">
            <slot name="header"></slot>
        </div>

        <div :class="[noPadding ? '' : 'p-6']">
            <slot />
        </div>
    </div>
</template>