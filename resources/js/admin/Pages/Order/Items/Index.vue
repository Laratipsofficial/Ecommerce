<script setup>
import { onMounted, ref, watch } from "vue";
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
import Filters from "@/Pages/Order/Filters.vue";
import DateDisplay from "@/Components/DateDisplay.vue";
import PriceDisplay from "@/Components/PriceDisplay.vue";

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    items: {
        type: Object,
        default: () => ({}),
    },
    order: {
        type: Object,
        default: () => ({}),
    },
    headers: {
        type: Array,
        default: () => [],
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
                        :href="route(`admin.${routeResourceName}.create`, {order: props.order.id})">Add New</Button>

            </AddNew>

            <Card class="mt-4"
                  :is-loading="isLoading"
                  no-padding>
                <Table :headers="headers"
                       :items="items">
                    <template v-slot="{ item }">
                        <Td>
                            <div class="whitespace-pre-wrap ">
                                {{ item.id }}
                            </div>
                        </Td>
                        <Td>
                            <div class="whitespace-pre-wrap">
                                {{ item.table_round }}
                            </div>
                        </Td>
                        <Td>
                            <div class="whitespace-pre-wrap ">
                                {{ item.quantity }}
                            </div>
                        </Td>
                        <Td>
                            <div class="whitespace-pre-wrap ">
                               <PriceDisplay :price="item.price" />
                            </div>
                        </Td>
                        <Td>
                            <div class="whitespace-pre-wrap ">
                                <PriceDisplay :price="item.total_price" />
                            </div>
                        </Td>
                        <Td>
                            <div class="whitespace-pre-wrap w-64">
                                <DateDisplay :date="item.created_at" />
                            </div>
                        </Td>
                        <Td>
                            <!--                            order items -->
                           <Actions :edit-link="route(`admin.${routeResourceName}.edit`, {order: props.order.id, orderItem: item.id})"
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
