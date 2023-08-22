<template>
    <div class="relative">
        <div id="pdfContent" ref="pdfContent" class="pdfContent p-6 border">
            <slot></slot>
        </div>
        <button @click="exportToPdf" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-full absolute top-6 right-6">
            Export to PDF
        </button>
    </div>
</template>

<script>
import html2pdf from 'html2pdf.js';

//import app.css from front and add as inline style to pdf
import appCss from '@/../../css/front/app.css';

export default {


    methods: {
        // also add css to the pdf

        async exportToPdf() {
            const opt = {
                margin: 1,
                filename: 'test.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' },
                // if you want to add pagebreaks to avoid splitting page content
                // add for css class pagebreak to break to next page
                pagebreak:  { mode: '', after: '.pagebreak', avoid: '.avoid' },
            };

            const content = this.$refs.pdfContent;
            const appCss = this.appCss;

            // add css inline to html
            content.style = appCss;

            html2pdf()
                .set(opt)
                .from(content)
                .toPdf()
                .get('pdf')
                .then(function (pdf) {
                    var totalPages = pdf.internal.getNumberOfPages();

                    for (let i = 1; i <= totalPages; i++) {
                        pdf.setPage(i);
                        pdf.setFontSize(10);
                        pdf.setTextColor(150);
                        pdf.text(
                            'Page ' + String(i) + ' of ' + String(totalPages),
                            pdf.internal.pageSize.getWidth() - 0.75,
                            pdf.internal.pageSize.getHeight() - 0.75,
                            {
                                alignment: 'right',
                            }
                        );
                    }
                })
                .save();
        },
    },
};
</script>

<style scoped>
/* Add your component-specific styling here */
</style>
