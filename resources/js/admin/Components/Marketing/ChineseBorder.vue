<template>
  <div class="frame sm:invisible md:visible">
    <slot/>
  </div>
</template>

<style scoped>
div.frame {
  border-image: url('/img/chinese-border.png') 100 114 108 114 stretch stretch;
  border-color: #f4be52;
  border-style: inset;
  border-width: 100px;
  display: block;
  height: auto;
  background-color: red;
  margin: 0 auto;
}
p {
  color: yellow;
}
@media all and (max-width: 500px) {
  div.frame {
    border-width: 0px;
    width: 100%; }
}
</style>
