<script setup>
import { computed, ref, watch } from "vue";

import Card from "@/Components/Card/Card.vue";
import InputGroup from "@/Components/InputGroup.vue";
import SelectGroup from "@/Components/SelectGroup.vue";

const props = defineProps({
    modelValue: {
        type: Object,
        default: () => ({}),
    },
    items: {
        type: Array,
        default: () => [],
    },
});

console.log(props.items);

const emits = defineEmits(["update:modelValue"]);

const filters = ref({ ...props.modelValue });

watch(
    filters,
    () => {
        emits("update:modelValue", filters.value);
    },
    {
        deep: true,
    }
);

watch(
    () => filters.value.categoryId,
    () => {
        filters.value.subCategoryId = "";
    }
);
</script>

<template>
    <Card class="mb-4">
        <template #header>
            Filters
        </template>

        <form class="grid grid-cols-4 gap-8">
            <InputGroup label="Name"
                        v-model="filters.search" />
            <SelectGroup label="Sections"
                         v-model="filters.menuSectionId"
                         :items="props.items" />
        </form>
    </Card>
</template>
