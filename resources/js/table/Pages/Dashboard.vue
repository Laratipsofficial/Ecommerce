<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import Container from "@/Components/Container.vue";
import Card from "@/Components/Card/Card.vue";
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboardss
            </h2>
        </template>

          <Container>
              <Card>
                  Dashboard
              </Card>
          </Container>
    </BreezeAuthenticatedLayout>
</template>
