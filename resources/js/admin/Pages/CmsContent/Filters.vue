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
    categories: Array,
});

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

const subCategories = computed(() => {
    if (!filters.value.categoryId) return [];

    const category = props.categories.find(
        (c) => c.id == filters.value.categoryId
    );

    if (!category) return [];

    return category.children;
});

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
                        v-model="filters.name" />
            <SelectGroup label="Category"
                         v-model="filters.categoryId"
                         :items="categories" />
            <SelectGroup v-if="subCategories.length>0"
                         label="Sub Category"
                         v-model="filters.subCategoryId"
                         :items="subCategories" />
            <SelectGroup label="Featured"
                         v-model="filters.featured"
                         :items="[{id: 1, name: 'Yes'}, {id: 0, name: 'No'}]" />
            <SelectGroup label="Show on slider"
                         v-model="filters.showOnSlider"
                         :items="[{id: 1, name: 'Yes'}, {id: 0, name: 'No'}]" />
            <SelectGroup label="Active"
                         v-model="filters.active"
                         :items="[{id: 1, name: 'Yes'}, {id: 0, name: 'No'}]" />
        </form>
    </Card>
</template>