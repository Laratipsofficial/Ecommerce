<template>
  <footer class="footer space-x-4">
      <div class="space-x-4">
          <a :href="route('contact')">Naar Contact</a>
          <a :href="route('admin.dashboard')">Dashboard</a>
          <a :href="route('tablets.index')" class="text-white">Tafels</a>
      </div>
<!--      Language switchers -->
        <div class="space-x-4">
            <a :href="route('lang', 'en')">EN</a>
            <a :href="route('lang', 'nl')">NL</a>
        </div>
  </footer>
</template>

<style scoped>
.footer {
  padding-top: 50px;
  text-align: center;
}

.footer a {
  color: yellow;
  text-decoration: none;
}
</style>
<script setup>
</script>
