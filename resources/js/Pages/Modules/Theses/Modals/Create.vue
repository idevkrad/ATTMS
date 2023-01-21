<template>
    <b-modal v-model="showModal" @ok="create($event)" id="create" size="xl" title="Create Thesis" no-close-on-backdrop
        centered>
        <div class="row" style="margin-right: 10px; margin-left: 10px;">
            <div class="col-md-12">
                <b-form class="customform">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Title: <span v-if="form.errors" v-text="form.errors.title"
                                        class="haveerror"></span></label>
                                <input type="text" class="form-control" v-model="thesis.title"
                                    style="text-transform: capitalize;">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Abstract: <span v-if="form.errors" v-text="form.errors.abstract"
                                        class="haveerror"></span></label>
                                <textarea v-model="thesis.abstract" class="form-control" rows="3"
                                    placeholder="This textarea has a limit of 225 chars."></textarea>
                            </div>
                        </div>

                        
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12 mt-0 mb-2">
                            <div class="form-group">
                                <label>Tags <span v-if="form.errors" v-text="form.errors.tags" class="haveerror"></span></label>
                               <Multiselect 
                                ref="ky"
                                id="company"
                                style="font-size: 10px;"
                                @search-change="asyncCompany"
                                v-model="thesis.tags" 
                                :options="options"
                                :allow-empty="false"
                                :show-labels="false"
                                @tag="addCompany"
                                :taggable="true"
                                :multiple="true"
                                label="name" track-by="id"
                                tag-placeholder="press enter to add new" 
                                placeholder="Search or add tags"/>
                            </div>
                        </div>
                                <div class="col-md-12">
                                    <div class="input-group input-group-sm rounded">
                                        <button @click="add(true,'Researcher')" class="btn btn-primary" style="height: 28px; width: 150px;" type="button" id="button-addon2"><i style="margin-left:-2px;" class="bx bxs-plus-circle"></i> Add Researcher</button>
                                        <input type="text" v-model="result_r" class="form-control form-select-sm" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group input-group-sm rounded">
                                        <button @click="add(false,'Panelist')" class="btn btn-primary btn-sm" style="height: 28px; width: 150px;" type="button" id="button-addon2"><i style="margin-left:-20px;" class="bx bxs-plus-circle"></i> Add Panelists</button>
                                        <input type="text" v-model="result_p" class="form-control form-select-sm" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group input-group-sm rounded">
                                        <button @click="add(false,'Adviser')" class="btn btn-primary" style="height: 28px; width: 150px;" type="button" id="button-addon2"><i style="margin-left:-30px;" class="bx bxs-plus-circle"></i> Add Adviser</button>
                                        <input type="text" v-model="thesis.adviser.name" class="form-control form-select-sm" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12 mb-0">
                                    <div class="form-group">
                                        <label>Department: <span v-if="form.errors" v-text="form.errors.department_id"
                                                class="haveerror"></span></label>
                                        <Multiselect v-model="thesis.department" :options="departments" :allow-empty="false"
                                            :show-labels="false" label="name" track-by="id" placeholder="Select Department" />
                                    </div>
                                </div>

                                <div class="col-md-12 mt-0 mb-n1">
                                    <div class="form-group mb-0 mt-0">
                                        <label>Publication: <span v-if="form.errors" v-text="form.errors.publication"
                                                class="haveerror"></span></label>
                                        <date-picker v-model:value="thesis.publication" type="year" format="YYYY" lang="en"
                                            placeholder="Select Year" :clearable="false">
                                        </date-picker>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <input class="mt-3" type="file"
                                        @input="thesis.attachment = $event.target.files">
                                    <span v-if="form.errors" v-text="form.errors.files" class="haveerror"></span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 mt-n3 mb-2">
                            <hr />
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                               <div class="form-check">
                                    <input v-model="thesis.has_hardbound" class="form-check-input" type="checkbox" id="gridCheck"/>
                                    <label class="form-check-label" for="gridCheck">
                                       Is hardbound available?
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-md-4 mb-3">
                            <div class="form-group">
                               <div class="form-check">
                                    <input v-model="thesis.has_cd" class="form-check-input" type="checkbox" id="gridCheck1"/>
                                    <label class="form-check-label" for="gridCheck1">
                                       Is CD available?
                                    </label>
                                </div>
                            </div>
                        </div> -->
                         
                    </div>
                </b-form>
                 <div class="d-flex align-items-center mt-n2 mb-2" v-for="(field, index) in thesis.hardbounds" :key="field.id">
                    <div class="input-group input-group-sm me-2 mb-1">
                        <button @click="AddformData" class="btn btn-success" type="button" id="button-addon2"><i class="bx bxs-plus-circle"></i></button>
                        <label class="input-group-text">Location <span v-if="form.errors" v-text="form.errors['hardbounds.'+index+'.location']" class="haveerror"></span></label>
                        <input type="text" class="form-control" placeholder="Enter location tag" style="width: 30%;" v-model="field.location"/>
                        <label class="input-group-text">Office <span v-if="form.errors" v-text="form.errors['hardbounds.'+index+'.office_id']" class="haveerror"></span> </label>
                        <select v-model="field.office_id" class="form-select form-select-sm" style="width: 17%;">
                            <option value="" selected disabled>Select Office</option>
                            <option :value="dept.id" v-for="dept in offices" v-bind:key="dept.id">{{dept.name}}</option>
                        </select>
                        <label class="input-group-text">Is Borrowable? <span v-if="form.errors" v-text="form.errors['hardbounds.'+index+'.is_borrowable']" class="haveerror"></span></label>
                        <select v-model="field.is_borrowable" class="form-select form-select-sm" style="width: 7%;">
                            <option value="" selected disabled>Select</option>
                            <option :value="1">True</option>
                            <option :value="0">False</option>
                        </select>
                    </div>
                    <button type="button" @click="deleteRow(index)" class="btn btn-primary btn-sm mb-1" :disabled="del"> <i class='bx bx-trash'></i></button>
                </div>
            </div>
        </div>
        <template v-slot:footer>
            <b-button @click="hide()" variant="secondary" block>Cancel</b-button>
            <b-button @click="create('ok')" variant="primary" :disabled="form.processing" block>Save</b-button>
        </template>
    </b-modal>
    <Name ref="add" @info="messages"/>
</template>

<script>
import Name from "./Name.vue";
    import DatePicker from 'vue-datepicker-next';
    import 'vue-datepicker-next/index.css';
    import myUpload from 'vue-image-crop-upload/upload-3.vue';
    import Multiselect from '@suadelabs/vue3-multiselect';
    import _ from 'lodash';
    export default {
        props: ['departments','offices'],
        components: {
            myUpload,
            Multiselect,
            DatePicker,
            Name
        },
        data() {
            return {
                currentUrl: window.location.origin,
                roles: ['Thesis Handler', 'Student'],
                thesis: {
                    id: '',
                    title: '',
                    abstract: '',
                    department: '',
                    publication: '',
                    attachment: '',
                    adviser : '',
                    tags: [],
                    panelists: [],
                    researchers: [],
                    hardbounds: [],
                    has_hardbound: false,
                    has_cd: false,
                },
                form: {},
                editable: false,
                showModal: false,
                view_b: false,
                view_v: false,
                type: '',
                names_r: [],
                names_p: [],
                result_r: '',
                result_p: '',
                options: [],
                del: true
            }
        },

        watch: {
            "thesis.has_hardbound": function (newVal) {
                if (!this.editable) {
                    if(newVal){
                        this.thesis.hardbounds.push({office_id: '',location: '',is_borrowable: ''});
                    }else{
                        this.thesis.hardbounds = [];
                    }
                }
            },
        },

        methods: {
            addCompany(data) {
                axios.get(this.currentUrl + '/names/keywords', {params : { word: data}})
                .then(response => {
                    this.thesis.tags.push(response.data); 
                    this.options.push(response.data);
                    this.$refs.ky.$el.focus();
                })
                .catch(err => console.log(err)); 
            },

            asyncCompany: _.debounce(function(value) {
                axios.get(this.currentUrl + '/names/search', {params : {word: value}})
                .then(response => {this.options = response.data })
                .catch(err => console.log(err));
            }, 300),

            show() {
                this.thesis= {id: '',
                    title: '',
                    abstract: '',
                    department: '',
                    publication: '',
                    attachment: '',
                    adviser : '',
                    tags: [],
                    panelists: [],
                    researchers: [],
                    hardbounds: [],
                    has_hardbound: false,
                    has_cd: false,
                };
                this.names_r = [];
                this.names_p = [];
                this.result_r = '';
                this.result_p = '';
                this.showModal = true;
            },

            edit(list) {
                this.thesis = list;
                this.thesis.publication = new Date(list.publication);
                
                for(let i = 0; i < list.researchers.length; i++){
                    this.names_r.push(list.researchers[0].name)
                }
                this.result_r = this.names_r.join(', '); 
                 for(let i = 0; i < list.panelists.length; i++){
                    this.names_p.push(list.panelists[0].name)
                }
                this.result_p = this.names_p.join(', '); 
                this.showModal = true;
                this.editable = true;
            },

            create() {
                this.form = this.$inertia.form({
                    id: this.thesis.id,
                    department_id: (this.thesis.department) ? this.thesis.department.id : '',
                    title: this.thesis.title,
                    abstract: this.thesis.abstract,
                    publication: (this.thesis.publication) ? new Date(this.thesis.publication).getFullYear() : '',
                    researchers: this.thesis.researchers,
                    panelists: this.thesis.panelists,
                    adviser_id: (this.thesis.adviser) ? this.thesis.adviser.id : '',
                    tags: this.thesis.tags,
                    hardbounds: this.thesis.hardbounds,
                    has_hardbound: this.thesis.has_hardbound,
                    has_cd: this.thesis.has_cd,
                    files: this.thesis.attachment,
                    editable: this.editable
                })

                if (!this.editable) {
                    this.form.post('/theses', {
                        preserveScroll: true,
                        forceFormData: true,
                        onSuccess: (response) => {
                            this.hide();
                        }
                    });
                } else {
                    this.form.put('/theses/update', {
                        preserveScroll: true,
                        onSuccess: (response) => {
                            this.hide();
                        }
                    });
                }
            },

            add(status,type){
                this.type = type;
                this.$refs.add.show(status,type);
                this.editable = false;
            },

            hide() {
                (this.form.hasOwnProperty('reset')) ? this.form.reset().clearErrors(): this.thesis = {};
                this.showModal = false;
            },

            messages(val){
                if(this.type == 'Adviser'){
                    this.thesis.adviser = val;
                }else if(this.type == 'Researcher'){
                    this.thesis.researchers.push(val.id);
                    this.names_r.unshift(val.name);
                    this.result_r = this.names_r.join(', '); 
                }else{
                    this.thesis.panelists.unshift(val.id);
                    this.names_p.unshift(val.name);
                    this.result_p = this.names_p.join(', '); 
                }
            },

            AddformData() {
                this.thesis.hardbounds.push({ location: "", is_borrowable: "", office_id: "" });
                (this.thesis.hardbounds.length > 1) ? this.del = false : this.del = true;
            },

            deleteRow(index) {
                if (confirm("Are you sure you want to delete this element?"))
                    this.thesis.hardbounds.splice(index, 1);
                    (this.thesis.hardbounds.length > 1) ? this.del = false : this.del = true;
                },
            }
        }

</script>
<style>
.multiselect__tags {
  font-size: 10px;
}
</style>
