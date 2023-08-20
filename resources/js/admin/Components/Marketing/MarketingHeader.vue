<script setup>

import MarketingNavigation from "@/Components/Marketing/MarketingNavigation.vue";
</script>

<template>
  <header class="header">
    <div class="logo-section display-block justify-between">
      <img class="logo-left" src="/pictures/dragon-small.png" alt="Golden Dragon" height="10px" />

      <div class="header-middle">
        <div class="header-text justify-center text-center">
          <span class="header-title">Chinees Indische Specialiteiten</span><br/>
          <span class="header-subtitle">De Gouden Draak</span>
        </div>
        <div class="header-navigation mt-2 max-w-fit">
            <MarketingNavigation/>
        </div>
      </div>
      <img class="logo-right" src="/pictures/dragon-small-flipped.png" alt="Golden Dragon" height="200px" />
    </div>
  </header>
</template>

<style scoped>
.header {
  background-color: red;
  color: yellow;
  padding: 20px;
}

.logo-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header-text {
  font-size: 40px;
  font-weight: bold;
}

.header-subtitle {
  font-size: 50px;
}



@media (max-width: 640px) {
    .logo-left,
    .logo-right {
        display: none;
    }
}

@media (min-width: 640px) {
    .logo-left,
    .logo-right {
        display: block;
        width: 100px;
    }
}

@media (min-width: 1024px) {
    .logo-left,
    .logo-right {
        display: block;
        width: 150px;
    }
}

</style>
