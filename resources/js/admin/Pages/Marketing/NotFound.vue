<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import MarketingLayout from "@/Components/Marketing/MarketingLayout.vue";
import CompanyGoogleMaps from "@/Components/Marketing/CompanyGoogleMaps.vue";
import HomeContent from "@/Pages/Marketing/HomeContent.vue";

</script>

<template>
    <Head>
      <title>Gouden draak</title>
      <meta name="description" content="Welcome">
    </Head>

  <MarketingLayout>
      <div class="text-center">
        <h1 class="text-xl font-bold">404</h1>
        <br>
        <p>De pagina die u zoekt bestaat niet.</p>
        <br>
        <a :href="route('home')" class="font-bold underline">
          Ga naar de homepagina
        </a>
      </div>
  </MarketingLayout>
</template>
