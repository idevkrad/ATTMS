<template>
    <b-modal v-model="showModal" @ok="create($event)" id="create" size="lg" title="Create Policy" no-close-on-backdrop centered>
        <div class="row" style="margin-right: 10px; margin-left: 10px;">
            <div class="col-md-12">
                <b-form class="customform">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Description: <span v-if="form.errors" v-text="form.errors.description" class="haveerror"></span></label>
                                <textarea v-model="policy.description" class="form-control" :maxlength="250" rows="3" placeholder="This textarea has a limit of 225 chars."></textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-12 mb-4">
                            <div class="form-group">
                                <label>Department: <span v-if="form.errors" v-text="form.errors.department_id" class="haveerror"></span></label>
                                <Multiselect 
                                v-model="policy.department" 
                                :options="departments"
                                :allow-empty="false"
                                :show-labels="false"
                                label="name" track-by="id"
                                placeholder="Select Department"/>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                               <div class="form-check">
                                    <input v-model="policy.is_borrowable" class="form-check-input" type="checkbox" id="gridCheck"/>
                                    <label class="form-check-label" for="gridCheck">
                                       Is borrowing Allowed?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <div class="form-group">
                               <div class="form-check">
                                    <input v-model="policy.is_viewable" class="form-check-input" type="checkbox" id="gridCheck2"/>
                                    <label class="form-check-label" for="gridCheck2">
                                       Is Viewing Allowed?
                                    </label>
                                </div>
                            </div>
                        </div>

                         <div class="col-md-6">
                            <div class="input-group" v-if="policy.is_borrowable">
                                <input type="text" class="form-control" style="width: 50%;" v-model="policy.borrow_count"/>
                                <select v-model="policy.borrow_time" class="form-select" style="width: 20%; height: 38px;" :disabled="view_b">
                                    <option value="" selected disabled>Select Time</option>
                                    <option value="Hour" selected>Hour</option>
                                    <option value="Day" selected>Day</option>
                                    <option value="Unlimited">Unlimited</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group" v-if="policy.is_viewable">
                                <input type="text" class="form-control" style="width: 50%;" v-model="policy.view_count"/>
                                <select v-model="policy.view_time" class="form-select" style="width: 20%; height: 38px;" :disabled="view_v">
                                    <option value="" selected disabled>Select Time</option>
                                    <option value="Hour" selected>Hour</option>
                                    <option value="Day" selected>Day</option>
                                    <option value="Unlimited">Unlimited</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                </b-form>
            </div>
        </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="secondary" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
        </template>
    </b-modal>
</template>

<script>
    import DatePicker from 'vue-datepicker-next';
    import 'vue-datepicker-next/index.css';
    import myUpload from 'vue-image-crop-upload/upload-3.vue';
    import Multiselect from '@suadelabs/vue3-multiselect';
    export default {
        props: ['departments', 'courses'],
        components: { myUpload , Multiselect, DatePicker },
        data() {
            return {
                currentUrl: window.location.origin,
                roles: ['Thesis Handler','Student'],
                policy: {
                    id: '',
                    description: '',
                    is_borrowable: false,
                    is_viewable: false,
                    borrow_time: '',
                    view_time: '',
                    borrow_count: '',
                    view_count: '',
                    department: '',
                },
                form: {},
                editable: false,
                showModal: false,
                view_b: false,
                view_v: false
            }
        },

        watch: {
            "policy.borrow_count": function(newVal){
                if(!this.editable){
                    if(newVal > 0){
                        this.policy.borrow_time = '';
                        this.view_b = false;
                    }else{
                        this.policy.borrow_time = 'Unlimited';
                        this.view_b = true;
                    }
                }
            },
            "policy.view_count": function(newVal){
                if(!this.editable){
                    if(newVal > 0){
                        this.policy.view_time = '';
                        this.view_v = false;
                    }else{
                        this.policy.view_time = 'Unlimited';
                        this.view_v = true;
                    }
                }
            }
        },

        methods: {
            show() {
                this.showModal = true;
            },

            edit(list){
                this.policy = list;
                this.showModal = true;
                this.editable = true;
            },

            create() {
                this.form = this.$inertia.form({
                    id: this.policy.id,
                    description: this.policy.description,
                    is_borrowable: this.policy.is_borrowable,
                    is_viewable: this.policy.is_viewable,
                    borrow_count: this.policy.borrow_count,
                    borrow_time: this.policy.borrow_time,
                    view_count: this.policy.view_count,
                    view_time: this.policy.view_time,
                    department_id: (this.policy.department) ? this.policy.department.id : '',
                    editable: this.editable
                })

                if(!this.editable){
                    this.form.post('/policies',{
                        preserveScroll: true,
                        onSuccess: (response) => {
                            this.hide();
                        }
                    });
                }else{
                    this.form.put('/policies/update',{
                        preserveScroll: true,
                        onSuccess: (response) => {
                            this.hide();
                        }
                    });
                }
            },

            hide(){
                (this.form.hasOwnProperty('reset') ) ? this.form.reset().clearErrors() : this.policy = {};
                this.showModal = false;
            }
        }
    }
</script>
