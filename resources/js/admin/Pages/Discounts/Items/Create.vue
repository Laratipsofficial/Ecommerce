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
import ImageUpload from "@/Components/ImageUpload.vue";
import CrossIcon from "@/Components/Icons/Cross.vue";
import { Inertia } from "@inertiajs/inertia";
import ComboBoxGroup from "@/Components/ComboBoxGroup.vue";

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
    discount: {
        type: Object,
        default: () => ({}),
    },
    menuItems: {
        type: Array,
        default: () => [],
    },
    routeResourceName: {
        type: String,
        required: true,
    },
});

const form = useForm({
    menu_item_id: props.item.menu_item_id ?? "",
    discount: props.item.discount ?? "",
});

const submit = () => {
    props.edit
        ? form.put(
              route(`admin.${props.routeResourceName}.update`, {
                  discount: props.discount.id,
                  discountItem: props.item.id,
              })
          )
        : form.post(route(`admin.${props.routeResourceName}.store`, { discount: props.discount.id }));
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

                        <ComboBoxGroup label="Menu Item"
                                     v-model="form.menu_item_id"
                                     :error-message="form.errors.menu_item_id"
                                     :items="menuItems"
                                     required />

                        <InputGroup label="Discount"
                                    type="number"
                                    v-model="form.discount"
                                    :error-message="form.errors.discount"
                                    required />
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
