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
    orderTypes: {
        type: Array,
        default: () => [],
    },
    orderStatuses: {
        type: Array,
        default: () => [],
    },
    tables: {
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
            <SelectGroup label="Order Type"
                            v-model="filters.type_id"
                            :items="props.orderTypes" />

            <SelectGroup label="Order Status"
                            v-model="filters.status_id"
                            :items="props.orderStatuses" />

            <SelectGroup label="Table"
                            v-model="filters.table_id"
                         :itemText="'number'"
                            :items="props.tables" />
        </form>
    </Card>
</template>
