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
    <p class="justify-center text-center font-bold mt-4 mb-4">
      De Gouden Draak is eenvoudig te vinden, vlak bij het centrum, 5 minuten lopen achter het centraal station.
      <br/>
      <br/>

      Onderwijsboulevard 215, kamer OG112
      5223 DE 's-Hertogenbosch
    </p>
    <CompanyGoogleMaps/>
  </MarketingLayout>
</template>
