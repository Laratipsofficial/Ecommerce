<script setup>
import Button from "@/Components/Button.vue";

defineProps({
    active: Boolean,
});
</script>

<template>
    <Button :color="active ? 'green' : 'red'"
            small>
        {{ active ? 'Yes' : 'No' }}
    </Button>
</template>
