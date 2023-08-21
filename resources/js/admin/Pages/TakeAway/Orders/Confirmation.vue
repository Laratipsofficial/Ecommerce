<script setup>

import MarketingLayout from "@/Components/Marketing/MarketingLayout.vue";
import QrcodeVue from 'qrcode.vue'
import Container from "@/Components/Container.vue";
import PdfExporter from "@/Components/PdfExporter.vue";

defineProps({
    item: {
        type: Object,
        default: () => ({}),
    },
});

</script>

<template>
    <MarketingLayout>
        <div class="marketing-content min-h-full text-center justify-center space-y-6">
            <h1 class="text-4xl font-bold">Thank you for your order!</h1>
            <p class="text-2xl font-bold">Your order number is: {{ item.id }}</p>

<!--            SMALL column for the qr code centered-->
            <Container>
                <div class="mt-8 mb-2 justify-center">
                    <PdfExporter>
                        <h1 class="text-2xl font-bold">
                            Please show this QR code to the staff.</h1>
                        <br/>
                        <QrcodeVue class="qr-wrapper" :render-as="'canvas'" :value="JSON.stringify(item, null)" :size="400"></QrcodeVue>
                    </PdfExporter>
                </div>
            </Container>
            <p class="text-2xl font-bold">Please show this QR code to the staff.</p>
            <p class="text-2xl font-bold">Your order will be ready in 30 minutes.</p>
            <p class="text-2xl font-bold">Please pay at the counter.</p>
        </div>
    </MarketingLayout>
</template>

<style >
.qr-wrapper {
    margin: 0 auto;
    justify-content: center;
    align-items: center;
    min-width: 500px;
    min-height: 500px;
    max-width: 500px;
    max-height: 500px;
}

.qr-wrapper canvas{
    width: 400px;
    height: 400px;
    align-items: center;
    justify-content: center;
}

.qr-wrapper svg {
    width: 400px;
    height: 400px;
    align-items: center;
    justify-content: center;
}
</style>
