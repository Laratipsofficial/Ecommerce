<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import Edit from "@/Components/Icons/Edit.vue";
import Trash from "@/Components/Icons/Trash.vue";

defineProps({
    editLink: {
        type: String,
        default: () => "",
    },
    showEdit: {
        type: Boolean,
        default: () => true,
    },
    showDelete: {
        type: Boolean,
        default: () => true,
    },
});
</script>

<template>
    <div class="flex items-center space-x-2">
        <button v-if="showEdit">
            <Link :href="editLink">
            <Edit class="w-4 h-4" />
            </Link>
        </button>
        <button v-if="showDelete"
                @click="$emit('deleteClicked', $event)">
            <Trash class="w-4 h-4" />
        </button>
    </div>
</template>