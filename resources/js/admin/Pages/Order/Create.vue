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

import Table from "@/Components/Table/Table.vue";
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
    orderStatuses: {
        type: Array,
        default: () => [],
    },
    tables: {
        type: Array,
        default: () => [],
    },
    orderTypes: {
        type: Array,
        default: () => [],
    },
    routeResourceName: {
        type: String,
        required: true,
    },
});

const form = useForm({
    type_id: props.item.type_id ?? "",
    status_id: props.item.status_id ?? "",
    table_id: props.item.table_id ?? "",
    comment: props.item.comment ?? "",
});

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
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid grid-cols-2 gap-6">

                        <SelectGroup label="Type"
                                     v-model="form.type_id"
                                     :error-message="form.errors.type_id"
                                     :items="orderTypes"
                                     required />

                        <SelectGroup label="Status"
                                        v-model="form.status_id"
                                        :error-message="form.errors.status_id"
                                        :items="orderStatuses"
                                        required />

                        <SelectGroup label="Table"
                                        v-model="form.table_id"
                                        :error-message="form.errors.table_id"
                                        :items="tables"
                                     :itemText="'number'"
                                        required />
                    </div>

                    <div class="grid gap-6">
                        <EditorGroup label="Comment"
                                     v-model="form.comment"
                                     :error-message="form.errors.comment"
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
        <Container>
            <Card>
<!--                Table of the order item-->
            </Card>
        </Container>
    </BreezeAuthenticatedLayout>
</template>
