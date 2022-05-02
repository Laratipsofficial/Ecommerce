<script setup>
</script>

<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-b border-gray-200">
        <div v-if="$slots.header"
             class="px-6 py-2 font-bold bg-gray-50">
            <slot name="header"></slot>
        </div>

        <div class="p-6">
            <slot />
        </div>
    </div>
</template>