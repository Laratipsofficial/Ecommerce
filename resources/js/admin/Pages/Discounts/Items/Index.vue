<script setup>
import {computed, onMounted, ref, watch} from "vue";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card/Card.vue";
import Table from "@/Components/Table/Table.vue";
import Td from "@/Components/Table/Td.vue";
import Actions from "@/Components/Table/Actions.vue";
import Button from "@/Components/Button.vue";
import Modal from "@/Components/Modal.vue";


import useDeleteItem from "@/Composables/useDeleteItem.js";

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

// log discount id
console.log(props.discount.id + 'discount id');

const {
    deleteModal,
    showDeleteModalChild,
    itemToDelete,
    isDeleting,
    showDeleteModal,
    handleDeleteItem,
} = useDeleteItem({
    routeResourceName: props.routeResourceName,
});

/// admin/discounts/3/items
const createRoute = computed(() => {
    return route("admin.discounts.items.create", {
        discount: props.discount.id,
    });
});

const editRoute = (item) => {
    return route("admin.discounts.items.edit", {
        discount: props.discount.id,
        discountItem: item.id,
    });
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
                <a v-if="can.create"
                        :href="createRoute">Add New</a>

            <Card class="mt-4"
                  :is-loading="isLoading"
                  no-padding>
                <Table :headers="headers"
                       :items="items">
                    <template v-slot="{ item }">
                        <Td>
                            <div class="whitespace-pre-wrap w-64">
                                {{ item.name }}
                            </div>
                        </Td>
                        <Td>
                            <div class="whitespace-pre-wrap w-64">
                                {{item}}
                                {{ item.price }}
                            </div>
                        </Td>
                        <Td>
                            <div class="whitespace-pre-wrap w-64">
                                {{ item.discount }}
                            </div>
                        </Td>
                        <Td>
                            <div class="whitespace-pre-wrap w-64">
                                {{ item.discounted_price }}
                            </div>
                        </Td>
                        <Td>
                            <Actions :edit-link="editRoute(item)"
                                     :show-edit="can.edit"
                                     :show-delete="can.delete"
                                     @deleteClicked="showDeleteModalChild([props.discount.id, item.id, 'discount', 'discountItem'])" />
                        </Td>
                    </template>
                </Table>
            </Card>
        </Container>
    </BreezeAuthenticatedLayout>

    <Modal v-model="deleteModal"
           :title="`Delete ${itemToDelete.name}`">
        Are you sure you want to delete this item?

        <template #footer>
            <Button @click="handleDeleteItem"
                    :disabled="isDeleting">
                <span v-if="isDeleting">Deleting</span>
                <span v-else>Delete</span>
            </Button>
        </template>
    </Modal>
</template>
