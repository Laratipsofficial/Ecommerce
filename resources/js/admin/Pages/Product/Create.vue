<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { computed, watch } from "vue";

import kebabCase from "lodash/kebabCase";
import replace from "lodash/replace";

import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card/Card.vue";
import Button from "@/Components/Button.vue";
import InputGroup from "@/Components/InputGroup.vue";
import SelectGroup from "@/Components/SelectGroup.vue";
import CheckboxGroup from "@/Components/CheckboxGroup.vue";
import EditorGroup from "@/Components/EditorGroup.vue";

const props = defineProps({
    edit: {
        type: Boolean,
        default: false,
    },
    title: {
        type: String,
    },
    item: {
        type: Object,
        default: () => ({}),
    },
    routeResourceName: {
        type: String,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
});

const form = useForm({
    name: props.item.name ?? "",
    slug: props.item.slug ?? "",
    description: props.item.description ?? "",
    costPrice: props.item.cost_price ?? "",
    price: props.item.price ?? "",
    active: props.item.active ?? true,
    featured: props.item.featured ?? false,
    showOnSlider: props.item.show_on_slider ?? false,
    categoryId: props.item.category_id ?? "",
    subCategoryId: props.item.sub_category_id ?? "",
});

const subCategories = computed(() => {
    if (!form.categoryId) return [];

    let category = props.categories.find((c) => c.id == form.categoryId);

    if (!category) return [];

    return category.children || [];
});

watch(
    () => form.name,
    (name) => {
        if (!props.edit) {
            form.slug = kebabCase(replace(name, /&./, "and"));
        }
    }
);

watch(
    () => form.categoryId,
    () => {
        form.subCategoryId = "";
    }
);

const submit = () => {
    props.edit
        ? form.put(
              route(`admin.${props.routeResourceName}.update`, {
                  id: props.item.id,
              })
          )
        : form.post(route(`admin.${props.routeResourceName}.store`));
};
</script>

<template>

    <Head :title="title" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ title }}
            </h2>
        </template>

        <Container>
            <Card>
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-2 gap-6">
                        <InputGroup label="Name"
                                    v-model="form.name"
                                    :error-message="form.errors.name"
                                    required />

                        <InputGroup label="Slug"
                                    v-model="form.slug"
                                    :error-message="form.errors.slug"
                                    required />

                        <InputGroup label="Cost Price"
                                    type="number"
                                    v-model="form.costPrice"
                                    :error-message="form.errors.costPrice"
                                    required />

                        <InputGroup label="Selling Price"
                                    type="number"
                                    v-model="form.price"
                                    :error-message="form.errors.price"
                                    required />

                        <div class="col-span-2">
                            <div class="grid grid-cols-2 gap-6">
                                <SelectGroup label="Category"
                                             v-model="form.categoryId"
                                             :items="categories"
                                             :error-message="form.errors.categoryId" />

                                <SelectGroup v-if="subCategories.length>0"
                                             label="Sub Category"
                                             v-model="form.subCategoryId"
                                             :items="subCategories"
                                             :error-message="form.errors.subCategoryId" />
                            </div>
                        </div>

                        <div class="col-span-2">
                            <EditorGroup label="Description"
                                         v-model="form.description"
                                         :error-message="form.errors.description" />
                        </div>

                        <div class="col-span-2 flex items-center space-x-4">
                            <CheckboxGroup label="Active"
                                           v-model:checked="form.active" />

                            <CheckboxGroup label="Featured"
                                           v-model:checked="form.featured" />

                            <CheckboxGroup label="Show on Slider"
                                           v-model:checked="form.showOnSlider" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <Button :disabled="form.processing">
                            {{ form.processing ? 'Saving...' : 'Save' }}
                        </Button>
                    </div>
                </form>
            </Card>
        </Container>
    </BreezeAuthenticatedLayout>
</template>
