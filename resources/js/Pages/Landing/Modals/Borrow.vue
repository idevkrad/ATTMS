<template>
    <b-modal v-model="showModal" @ok="create($event)" id="update" ok-title="Submit" title="Request Borrow of Hardbound" no-close-on-backdrop centered>
        <b-form class="customform">
            <div class="row mt-3">
                <div class="col-md-12 mb-2">
                    <div class="form-group ">
                        <label>Title: </label>
                        <input type="text" class="form-control" v-model="thesis.title" readonly>
                    </div>
                </div>
                <div class="col-md-6" v-if="thesis.department.policy.borrow_time == 'Unlimited'">
                   <div class="form-group">
                        <label>Return Date: <span v-if="form.errors" v-text="form.errors.end" class="haveerror"></span></label>
                        <date-picker v-model:value="end" type="datetime" 
                        :time-picker-options="{
                            start: '08:30',
                            step: '00:30',
                            end: '17:00',
                        }"
                        :disabled-date="disabledBeforeTodayAndAfterAWeek"
                        format="YYYY-MM-DD hh:mm a"
                        placeholder="Select Date & Time">
                        </date-picker>
                    </div>
                </div>
                <div class="col-md-6" v-if="thesis.department.policy.is_within == 0">
                    <div class="form-group">
                        <label>Venue: <span v-if="form.errors" v-text="form.errors.is_out" class="haveerror"></span></label>
                        <Multiselect 
                        v-model="is_out" 
                        :options="options"
                        :allow-empty="false"
                        :show-labels="false"
                        placeholder="Select Venue"/>
                    </div>
                </div>
            </div>
        </b-form>
         <template v-slot:footer>
            <b-button @click="hide()" variant="secondary" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" block>Submit</b-button>
        </template>
    </b-modal>
</template>

<script>
import DatePicker from 'vue-datepicker-next';
import 'vue-datepicker-next/index.css';
import Multiselect from '@suadelabs/vue3-multiselect';
    export default {
        components : { Multiselect, DatePicker },
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                thesis: {
                    department : {
                        policy: {}
                    },
                },
                showModal: false,
                hardbound_id: '',  
                is_out: '', 
                duration: '',
                end:'',
                tos: false,
                form: {},
                options: ['In-Campus','Off-Campus'],
                d: false
            }
        },

        methods : {
            set(data){
                this.thesis = data;
                if(this.thesis.department.policy.borrow_count == 0){
                    this.d = true;
                }else{

                }
                this.showModal = true;
            },

            create(){
                this.form = this.$inertia.form({
                    hardbound_id: this.thesis.hardbound_id,
                    is_out: this.is_out,
                    end: (this.end != '') ? new Date(this.end).toLocaleString("af-ZA") : '',
                    type: (this.thesis.policy_time == 'Unlimited') ? 'unli' : 'Borrow',
                })

                this.form.post('/requests', {
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.$emit('info', response.data);
                        this.showModal = false;
                    }
                });
            },

            disabledBeforeTodayAndAfterAWeek(date) {
                const today = new Date();
                today.setHours(0, 0, 0, 0);

                return date < new Date(today);
            },

            hide(){
                this.showModal = false;
            }

        }
    }
</script>
