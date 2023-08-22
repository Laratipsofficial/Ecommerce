import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default function (params) {
  const { routeResourceName } = params;

  const deleteModal = ref(false);
  const itemToDelete = ref({});
  const isDeleting = ref(false);
  const itemInfo = ref({});

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

    // show delete modal for a child item
    function showDeleteModalChild(item, childItem, itemName, childItemName) {
        //log child item
        console.log('child item');
        console.log(childItem);

        deleteModal.value = true;
        itemToDelete.value = [item.id, childItem.id];

        // set the item info
        itemInfo.value = {
            itemName: itemName,
            childItemName: childItemName,
        }
    }

  function handleDeleteItem() {
        // check if the item is a array or object
      // the first item in the array is the id of the parent
        // the second item in the array is the id of the child
      // make a route parameter for the parent and child
      // pass it as array to the route

      const routeParams = {};

      if (Array.isArray(itemToDelete.value)) {
            const parentItemName = itemInfo.value.itemName;
            const childItemName = itemInfo.value.childItemName;

            routeParams.id = itemToDelete.value[0];
            routeParams.childId = itemToDelete.value[1];

            // set the route parameters
            routeParams[parentItemName] = itemToDelete.value[0];
            routeParams[childItemName] = itemToDelete.value[1];

          Inertia.delete(
              route(`${routeName}.${routeResourceName}.destroy`, routeParams),
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
          return;
        }

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
      showDeleteModalChild,
    handleDeleteItem,
  }
}
