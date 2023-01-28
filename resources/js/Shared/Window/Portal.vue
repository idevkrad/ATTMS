<template>

    <div v-if="show">
        <div class="app-header">
            <template v-if="isLoading">
                Loading...
            </template>

            <template v-else>
                <span v-if="showAllPages">
                    {{ pageCount }} page(s)
                </span>

                <span v-else>
                    <button :disabled="page <= 1" @click="page--">❮</button>
                    {{ page }} / {{ pageCount }}

                    <button :disabled="page >= pageCount" @click="page++">❯</button>
                </span>

                <label class="right">
                    <input v-model="showAllPages" type="checkbox">Show all pages
                </label>
            </template>
        </div>

        <div class="app-content">
            <vue-pdf-embed ref="pdfRef" :source="pdfSource" :page="page" @password-requested="handlePasswordRequest" @rendered="handleDocumentRender" />
        </div>
    </div>
</template>

<script>
    import VuePdfEmbed from 'vue-pdf-embed'
    export default {
        components: {
            VuePdfEmbed
        },
        name: 'window-portal',
        model: {
            prop: 'open',
            event: 'close'
        },
        data() {
            return {
                windowRef: null,
                currentUrl: window.location.origin,
                attachment: '',
                show: false,
                isLoading: true,
                page: null,
                pageCount: 1,
                pdfSource: '',
                showAllPages: true,
            }
        },
        watch: {
            open(newOpen) {
                if (newOpen) {
                    this.openPortal();
                } else {
                    this.closePortal();
                }
            },
            showAllPages() {
                this.page = this.showAllPages ? null : 1
            },
        },
        methods: {
            handleDocumentRender() {
                this.isLoading = false
                this.pageCount = this.$refs.pdfRef.pageCount
            },
            handlePasswordRequest(callback, retry) {
                callback(prompt(retry ?
                    'Enter password again' :
                    'Enter password'
                ))
            },
            set(data) {
                this.attachment = data;
                this.show = true;
                this.openPortal();
                this.pdfSource = this.currentUrl + '/storage/uploads/'+data+'.pdf';
            },
            openPortal() {
                this.windowRef = window.open("", "", "width=1200,height=800,left=200,top=10");
                this.windowRef.document.body.appendChild(this.$el);
                copyStyles(window.document, this.windowRef.document);
                this.windowRef.addEventListener('beforeunload', this.closePortal);
                this.showAllPages = false;
            },
            closePortal() {
                if (this.windowRef) {
                    this.windowRef.close();
                    this.windowRef = null;
                    this.$emit('close');
                }
            }
        },
        mounted() {
            if (this.open) {
                this.openPortal();
            }
        },
        beforeDestroy() {
            if (this.windowRef) {
                this.closePortal();
            }
        }
    }

    function copyStyles(sourceDoc, targetDoc) {
        Array.from(sourceDoc.styleSheets).forEach(styleSheet => {
            if (styleSheet.cssRules) {
                const newStyleEl = sourceDoc.createElement("style");

                Array.from(styleSheet.cssRules).forEach(cssRule => {
                    newStyleEl.appendChild(sourceDoc.createTextNode(cssRule.cssText));
                });

                targetDoc.head.appendChild(newStyleEl);
            } else if (styleSheet.href) {
                const newLinkEl = sourceDoc.createElement("link");
                newLinkEl.rel = "stylesheet";
                newLinkEl.href = styleSheet.href;
                targetDoc.head.appendChild(newLinkEl);
            }
        });
    }

</script>
<style lang="scss">
  
@import url('https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap');
</style>
<style>
    .vue-pdf-embed>div {
        margin-bottom: 8px;
        box-shadow: 0 2px 8px 4px rgba(0, 0, 0, 0.1);
    }

    .app-header {
        padding: 16px;
        box-shadow: 0 2px 8px 4px rgba(0, 0, 0, 0.1);
        background-color: #555;
        color: #ddd;
    }

    .app-content {
        padding: 24px 16px;
    }

    .right {
        float: right;
    }

</style>
