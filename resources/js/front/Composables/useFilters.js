import { ref, watch, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";

export default function (params) {
  const { filters: defaultFilters, routeResourceName } = params;

  const filters = ref(defaultFilters);

  const isFilled = computed(() => {
    let { page, ...rest } = filters.value;

    return Object.values(rest)
      .some(v => !["", null, undefined].includes(v))
  })

  const isLoading = ref(false);
  const fetchItemsHandler = ref(null);

  function fetchItems() {
    Inertia.get(route(`admin.${routeResourceName}.index`), {
      ...filters.value,
      page: 1,
    }, {
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
    isFilled,
  }
}