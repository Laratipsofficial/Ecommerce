<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { computed, watch } from "vue";

import kebabCase from "lodash/kebabCase";
import replace from "lodash/replace";

import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card/Card.vue";
import Button from "@/Components/Button.vue";
import InputGroup from "@/Components/InputGroup.vue";
import SelectGroup from "@/Components/SelectGroup.vue";
import CheckboxGroup from "@/Components/CheckboxGroup.vue";
import EditorGroup from "@/Components/EditorGroup.vue";
import ImageUpload from "@/Components/ImageUpload.vue";
import CrossIcon from "@/Components/Icons/Cross.vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    edit: {
        type: Boolean,
        default: false,
    },
    title: {
        type: String,
    },
    item: {
        type: Object,
        default: () => ({}),
    },
    routeResourceName: {
        type: String,
        required: true,
    },
});

const form = useForm({
    title: props.item.name ?? "",
    slug: props.item.slug ?? "",
    seoTitle: props.item.seo_title ?? "",
    seoDescription: props.item.seo_description ?? "",
    displayName: props.item.display_name ?? "",
    culture: props.item.culture ?? "nl",
    content: props.item.content ?? "",
});

const cultures = [
    { id: "nl", name: "Dutch" },
    { id: "en", name: "English" },
];

watch(
    () => form.title,
    (name) => {
        if (!props.edit) {
            form.slug = kebabCase(replace(name, /&./, "and"));
        }
    }
);

const submit = () => {
    props.edit
        ? form.put(
              route(`admin.${props.routeResourceName}.update`, {
                  id: props.item.id,
              })
          )
        : form.post(route(`admin.${props.routeResourceName}.store`));
};

const maxUploadImageCount = 3;

const deleteImage = (imageId) => {
    if (!confirm("Are you sure you want to delete this image?")) return;

    Inertia.post(route("admin.images.destroy", { id: imageId }));
};
</script>

<template>

    <Head :title="title" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ title }}
            </h2>
        </template>

        <Container>
            <Card>
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-2 gap-6">

                        <InputGroup label="Title"
                                    v-model="form.title"
                                    :error-message="form.errors.title"
                                    required />

                        <InputGroup label="Display Name"
                                    v-model="form.displayName"
                                    :error-message="form.errors.displayName"
                                    required />

                        <InputGroup label="Slug"
                                    v-model="form.slug"
                                    :error-message="form.errors.slug"
                                    required />

                        <InputGroup label="SEO Title"
                                    v-model="form.seoTitle"
                                    :error-message="form.errors.seoTitle" />

                        <InputGroup label="SEO Description"
                                    v-model="form.seoDescription"
                                    :error-message="form.errors.seoDescription" />

                        <div class="col-span-2">
                            <div class="grid grid-cols-2 gap-6">
                                <SelectGroup v-if="cultures.length>0"
                                             label="Culture"
                                             v-model="form.culture"
                                             :items="cultures"
                                             :error-message="form.errors.culture" />
                            </div>
                        </div>

                        <div class="col-span-2">
<!--                            Invisible content text area for binding-->
                            <textarea v-model="form.content" style="display: none"></textarea>
                            <EditorGroup label="Content"
                                         v-model="form.content"
                                         :error-message="form.errors.content" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <Button :disabled="form.processing">
                            {{ form.processing ? 'Saving...' : 'Save' }}
                        </Button>
                    </div>
                </form>
            </Card>
        </Container>
    </BreezeAuthenticatedLayout>
</template>
