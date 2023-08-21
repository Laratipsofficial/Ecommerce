<script setup>

import MarketingLayout from "@/Components/Marketing/MarketingLayout.vue";

defineProps({
    item: {
        type: Object,
        default: () => ({}),
    },
});

</script>

<template>
    <MarketingLayout>
        <div class="marketing-content min-h-full text-center">
            <h1 class="text-4xl font-bold">Thank you for your order!</h1>
            <p class="text-2xl font-bold">Your order number is: {{ item.id }}</p>
            <p class="text-2xl font-bold">Your order will be ready in 15 minutes.</p>
            <p class="text-2xl font-bold">Please pay at the counter.</p>
        </div>
    </MarketingLayout>
</template>

<style scoped>

</style>
