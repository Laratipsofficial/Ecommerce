<script setup>
import {computed, onMounted, ref, watch} from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card/Card.vue";
import Table from "@/Components/Table/Table.vue";
import Td from "@/Components/Table/Td.vue";
import Actions from "@/Components/Table/Actions.vue";
import Button from "@/Components/Button.vue";
import Modal from "@/Components/Modal.vue";
import AddNew from "@/Components/AddNew.vue";


import useDeleteItem from "@/Composables/useDeleteItem.js";
import useFilters from "@/Composables/useFilters.js";

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    items: {
        type: Object,
        default: () => ({}),
    },
    discount: {
        type: Object,
        default: () => ({}),
    },
    headers: {
        type: Array,
        default: () => [],
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
    routeResourceName: {
        type: String,
        required: true,
    },
    can: Object,
});

const {
    deleteModal,
    itemToDelete,
    isDeleting,
    showDeleteModal,
    handleDeleteItem,
} = useDeleteItem({
    routeResourceName: props.routeResourceName,
});

const { filters, isLoading, isFilled } = useFilters({
    filters: props.filters,
    routeResourceName: props.routeResourceName,
});

const createRoute = computed(() => {
    return route(`admin.${props.routeResourceName}.create`);
});



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
            <AddNew :show="isFilled">
                <Button v-if="can.create"
                        :href="createRoute">Add New</Button>
            </AddNew>

            <Card class="mt-4"
                  :is-loading="isLoading"
                  no-padding>
                <Table :headers="headers"
                       :items="items">
                    <template v-slot="{ item }">
                        <Td>
                            <div class="whitespace-pre-wrap">
                                {{ item.name }}
                            </div>
                        </Td>
                        <Td>
                            <div class="whitespace-pre-wrap">
                                {{ item.is_active }}
                            </div>
                        </Td>
                        <Td>
                            <div class="whitespace-pre-wrap">
                                {{ item.starts_at }}
                            </div>
                        </Td>
                        <Td>
                            {{ item.ends_at }}
                        </Td>
                        <Td>
                            <Button :href="route(`admin.${routeResourceName}.items.index`, item.id)">Items</Button>
                            <Actions :edit-link="route(`admin.${routeResourceName}.edit`, item.id)"
                                     :show-edit="can.edit"
                                     :show-delete="can.delete"
                                     @deleteClicked="showDeleteModal(item)" />
                        </Td>
                    </template>
                </Table>
            </Card>
        </Container>
    </BreezeAuthenticatedLayout>

    <Modal v-model="deleteModal"
           :title="`Delete ${itemToDelete.title}`">
        Are you sure you want to delete this item?

        {{ itemToDelete.id}}

        <template #footer>
            <Button @click="handleDeleteItem"
                    :disabled="isDeleting">
                <span v-if="isDeleting">Deleting</span>
                <span v-else>Delete</span>
            </Button>
        </template>
    </Modal>
</template>
