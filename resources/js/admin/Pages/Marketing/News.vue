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
    <div class="text-center">
      <h1 class="text-xl font-bold">Nieuws</h1>
      <br>
      <p>Door de Corona crisis is De Gouden Draak op het moment slechts beperkt open.
        <br>Het restaurant-gedeelte is gesloten. U kan uw favoriete gerechten nog wel afhalen.
      </p>
      <br>
    </div>
  </MarketingLayout>
</template>
