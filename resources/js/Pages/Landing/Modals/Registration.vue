<template>
    <b-modal v-model="showModal" @ok="create($event)" id="create" size="lg" title="Register" no-close-on-backdrop
        centered>
        <div class="row" style="margin-right: 10px; margin-left: 10px;">
            <div class="col-md-12">
                <b-form class="customform">
                    <div class="row mt-3">
                         <div class="col-md-4 mb-2">
                            <div class="form-group">
                                <label>ID Number:  <span v-if="form.errors" v-text="form.errors.username" class="haveerror"></span></label>
                                <input type="text" class="form-control" v-model="user.username">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email: <span v-if="form.errors" v-text="form.errors.email" class="haveerror"></span></label>
                                <input type="email" class="form-control" v-model="user.email" style="text-transform: lowercase;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mobile No.:  <span v-if="form.errors" v-text="form.errors.mobile" class="haveerror"></span></label>
                                <input type="text" class="form-control" v-model="user.mobile">
                            </div>
                        </div> 
                         <div class="col-md-4">
                            <div class="form-group">
                                <label>Lastname: <span v-if="form.errors" v-text="form.errors.lastname" class="haveerror"></span></label>
                                <input type="text" class="form-control" v-model="user.lastname" style="text-transform: capitalize;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Firstname: <span v-if="form.errors" v-text="form.errors.firstname" class="haveerror"></span></label>
                                <input type="text" class="form-control" v-model="user.firstname" style="text-transform: capitalize;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Middle: <span v-if="form.errors" v-text="form.errors.middlename" class="haveerror"></span></label>
                                <!-- :class="[(form.errors != undefined) ? 'is-invalid' : '']" -->
                                <input type="text" class="form-control" v-model="user.middlename" style="text-transform: capitalize;"> 
                            </div>
                        </div>
                        <div class="col-md-8 mt-2 mb-4">
                            <div class="form-group">
                                <label>Course: <span v-if="form.errors" v-text="form.errors.course_id" class="haveerror"></span></label>
                                <Multiselect 
                                v-model="user.course" 
                                :options="courses"
                                :allow-empty="false"
                                :show-labels="false"
                                label="name" track-by="id"
                                placeholder="Select Course"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-4">
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" id="customRadio1" class="custom-control-input me-2"  value="M" v-model="user.gender">
                                        <label class="custom-control-label" for="customRadio1">Male</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="custom-control custom-radio mb-3">
                                        <input type="radio" id="customRadio2" class="custom-control-input me-2" value="F" v-model="user.gender">
                                        <label class="custom-control-label" for="customRadio2">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </b-form>
            </div>
        </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="secondary" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Register</b-button>
        </template>
    </b-modal>
</template>

<script>
    import DatePicker from 'vue-datepicker-next';
    import 'vue-datepicker-next/index.css';
    import myUpload from 'vue-image-crop-upload/upload-3.vue';
    import Multiselect from '@suadelabs/vue3-multiselect';
    import _ from 'lodash';
    export default {
        components: {
            myUpload,
            Multiselect,
            DatePicker
        },
        props: ['departments','courses'],

        data() {
            return {
                currentUrl: window.location.origin,
                user: {
                    id: '',
                    username: '',
                    email: '',
                    role:'',
                    firstname: '',
                    lastname: '',
                    middlename: '',
                    birthday: '',
                    gender: '',
                    mobile: '',
                    course: '',
                },
                form: {},
                showModal: false,
                listCourse: [],
            }
        },

        methods: {
            show() {
                this.showModal = true;
            },

            create() {
                this.form = this.$inertia.form({
                    id: this.user.id,
                    firstname: this.user.firstname,
                    lastname: this.user.lastname,
                    middlename: this.user.middlename,
                    email: this.user.email,
                    username: this.user.username,
                    mobile: this.user.mobile,
                    gender: this.user.gender,
                    course_id: (this.user.course) ? this.user.course.id : '',
                    department_id: (this.user.course) ? this.user.course.department_id : '',
                })

                this.form.post('/registration', {
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.showModal = false;
                        this.user = {};
                    }
                });
            },
        }
    }
</script>
