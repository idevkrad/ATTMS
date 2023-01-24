<template>
    <b-modal v-model="showModal" @ok="create($event)" id="update" size="lg" ok-title="Submit" title="Request Access to PDF" centered>
        
        <b-form class="customform">
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" v-model="thesis.title" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" v-model="thesis.department.policy.view_count" readonly>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-group mb-3">
                        <Multiselect 
                        v-model="is_out" 
                        :options="options"
                        :allow-empty="false"
                        :show-labels="false"
                        placeholder="Select Venue"/>
                    </div>
                </div> -->
            </div>
        </b-form>
        
        <div class="alert alert-warning" role="alert">
            <SimpleBar style="max-height: 60px;">
                <h6 class="alert-heading fw-bold">Data Privacy Agreement</h6>
                <p class="font-size-11">ATTMS commits to implementing appropriate security measures to ensure the confidentiality, integrity, and availability of personal data collected through this form. ATTMS will not share your data, unless with your written consent or as may be provided for by existing laws and regulations.</p>
                <p class="font-size-11">These personal data will be stored and retained for as long as these will be needed and under the provisions of the Data Privacy Act of 2012 (R.A. 10173) and other applicable laws and regulations. As a data subject, you have and may exercise your rights as enumerated under Section 16-18 of RA 10173.</p>
            </SimpleBar> 
        </div>
        <div class="alert alert-success" role="alert">
            <SimpleBar style="max-height: 80px;">
                <h6 class="alert-heading fw-bold">Terms and Conditions!</h6>
                <p class="font-size-11">If you are accessing the Thesis PDF, you should agree to the conditions wherein (1) Students should not abide by such as attempting to copy the contents on the PDF, (2) Students should upload an image of their ID as proof that they are the one who accessed the PDF.</p>
                <p class="font-size-11">The organization and thesis handler is not liable for any forms of plagiarism that the student attempts. Any forms of plagiarism may be sanctioned by the researchers who owned the thesis document.</p>
                <p class="font-size-11">By accessing the thesis pdf, you should agree to these terms. You may not access the thesis PDF if you disagree with any part of the terms.</p>
            </SimpleBar>
            <div class="form-group mt-3">
                <div class="form-check">
                    <input v-model="tos" class="form-check-input" type="checkbox" id="gridCheck"/>
                    <label class="form-check-label" for="gridCheck">
                        Agree on the Terms and Condition
                    </label>
                </div>
            </div>
        </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="secondary" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="!tos" block>Submit</b-button>
        </template>
    </b-modal>
</template>

<script>
import { SimpleBar } from 'simplebar-vue3';
import Multiselect from '@suadelabs/vue3-multiselect';
    export default {
        components : { SimpleBar, Multiselect },
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                thesis: {
                    department : {
                        policy: {}
                    },
                },
                thesis_id: '',
                showModal: false,
                tos: false,
                form: {},
                options: ['In-Campus','Off-Campus']
            }
        },

        methods : {
            set(data){
                this.thesis = data;
                this.showModal = true;
            },

            create(){
                this.form = this.$inertia.form({
                    thesis_id: this.thesis.id,
                    type: 'VIEW',
                })

                this.form.post('/requests', {
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.$emit('info', response.data);
                        this.showModal = false;
                    }
                });
            },

            hide(){
                this.showModal = false;
                this.tos = false;
            }
        }
    }
</script>
