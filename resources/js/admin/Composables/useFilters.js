import { ref, watch, onMounted } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default function (params) {
  const { filters: defaultFilters, routeResourceName } = params;

  const filters = ref(defaultFilters);

  const isLoading = ref(false);
  const fetchItemsHandler = ref(null);

  function fetchItems() {
    Inertia.get(route(`admin.${routeResourceName}.index`), filters.value, {
      preserveState: true,
      preserveScroll: true,
      replace: true,
      onBefore: () => isLoading.value = true,
      onFinish: () => isLoading.value = false,
    });
  }

  watch(
    filters,
    () => {
      clearTimeout(fetchItemsHandler.value);

      fetchItemsHandler.value = setTimeout(() => {
        fetchItems();
      }, 300);
    },
    {
      deep: true,
    }
  );

  return {
    filters,
    isLoading,
  }
}