<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import {computed, ref, watch} from "vue";

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
    order: {
        type: Object,
        default: () => ({}),
    },
    menuSideItems: {
        type: Array,
        default: () => [],
    },
    comments: {
        type: Array,
        default: () => [],
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
    menu_side_item_id: props.item.menu_side_item_id ?? "",
    price: props.item.price ?? "",
    comment: props.item.comment ?? "",
    discount: props.item.discount ?? "",
    quantity: props.item.quantity ?? "",
    table_round: props.item.table_round ?? "",
});

// make a selectabel group for comments
// if this field changes, then update the comment field

const commentsRef = ref(props.comments);

const commentsOptions = computed(() => {
    return commentsRef.value.map((comment) => {
        return {
            name: comment,
            id: comment,
        };
    });
});

// watch commentsRef
watch(
    commentsRef,
    () => {
         form.comment = commentsRef.value;
    },
    {
        deep: true,
    }
);



const submit = () => {
    console.log(props.order);

    props.edit
        ? form.put(
              route(`admin.${props.routeResourceName}.update`, {
                  order: props.order.id,
                  orderItem: props.item.id,
              })
          )
        : form.post(route(`admin.${props.routeResourceName}.store`, { order: props.order.id }));
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
                <form @submit.prevent="submit" class="space-y-6">
                   <div class="grid grid-cols-2 gap-6">
                        <ComboBoxGroup label="Menu Item"
                                     v-model="form.menu_item_id"
                                     :error-message="form.errors.menu_item_id"
                                     :items="menuItems"
                                     required />

                        <ComboBoxGroup label="Menu Side Item"
                                     v-model="form.menu_side_item_id"
                                     :error-message="form.errors.menu_side_item_id"
                                     :items="menuSideItems"
                                      />

                        <InputGroup label="Price"
                                    type="number"
                                    v-model="form.price"
                                    :error-message="form.errors.price"
                                    required />

                        <InputGroup label="Discount"
                                    type="number"
                                    v-model="form.discount"
                                    :error-message="form.errors.discount"
                                    required />

                       <InputGroup label="Comment"
                                   type="text"
                                   v-model="form.comment"
                                   :error-message="form.errors.comment"
                                   required />

                       <SelectGroup label="Comment"
                                    v-model="form.comment"
                                    :error-message="form.errors.comment"
                                    :items="commentsOptions"
                                     />

                          <InputGroup label="Quantity"
                                    type="number"
                                    v-model="form.quantity"
                                    :error-message="form.errors.quantity"
                                    required />

                        <InputGroup label="Table Round"
                                    type="number"
                                    v-model="form.table_round"
                                    :error-message="form.errors.table_round"
                                     />

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
