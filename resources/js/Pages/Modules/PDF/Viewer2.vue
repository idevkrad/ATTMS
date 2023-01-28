<template>
<body>
    
    <section class="my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div style="width: 100%; height: auto;">
                        <pdf  v-for="i in numPages" :key="i" :page="i" :src="src"></pdf>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</template>

<script>
import pdf from '@jbtje/vue3pdf'
export default {
    layout: null,
    components: {
        pdf
    },
    props: { code : String},
    data(){
        return {
            currentUrl: window.location.origin,
            src: pdf.createLoadingTask(window.location.origin+'/storage/uploads/'+this.code+'.pdf'),
            numPages: undefined,
        }
    },
    mounted() {
        this.src.promise.then(pdf => {
            this.numPages = pdf.numPages;
        });
    }
  
}
</script>