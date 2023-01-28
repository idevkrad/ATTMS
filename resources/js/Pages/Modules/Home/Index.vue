<template>
    <!-- {{ auth}} -->123321
</template>
<script>

export default {
    props: ['auth'],
    data(){
        return {
            currentUrl: window.location.origin,
            content: 'test'
        }
    }
}
</script>