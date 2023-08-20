<script setup>
import { computed, onMounted, onUnmounted, watch } from "vue";

const props = defineProps({
    modelValue: {
        type: Boolean,
        default: false,
    },
    title: {
        type: String,
        required: false,
    },
    size: {
        type: String,
        default: "md",
        validator: (value) => ["sm", "md", "lg"].includes(value),
    },
});

const emits = defineEmits(["update:modelValue"]);

const id = "modal-" + parseInt(Math.random() * 10000000).toString();

const modalIdElement = computed(() => {
    return document.querySelector(`#${id}`);
});

watch(
    () => props.modelValue,
    (value) => {
        if (value) {
            window.Modal.getOrCreateInstance(modalIdElement.value).show();
        } else {
            window.Modal.getOrCreateInstance(modalIdElement.value).hide();
        }
    }
);

const emitOpenModalEvent = () => {
    emits("update:modelValue", true);
};

const emitCloseModalEvent = () => {
    emits("update:modelValue", false);
};

onMounted(() => {
    modalIdElement.value.addEventListener(
        "hidden.bs.modal",
        emitCloseModalEvent
    );
    modalIdElement.value.addEventListener("shown.bs.modal", emitOpenModalEvent);
});

onUnmounted(() => {
    modalIdElement.value.removeEventListener(
        "hidden.bs.modal",
        emitCloseModalEvent
    );
    modalIdElement.value.removeEventListener(
        "shown.bs.modal",
        emitOpenModalEvent
    );
});

const modalSizeClass = computed(() => `modal-${props.size}`);
</script>

<template>
    <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto"
         :id="id"
         tabindex="-1"
         :aria-labelledby="id + 'Label'"
         aria-modal="true"
         role="dialog">
        <div class="modal-dialog relative w-auto pointer-events-none"
             :class="modalSizeClass">
            <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding rounded-md outline-none text-current">
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-gray-800"
                        :id="id + 'Label'">
                        {{ title }}
                    </h5>
                    <button type="button"
                            class="btn-close box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-4">
                    <slot></slot>
                </div>

                <div v-if="$slots.footer"
                     class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>