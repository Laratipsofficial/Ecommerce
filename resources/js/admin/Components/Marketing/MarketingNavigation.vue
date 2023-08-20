<template>
  <nav class="menu justify-center w-full">
    <ul class="space-x-1 max-w-fit">
      <li v-for="item in $page.props.menus" :key="item.label" class="bg-blue-800">
        <a :href="item.url">
          <span class="sr-only">
            Ga naar
          </span>
          {{ item.label }}
        </a>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import {usePage} from "@inertiajs/inertia-vue3";
import Dropdown from "@/Components/Shared/Links/Dropdown.vue";
import { Link } from '@inertiajs/inertia-vue3';


console.log(usePage().props.menus);

</script>

<style scoped>
.menu {
  margin: auto;
  font-size: 20px;
  color: white;
}

.menu ul {
  display: flex;
  list-style: none;
  padding: 5px;
  margin: 0 auto;
  border: 1px solid white;
}

.menu li {
    @apply bg-blue-900;
  text-align: center;
  padding: 0px 20px;
  border: 1px solid white;
  background-size: 100% 100%;
}

.menu a {
  color: white;
  text-decoration: none;
  font-weight: bold;
  font-size: 20px;
}
</style>
<script setup>
</script>
