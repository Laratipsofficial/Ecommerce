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


  // check if the route starts with admin, tablet or not, based on that, we will use the correct route
    // get it from the first part of the route
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


  function fetchItems() {
    Inertia.get(route(routeName + '.' + routeResourceName + '.index'),
        {
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
