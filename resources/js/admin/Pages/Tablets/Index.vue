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
    tables: {
        type: Array,
        default: () => [],
    },
    routeResourceName: {
        type: String,
        required: true,
    },
});

const form = useForm({
    table_id: props.item.table_id ?? props.tables[0].id,
});

const submit = () => {
  form.post(route(`tablets.store`));
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
                        <SelectGroup label="Table"
                                     v-model="form.table_id"
                                     :error-message="form.errors.table_id"
                                     itemText="number"
                                     :items="tables"
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
