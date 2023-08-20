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
