<script setup>
import { defineProps, computed } from "vue";

// price in euros, rounded to 2 decimals

const props = defineProps({
    price: {
        type: Number,
        required: true,

    },
});

// formatted price in euros, rounded to 2 decimals
const formattedPrice = computed(() => {
    return new Intl.NumberFormat("nl-NL", {
        style: "currency",
        currency: "EUR",
    }).format(props.price);
});


</script>

<template>
    <span>
        {{ formattedPrice }}
    </span>
</template>

<style scoped>

</style>
