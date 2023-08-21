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
        type: Array,
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

console.log(props.items);

const { filters, isLoading, isFilled } = useFilters({
    filters: props.filters,
    routeResourceName: props.routeResourceName,
});
</script>

<template>

    <Head :title="title" />

    <MarketingLayout>

        <Container>
            <AddNew :show="isFilled">
                <Button
                        :href="route(`takeaway.${routeResourceName}.create`)">Checkout</Button>

            </AddNew>

<!--                List of all the cart items-->
            <Container>
                <div class="mt-8">
                    <ul class="space-y-4">
                        <li v-for="item in items" :key="item.id">
                            <Card>
                                <div>
                                    <h2>{{item.id}}</h2>
                                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                                        {{ item.menu_item.name }} - {{ item.menu_item.number }} {{ item.menu_item.number_addition }} - {{ item.quantity}} x
                                    </h3>
                                    <p>{{ item.menu_item.description }}</p>
                                    <p>Prijs: €{{ item.menu_item.price }}</p>

                                    <!--                            comment-->
                                    <p>Opmerking: {{ item.comment }}</p>
                                    <!--                            delete button -->
                                    <Actions
                                        :show-edit="false"
                                        :show-delete="true"
                                        @deleteClicked="showDeleteModal(item)" />
                                </div>
                            </Card>
                        </li>
                    </ul>
                </div>
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
