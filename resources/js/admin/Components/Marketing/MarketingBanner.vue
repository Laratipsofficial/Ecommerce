<template>
  <div class="main-header sm:invisible md:invisible lg:visible">
    <div class="logo-section">
      <img class="logo" src="/pictures/dragon-small.png" alt="Golden Dragon" height="50px" />
      <span class="logo-text">De Gouden Draak</span>
      <img class="logo" src="/pictures/dragon-small-flipped.png" alt="Golden Dragon" height="50px" />
    </div>
    <div class="marquee-section">
      <a :href="route('discounts')" class="marquee-link">
        <marquee behavior="scroll" direction="left">
          Welkom bij De Gouden Draak. Klik op deze tekst om de aanbiedingen van deze week te zien!
        </marquee>
      </a>
    </div>
    <div class="logo-section">
      <img class="logo" src="/pictures/dragon-small.png" alt="Golden Dragon" height="50px" />
      <span class="logo-text">De Gouden Draak</span>
      <img class="logo" src="/pictures/dragon-small-flipped.png" alt="Golden Dragon" height="50px" />
    </div>
  </div>
</template>

<style scoped>
@font-face {
  font-family: 'chinese_takeawayregular';
  src:  url('/fonts/chinesetakeaway-webfont.woff2') format('woff2'),
        url('/fonts/chinesetakeaway-webfont.woff') format('woff');
  font-weight: normal;
  font-style: normal;
}

.main-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 5px;
  width: 100%;
  background-color: red;
  height: 50px;
}

.logo-section {
  display: flex;
  flex-flow: wrap;
  align-items: center;
}

.logo {
  vertical-align: middle;
  height: 50px;
}

.logo-text {
  font-family: 'chinese_takeawayregular';
  color: yellow;
  font-size: 30px;
}

.marquee-section {
  flex-grow: 1;
  overflow: hidden;
}

.marquee-link {
  color: yellow;
  font-weight: bold;
  text-decoration: none;
}
</style>
