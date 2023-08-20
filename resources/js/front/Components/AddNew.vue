<script setup>
import { ref } from "vue";

import Button from "@/Components/Button.vue";
import FilterIcon from "@/Components/Icons/Filter.vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    }
})

const showFilters = ref(props.show ?? false);
</script>

<template>
    <div>
        <div class="flex items-center justify-between">
            <slot />

            <Button v-if="$slots.filters"
                    color="white"
                    @click="showFilters=!showFilters">
                <FilterIcon class="w-4 h-4" />
            </Button>
        </div>

        <div v-if="showFilters"
             class="mt-4">
            <slot name="filters" />
        </div>
    </div>
</template>