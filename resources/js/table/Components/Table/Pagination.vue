<script setup>
import { Inertia } from "@inertiajs/inertia";

defineProps({
    links: Array,
});

function goToUrl(link) {
    Inertia.get(link.url);
}

function isDisabled(link) {
    return link.url === null || link.active;
}
</script>

<template>
    <nav class="flex justify-center">
        <ul class="flex list-style-none">
            <li class="page-item"
                v-for="link in links"
                :key="link.label">
                <button class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300 focus:shadow-none"
                        :class="{
                            'text-gray-400 cursor-not-allowed': isDisabled(link),
                            'text-gray-800': !isDisabled(link),
                            'bg-blue-500 text-white': link.active
                        }"
                        v-html="link.label"
                        @click.prevent="goToUrl(link)"
                        :disabled="isDisabled(link)"></button>
            </li>
        </ul>
    </nav>
</template>