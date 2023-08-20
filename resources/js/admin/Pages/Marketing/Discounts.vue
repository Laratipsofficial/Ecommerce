<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import MarketingLayout from "@/Components/Marketing/MarketingLayout.vue";
import CompanyGoogleMaps from "@/Components/Marketing/CompanyGoogleMaps.vue";

</script>

<template>
  <Head>
    <title>Gouden draak</title>
    <meta name="description" content="Welcome">
  </Head>

  <MarketingLayout>
    <CompanyGoogleMaps/>
  </MarketingLayout>
</template>
