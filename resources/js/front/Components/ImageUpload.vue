<script setup>
import { onMounted } from "vue";
import Dropzone from "dropzone";
import "dropzone/dist/dropzone.css";

const props = defineProps({
    modelType: {
        type: String,
        required: true,
    },
    modelId: {
        type: Number,
        required: true,
    },
    maxFilesize: {
        type: Number,
        default: 1, // in MB
    },
    maxFiles: {
        type: Number,
        default: 5,
    },
});

onMounted(() => {
    let dropzone = new Dropzone("#image-upload", {
        url: route("admin.images.store"),
        headers: {
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']")
                ?.content,
        },
        paramName: "image",
        maxFilesize: props.maxFilesize,
        maxFiles: props.maxFiles,
        acceptedFiles: ".jpeg,.jpg,.png",
        addRemoveLinks: true,
    });

    dropzone.on("sending", (file, xhr, fd) => {
        fd.append("modelType", props.modelType);
        fd.append("modelId", props.modelId);
    });
});
</script>

<template>
    <div class="dropzone"
         id="image-upload">
        <div class="dz-message"
             data-dz-message>
            <div>Drop image<span v-if="maxFiles>1">s</span> here to upload</div>
            <div v-if="maxFiles>=1">You can only upload {{ maxFiles }} image<span v-if="maxFiles>1">s</span></div>
        </div>
    </div>
</template>
