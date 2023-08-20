<script setup>
import {Head, Link, usePage} from "@inertiajs/inertia-vue3";
import MarketingLayout from "@/Components/Marketing/MarketingLayout.vue";
import CompanyGoogleMaps from "@/Components/Marketing/CompanyGoogleMaps.vue";

const props = defineProps({
    content: {
        type: Object,
        default: () => ({}),
    },
});

</script>

<template>
  <Head :title="content.seoTitle" description="content.seoDescription">
    <title>{{content.seoTitle}}</title>
    <meta name="description" :content="content.seoDescription">
  </Head>

  <MarketingLayout>
    <div class="content-page-markup" v-html="content.content"></div>
  </MarketingLayout>
</template>

<style>

.content-page-markup h1{
    @apply text-4xl font-bold mb-4;
  }

.content-page-markup  h2 {
    @apply text-3xl font-semibold mb-3;
  }

.content-page-markup h3 {
    @apply text-2xl font-medium mb-2;
  }

.content-page-markup h4 {
    @apply text-xl font-medium mb-2;
  }

.content-page-markup h5 {
    @apply text-lg font-medium mb-1;
  }

.content-page-markup h6 {
    @apply text-base font-medium mb-1;
  }

.content-page-markup ul,.content-page-markup ol {
    @apply list-disc ml-6 mb-4;
  }

.content-page-markup p {
    @apply mb-4 leading-relaxed;
  }

</style>
