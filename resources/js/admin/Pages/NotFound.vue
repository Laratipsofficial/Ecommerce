<script setup>

import MarketingLayout from "@/Components/Marketing/MarketingLayout.vue";
</script>

<template>
  <MarketingLayout>
    <h1>Not Found</h1>
      <p>
        Sorry, the page you are looking for could not be found.
      </p>
      <div>
        <a :href="route('home')">
            Go back home
        </a>
      </div>
  </MarketingLayout>
</template>

<style scoped>

</style>
