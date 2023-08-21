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
    sideDishes: {
        type: Array,
        default: () => [],
    },
    routeResourceName: {
        type: String,
        required: true,
    },
});

const form = useForm({
    quantity: props.item.quantity ?? "",
    menu_side_item_id: props.item.menu_side_item_id ?? "",
    comment: props.item.comment ?? "",
});

const sideDishOptions = computed(() => {
    return props.sideDishes.map((menuSection) => {
        return {
            name: menuSection.name,
            id: menuSection.id,
        };
    });
});

const submit = () => {
    form.put(
              route(`tablets.${props.routeResourceName}.update`, {
                  id: props.item.id,
              })
          )
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

                        <InputGroup label="Quantity"
                                    type="number"
                                    v-model="form.quantity"
                                    :error-message="form.errors.quantity"
                                    required />

                        <SelectGroup label="Side Item"
                                     v-model="form.menu_side_item_id"
                                     :error-message="form.errors.menu_side_item_id"
                                     :items="sideDishOptions"
                                     required />
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <InputGroup label="Comment"
                                     v-model="form.comment"
                                     :error-message="form.errors.comment"
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
