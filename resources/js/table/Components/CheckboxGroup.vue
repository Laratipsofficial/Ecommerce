<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import Label from "@/Components/Label.vue";
import InputError from "@/Components/InputError.vue";

defineProps({
    value: {},
    label: {
        type: String,
        default: "",
    },
    errorMessage: {
        type: String,
        default: "",
    },
});
</script>

<template>
    <div>
        <Label>
            <Checkbox :value="value"
                      @update:checked="$emit('update:checked', $event)"
                      v-bind="$attrs" />
            {{ label }}
        </Label>

        <InputError v-if="errorMessage"
                    class="mt-1"
                    :message="errorMessage" />
    </div>
</template>