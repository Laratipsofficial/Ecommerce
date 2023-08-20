<script setup>

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

.logo-left,
.logo-right {
  @apply sm:h-4 md:h-20 lg:h-64;
}

.header-text {
  font-size: 40px;
  font-weight: bold;
}

.header-subtitle {
  font-size: 50px;
}
</style>
