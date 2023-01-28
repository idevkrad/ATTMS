<template>
<body>
    
    <section class="my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div style="width: 700px; height: auto;">
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
var loadingTask = pdf.createLoadingTask(window.location.origin+'/storage/uploads/ENG-2023-01-0003.pdf');
export default {
    layout: null,
    components: {
        pdf
    },
    data(){
        return {
            currentUrl: window.location.origin,
            src: loadingTask,
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