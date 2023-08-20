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
.content-page-markup h1 {
    font-size: 1.75rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.content-page-markup h2 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
}

.content-page-markup h3 {
    font-size: 1.25rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.content-page-markup h4 {
    font-size: 1.125rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.content-page-markup h5 {
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.content-page-markup h6 {
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.content-page-markup ul,
.content-page-markup ol {
    list-style: disc;
    margin-left: 1.5rem;
    margin-bottom: 1rem;
}

.content-page-markup p {
    margin-bottom: 1rem;
    line-height: 1.5;
}


</style>
