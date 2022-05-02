<script setup>
import { ref } from "vue";
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

defineProps({
    roles: {
        type: Object,
        default: () => ({}),
    },
    headers: {
        type: Array,
        default: () => [],
    },
});

const deleteModal = ref(false);
const itemToDelete = ref({});
const isDeleting = ref(false);
function showDeleteModal(item) {
    deleteModal.value = true;
    itemToDelete.value = item;
}

function handleDeleteItem() {
    Inertia.delete(
        route("admin.roles.destroy", { id: itemToDelete.value.id }),
        {
            onBefore: () => {
                isDeleting.value = true;
            },
            onSuccess: () => {
                deleteModal.value = false;
                itemToDelete.value = {};
            },
            onFinish: () => {
                isDeleting.value = false;
            },
        }
    );
}
</script>

<template>

    <Head title="Roles" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles
            </h2>
        </template>

        <Container>
            <Button :href="route('admin.roles.create')">Add New</Button>

            <Card class="mt-4">
                <Table :headers="headers"
                       :items="roles">
                    <template v-slot="{ item }">
                        <Td>
                            {{ item.name }}
                        </Td>
                        <Td>
                            {{ item.created_at_formatted }}
                        </Td>
                        <Td>
                            <Actions :edit-link="route('admin.roles.edit', {id: item.id})"
                                     @deleteClicked="showDeleteModal(item)" />
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
