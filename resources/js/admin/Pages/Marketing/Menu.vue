<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";
import MarketingLayout from "@/Components/Marketing/MarketingLayout.vue";
import CompanyGoogleMaps from "@/Components/Marketing/CompanyGoogleMaps.vue";
import PdfExporter from "@/Components/PdfExporter.vue";
import DateDisplay from "@/Components/DateDisplay.vue";

const props = defineProps({
    sections:{
        type: Array,
        default: () => []
    },
    discounts:{
        type: Array,
        default: () => []
    },
})

</script>

<template>
  <Head>
    <title>Gouden draak</title>
    <meta name="description" content="Welcome">
  </Head>

  <MarketingLayout>
        <PdfExporter>
            <article class="content-page-markup">
                <header>
                    <h1>Menu</h1>
                </header>
                <main>

                    <div class="menu-sections">
                        <h2>Menu</h2>
<!--                        list of sections -->
                        <div class="menu-section" v-for="section in props.sections">
                            <h3>{{ section.name }}</h3>
<!--                            list of dishes -->
                            <div class="menu-dish" v-for="dish in section.menu_items">
                                <h3>{{ dish.full_number }} - {{ dish.name }}</h3>
                                <p>
                                    {{ dish.description }}
                                </p>
                                <p>
                                    current price: €{{ dish.current_price }}
                                    base price: €{{ dish.price }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h2>Discounts</h2>
                        <ul class="list-none">
                            <li class="discount list-none" v-for="discount in props.discounts">
                                <h3>{{ discount.name }}</h3>
                                <p>
                                    {{ discount.description }}
                                </p>
                                <p>
                                    <DateDisplay :date="discount.starts_at"></DateDisplay> tot <DateDisplay :date="discount.ends_at"></DateDisplay>
                                </p>
                                <div class="discount-dishes">
                                    <h4>Dishes</h4>
                                    <ul class="list-none">
                                        <li class="list-none" v-for="dish in discount.discount_items">
                                            <p>
                                                {{ dish.menu_item_name}} van €{{ dish.menu_item_price }} voor €{{ dish.discount_price }}
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </main>
            </article>
        </PdfExporter>
  </MarketingLayout>
</template>

<style>
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
