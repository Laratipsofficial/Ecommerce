<script setup>
import { onMounted, ref, watch } from "vue";
import {Head, useForm} from "@inertiajs/inertia-vue3";
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


const form = useForm({
    order_round: null,
    order_item_id: null,
});

const reorderRound = (round) => {
    form.order_round = round;

    form.post(route("tablets.history.store", round));
};

const reorderItem = (item) => {
    form.order_item_id = item.id;

    form.post(route("tablets.history.store", item));
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
            <Container>
<!--                make a card for each item every item can be reordered(form) and has a list of order items-->
                <div v-for="(roundItems, roundNumber) in items" :key="roundNumber" class="mb-4 border p-4 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-2">Round {{ roundNumber }}</h2>
                    <div v-for="roundItem in roundItems" :key="roundItem.id" class="mb-2 border-t pt-2">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2 md:col-span-1 text-lg font-medium">
                                <span class="text-gray-600">Menu Item:</span> {{ roundItem.menu_item_name }}
                            </div>
                            <div class="col-span-2 md:col-span-1 text-sm md:text-base">
                                <span class="text-gray-400">Side Item:</span> {{ roundItem.menu_side_item_name }}
                            </div>
                            <div class="col-span-2 md:col-span-1 text-sm md:text-base">
                                <span class="text-gray-400">Special Comment:</span> {{ roundItem.comment }}
                            </div>
                            <div class="col-span-2 md:col-span-1 text-lg font-medium">
                                <span class="text-gray-600">Price:</span> €{{ roundItem.price }}
                            </div>
                            <div class="col-span-2 md:col-span-1 text-lg font-medium">
                                <span class="text-gray-600">Quantity:</span> {{ roundItem.quantity }}X
                            </div>
                            <div class="col-span-2 md:col-span-1 text-lg font-medium">
                                <span class="text-gray-600">Total:</span> €{{ roundItem.total_price }}
                            </div>
                            <div class="col-span-2 md:col-span-1">
                                <Button @click="reorderItem(roundItem)"
                                        class="text-blue-500 hover:underline">
                                    Reorder Item
                                </Button>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button @click="reorderRound(roundNumber)" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Reorder Round {{ roundNumber }}
                        </button>
                    </div>
                </div>
            </Container>
        </Container>
    </BreezeAuthenticatedLayout>
</template>
