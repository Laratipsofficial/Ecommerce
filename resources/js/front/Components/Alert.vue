<script setup>
import { usePage } from "@inertiajs/inertia-vue3";
import { onMounted, ref, watch } from "vue";

const message = ref("");
const timeoutHandler = ref(null);

watch(
    () => usePage().props.value.flash?.success,
    (successMessage) => {
        message.value = successMessage;

        if (successMessage) {
            clearTimeout(timeoutHandler.value);

            timeoutHandler.value = setTimeout(() => {
                message.value = "";
                usePage().props.value.flash.success = "";
            }, 5000);
        }
    },
    {
        immediate: true,
    }
);
</script>

<template>
    <div v-if="message"
         class="bg-green-600 text-white rounded fixed right-0 top-0 px-4 py-2 mr-4 mt-4 z-10">{{ message }}</div>
</template>