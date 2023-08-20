<script setup>

import ChineseBorder from "./ChineseBorder.vue";
import MarketingBanner from "./MarketingBanner.vue";
import MarketingFooter from "./MarketingFooter.vue";
import MarketingNavigation from "./MarketingNavigation.vue";
import MarketingHeader from "./MarketingHeader.vue";

defineProps()

</script>

<template>
  <div class="w-full min-h-screen">
    <div class="marketing-layout min-h-screen">
      <MarketingBanner />
      <ChineseBorder>
          <MarketingHeader/>
          <MarketingNavigation/>
        <div class="marketing-content min-h-full text-center">
          <slot/>
        </div>
        <MarketingFooter/>
      </ChineseBorder>
    </div>
  </div>
</template>

<style scoped>
.marketing-layout {
  background-color: darkred;
  padding: 15px 50px 15px 50px;
  margin: 0 auto;
}

.marketing-content
{
  padding-top: 50px;
  border: 1px solid black;
  background: floralwhite;
  align-content: center;
  align-items: center;
}

</style>
