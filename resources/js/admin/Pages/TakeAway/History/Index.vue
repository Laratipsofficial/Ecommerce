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

    <MarketingLayout>

        <Container>
            <Container>
<!--                make a card for each item every item can be reordered(form) and has a list of order items-->
                <template v-for="(item, index) in items" :key="index">
                    <Card>
                        <template #header>
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                               Round {{ index }}
                            </h2>
                            <div class="flex justify-end">
                                <Actions>
                                    <template #trigger>
                                        <Button>
                                            Actions
                                        </Button>
                                    </template>
                                    <template #content>
                                        <Button @click="showDeleteModal(item)">
                                            Delete
                                        </Button>
                                    </template>
                                </Actions>
                            </div>
                        </template>


                        <template #body>
                            {{item}}
                            <Table :headers="headers" :items="item">
                                <template #default>
                                    <Td>
                                        {{ item.menu_item_name}}
                                    </Td>
                                    <Td>
                                        {{ item.price }}
                                    </Td>
                                    <Td>
                                        {{ item.description }}
                                    </Td>
                                    <Td>
                                        {{ item.menu_section.name }}
                                    </Td>
                                    <Td>
                                        {{ item.number }}
                                    </Td>
                                    <Td>
                                        {{ item.number_addition }}
                                    </Td>
                                    <Td>
                                        <Actions>
                                            <template #trigger>
                                                <Button>
                                                    Actions
                                                </Button>
                                            </template>
                                            <template #content>
                                                <Button @click="showDeleteModal(item)">
                                                    Delete
                                                </Button>
                                            </template>
                                        </Actions>
                                    </Td>
                                </template>
                            </Table>
                        </template>


                    </Card>
                </template>
            </Container>
        </Container>
    </MarketingLayout>

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
