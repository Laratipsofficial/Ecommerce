<script setup>
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import InputError from "@/Components/InputError.vue";
import Select from "@/Components/Select.vue";

defineProps({
    modelValue: {},
    type: {
        type: String,
        default: "text",
    },
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
        <Label v-if="label"
               :value="label" />

        <Select class="mt-1"
                :model-value="modelValue"
                @update:model-value="$emit('update:modelValue', $event)"
                v-bind="$attrs" />

        <InputError v-if="errorMessage"
                    class="mt-1"
                    :message="errorMessage" />
    </div>
</template>