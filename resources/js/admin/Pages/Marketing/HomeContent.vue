<template>
  <div class="content-page-markup">
    <h1>{{ $t("marketing.home.title") }}</h1>
    <p>{{ $t("marketing.home.intro") }}</p>

    <div class="discover-section">
      <h2>{{ $t("marketing.home.discover.header") }}</h2>
      <p>{{ $t("marketing.home.discover.aromatic_dishes") }}</p>
      <p>{{ $t("marketing.home.discover.takeout_dinein") }}</p>
      <p>{{ $t("marketing.home.discover.quality_passion") }}</p>
      <p>{{ $t("marketing.home.discover.tradition_innovation") }}</p>
    </div>

    <p>{{ $t("marketing.home.reserve") }}</p>

    <div class="address-section">
      <h2>{{ $t("marketing.home.address.header") }}</h2>
      <p>{{ $t("marketing.home.address.restaurant_name") }}</p>
      <p>{{ $t("marketing.home.address.street_address") }}</p>
      <p>{{ $t("marketing.home.address.city") }}</p>
      <p>{{ $t("marketing.home.address.contact.phone") }}</p>
      <p>{{ $t("marketing.home.address.contact.email") }}</p>
    </div>

    <p>{{ $t("marketing.home.welcome_message") }}</p>
  </div>
</template>

<script setup>

</script>

<style scoped>

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
