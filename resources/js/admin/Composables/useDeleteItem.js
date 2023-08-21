import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default function (params) {
  const { routeResourceName } = params;

  const deleteModal = ref(false);
  const itemToDelete = ref({});
  const isDeleting = ref(false);

    const urlPrefix = window.location.pathname.split('/')[1];
    var routeName = 'takeaway';

    // if the route starts with admin, we will use the admin route
    if (urlPrefix === 'admin') {
        routeName = 'admin';
    }

    // if the route starts with tablet, we will use the tablet route
    if (urlPrefix === 'tablets') {
        routeName = 'tablets';
    }

  function showDeleteModal(item) {
    deleteModal.value = true;
    itemToDelete.value = item;
  }

  function handleDeleteItem() {
    Inertia.delete(
      route(`${routeName}.${routeResourceName}.destroy`, { id: itemToDelete.value.id }),
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
