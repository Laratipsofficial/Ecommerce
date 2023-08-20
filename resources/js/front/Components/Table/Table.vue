<script setup>
import Th from "@/Components/Table/Th.vue";
import Td from "@/Components/Table/Td.vue";
import Pagination from "@/Components/Table/Pagination.vue";

defineProps({
    headers: {
        type: Array,
        default: () => [],
    },
    items: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="border-b">
                        <tr>
                            <Th v-for="header in headers"
                                :key="header.label"
                                :class="`${header.classes} font-bold`">
                                {{ header.label }}
                            </Th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b"
                            v-for="item in items.data"
                            :key="item.id">
                            <slot :item="item"></slot>
                        </tr>
                        <tr v-if="items.data.length === 0">
                            <Td :colspan="headers.length">
                                No data available.
                            </Td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div v-if="items.meta.links.length>3"
         class="py-4">
        <Pagination :links="items.meta.links" />
    </div>
</template>