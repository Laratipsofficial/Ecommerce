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
import Filters from "@/Pages/Menus/Items/Filters.vue";
import MarketingLayout from "@/Components/Marketing/MarketingLayout.vue";

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
    menuSections: {
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


console.log(props.menuSections);
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

    <MarketingLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ title }}
            </h2>
        </template>

        <Container>
            <AddNew :show="isFilled">
                <Button
                        :href="route(`takeaway.cart.index`)">Cart</Button>

                <Button
                    :href="route(`takeaway.cart.create`)">checkout</Button>

                <template #filters>
                    <Filters v-model="filters"
                             :items="menuSections" />
                </template>
            </AddNew>

            <Card class="mt-4"
                  :is-loading="isLoading"
                  no-padding>
                <Table :headers="headers"
                       :items="items">
                    <template v-slot="{ item }">
                        <Td>
                            <div class="whitespace-pre-wrap w-64">
                                {{ item.full_number }}
                            </div>
                        </Td>
                        <Td>
                            <div class="whitespace-pre-wrap w-64">
                                {{ item.name }}
                            </div>
                        </Td>
                        <Td>
                            <div class="whitespace-pre-wrap w-64">
                                {{ item.price }}
                            </div>
                        </Td>
                        <Td>
                            <Actions :edit-link="route(`takeaway.${routeResourceName}.show`, {id: item.id})"
                                     :show-edit="can.edit"
                                     :show-delete="false" />
                        </Td>
                    </template>
                </Table>
            </Card>
        </Container>
    </MarketingLayout>
</template>
