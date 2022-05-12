import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default function (params) {
  const { routeResourceName } = params;

  const deleteModal = ref(false);
  const itemToDelete = ref({});
  const isDeleting = ref(false);

  function showDeleteModal(item) {
    deleteModal.value = true;
    itemToDelete.value = item;
  }

  function handleDeleteItem() {
    Inertia.delete(
      route(`admin.${routeResourceName}.destroy`, { id: itemToDelete.value.id }),
      {
        preserveScroll: true,
        preserveState: true,
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

  return {
    deleteModal,
    itemToDelete,
    isDeleting,
    showDeleteModal,
    handleDeleteItem,
  }
}