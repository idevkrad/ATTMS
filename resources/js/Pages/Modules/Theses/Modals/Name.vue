<template>
    <b-modal v-model="showModal" @ok="create($event)" id="create" :title="'Add '+type" no-close-on-backdrop  
    header-bg-variant="warning"
      header-text-variant="light"
      body-bg-variant="light"
      body-text-variant="dark"
      footer-bg-variant="warning"
      footer-text-variant="dark"
        centered>
        <div class="row" style="margin-right: 10px; margin-left: 10px;">
            <div class="col-md-12">
                <b-form class="customform">
                    <div class="row mt-3">
                        <div class="col-md-12 mb-2" v-if="!empty">
                            <div class="form-group">
                                <label>Name: <span v-if="form.errors" v-text="form.errors.names" class="haveerror"></span></label>
                                <multiselect 
                                ref="indi"
                                v-model="value" 
                                :options="names" 
                                :show-labels="false"
                                track-by="id" label="name"
                                :allow-empty="false"
                                :multiple="false"
                                id="ajax" @search-change="asyncFind" 
                                placeholder="Select Name">
                                </multiselect>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2 mt-2" v-if="showw">
                           <div class="d-grid gap-2">
                                <button @click="empty = true,showw=false" class="btn btn-secondary btn-sm" type="button" block="">Click to add new</button>
                           </div>
                        </div>
                        <div class="col-md-6" v-if="empty">
                            <div class="form-group mb-3">
                                <label>Firstname: <span v-if="form.errors" v-text="form.errors.firstname"
                                        class="haveerror"></span></label>
                                <input type="text" class="form-control" v-model="name.firstname"
                                    style="text-transform: capitalize;">
                            </div>
                        </div>
                        <div class="col-md-6" v-if="empty">
                            <div class="form-group mb-3">
                                <label>Lastname: <span v-if="form.errors" v-text="form.errors.lastname"
                                        class="haveerror"></span></label>
                                <input type="text" class="form-control" v-model="name.lastname"
                                    style="text-transform: capitalize;">
                            </div>
                        </div>
                    </div>
                </b-form>
            </div>
        </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="secondary" block>Cancel</b-button>
            <b-button v-if="value == ''" @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
            <b-button v-else variant="primary" @click="add()" :disabled="form.processing" block>Add</b-button>
        </template>
    </b-modal>
</template>

<script>
    import Multiselect from '@suadelabs/vue3-multiselect';
    export default {
        components: { Multiselect },
        data() {
            return {
                currentUrl: window.location.origin,
                name: {
                    id: '',
                    firstname: '',
                    lastname: '',
                    is_researcher: false
                },
                value: '',
                names: [],
                form: {},
                editable: false,
                showModal: false,
                empty: false,
                type: '',
                showw: false
            }
        },

        watch: {
            datares: {
                deep: true,
                handler(val = null) {
                    if(val != null && val !== ''){
                        this.value = val.data;
                        this.empty =false;
                        this.showw = false;
                    }
                },
            }
        },

        computed: {
            datares() {
                return this.$page.props.flash.datares;
            },
        },

        methods: {
            add(){
                this.$emit('info', this.value);
                this.showModal = false;
                this.value = '';
                this.names = [];
            },

            show(status,type) {
                this.name.is_researcher = status;
                this.role = status;
                this.type = type;
                this.value = '';
                this.name.firstname = '';
                this.name.lastname = '';
                this.showModal = true;
            },

            edit(list) {
                this.name = list;
                this.showModal = true;
                this.editable = true;
            },

            create() {
                this.form = this.$inertia.form({
                    firstname: this.name.firstname,
                    lastname: this.name.lastname,
                    is_researcher: this.name.is_researcher,
                })

                if (!this.editable) {
                    this.form.post('/names', {
                        preserveScroll: true,
                        onSuccess: (response) => {
                            // this.hide();
                            this.name.firstname = '';
                            this.name.lastname = '';
                            this.name.is_researcher = false;
                        }
                    });
                } else {
                    this.form.put('/names/update', {
                        preserveScroll: true,
                        onSuccess: (response) => {
                            this.hide();
                        }
                    });
                }
            },

            asyncFind: _.debounce(function(value) {
             if(value != ''){
                    axios.get(this.currentUrl + '/names', {
                        params: { keyword: value, role: this.role, type: 'individual' }
                    })
                    .then(response => {
                        this.names = response.data.data;
                        if(this.names.length == 0){
                            this.name.lastname = value;
                            this.showw = true;
                        }else{this.showw = false;}
                    })
                    .catch(err => console.log(err));
                }
            }, 300),

        }
    }

</script>
