<template>
    <Head title="Users"/>
    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="d-flex align-items-center mt-n1 mb-n1">
                    <ul class="list-unstyled hstack gap-3 mb-0 font-size-11 flex-grow-1">
                        <li class="fw-bold font-size-13">
                            User Management
                        </li>
                    </ul>
                    <div class="hstack gap-2">
                        <ul class="list-inline user-chat-nav text-end mb-n2 mt-n2 dropdown">
                            <Pagination v-if="meta" @fetch="fetch" :links="links" :pagination="meta"/>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body" :style="{ height: height + 'px' }">
                <div class="d-flex align-items-center mt-n2 mb-2">
                    <div class="input-group input-group-sm me-2">
                        <input type="text" class="form-control" placeholder="Search..." style="width: 20%;" v-model="keyword"/>
                        <label class="input-group-text">Role</label>
                        <select v-model="role" @change="fetch()" class="form-select form-select-sm" style="width: 10%;">
                            <option value="" selected>All Role</option>
                            <option value="Thesis Handler" selected>Thesis Handler</option>
                            <option value="Student" selected>Student</option>
                        </select>
                        <label class="input-group-text">Department</label>
                        <select v-model="department" @change="fetch()" class="form-select form-select-sm" style="width: 20%;">
                            <option value="" selected>All Department</option>
                            <option :value="dept.id" v-for="dept in departments" v-bind:key="dept.id">{{dept.name}}</option>
                        </select>
                        <label class="input-group-text">Course</label>
                        <select v-model="course" @change="fetch()" class="form-select form-select-sm" style="width: 20%;">
                            <option value="" selected>All Course</option>
                            <option :value="course.id" v-for="course in listCourse" v-bind:key="course.id">{{course.name}}</option>
                        </select>
                    </div>
                    <button type="button" @click="create()" class="btn btn-primary btn-sm"> Create</button>
                </div>

                 <div class="table-responsive">
                    <table class="table table-centered table-nowrap table-bordered align-middle">
                        <thead class="thead-light">
                            <tr class="font-size-11">
                                <th style="width: 2%;"></th>
                                <th style="width: 30%;">Name</th>
                                <th style="width: 20%;" class="text-center">Department</th>
                                <th style="width: 25%;" class="text-center">Course</th>
                                <th style="width: 13;" class="text-center">Status</th>
                                <th style="width: 10%;" class="text-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="list in lists" v-bind:key="list.id">
                                <td>
                                    <div class="avatar-xs" v-if="list.avatar == 'avatar.jpg'">
                                        <span class="avatar-title rounded-circle">{{list.lastname.charAt(0)}}</span>
                                    </div>
                                    <div v-else>
                                        <img class="rounded-circle avatar-xs" :src="currentUrl+'/images/avatars/'+list.avatar" alt="">
                                    </div>
                                </td>
                                <td>
                                    <h5 class="font-size-13 mb-0 text-dark">{{list.lastname}}, {{list.firstname}} {{list.middlename}}</h5>
                                </td>
                                <td class="text-center">
                                    {{(list.department) ? list.department.name : 'n/a'}}
                                </td>
                                <td class="text-center">
                                    {{(list.course) ? list.course.name : 'n/a'}}
                                </td>
                                <td class="text-center">
                                    <span v-if="list.is_active == 1" class="badge bg-success fs-11">Active</span>
                                    <span v-else class="badge bg-danger fs-11">Inactive</span>
                                </td>
                                <td class="text-end">
                                    <a v-b-tooltip.hover title="Employee Activation" class="me-3 " @click="update(list)">
                                        <i v-bind:class="(list.is_active == 1) ? 'text-success bx bx-lock-open' : 'text-dark bx bxs-lock'"></i>
                                    </a>
                                    <a v-b-tooltip.hover title="Edit User" class="me-3 text-warning" @click="edit(list)"><i class='bx bx-edit-alt' ></i></a>
                                    <a class="text-info" v-b-tooltip.hover title="Verify Employee"  @click="verify(list)"><i class='bx bx-mail-send'></i></a>
                                </td>
                            </tr>
                            <tr v-if="lists.length == 0">
                                <td class="text-center" colspan="5">
                                    No application found.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <Create :departments="departments" :courses="courses" @info="message" ref="create"/>
    <Update @info="message" ref="update"/>
    <Verify ref="verify"/>
</template>
<script>
import Verify from "./Modals/Verify.vue";
import Create from "./Modals/Create.vue"; 
import Update from "./Modals/Update.vue";
import Pagination from "@/Shared/Pagination.vue";
import _ from 'lodash';
export default {
    inject:['count', 'height'],
    components : { Pagination, Create, Update, Verify },
    props: ['departments','courses'],
    data(){
        return {
            currentUrl: window.location.origin,
            lists: [],
            meta: {},
            links: {},
            keyword: '',
            listCourse: [],
            course: '',
            department: '',
            role: '',
            page: ''
        }
    },

    created(){
        this.fetch();
    },

    watch: {
        datares: {
            deep: true,
            handler(val = null) {
                if(val != null && val !== ''){
                    this.message(val.data);
                }
            },
        },
        keyword(newVal){
            this.checkSearchStr(newVal)
        },
        department(newVal){
            this.listCourse = this.courses.filter(x => x.department_id === newVal);
            if(newVal == ''){
            this.course = '';
            this.fetch();
            }
        }
    },

    computed: {
        datares() {
            return this.$page.props.flash.datares;
        },
    },

    methods : {
        checkSearchStr: _.debounce(function(string) {
            this.fetch();
        }, 300),

        fetch(page_url){
            page_url = page_url || '/users';
            axios.get(page_url,{
                params : {
                    keyword : this.keyword,
                    department: this.department,
                    course: this.course,
                    role: this.role,
                    count: this.count,
                    search: true
                }
            })
            .then(response => {
                if(response){
                    this.lists = response.data.data;                    
                    this.meta = response.data.meta;
                    this.links = response.data.links;
                    this.page = this.meta.per_page*(this.meta.current_page - 1);
                }
            })
            .catch(err => console.log(err));
        },

        update(list){
            this.$refs.update.set(list);
            this.editable = true;
        },

        create(){
            this.$refs.create.show();
            this.editable = false;
        },

        edit(list){
            this.$refs.create.edit(list);
            this.editable = true;
        },

        verify(list){
            this.$refs.verify.set(list);
        },

        message(list){
            if(!this.editable){
                this.lists.unshift(list);
            }else{
                let index = this.lists.findIndex(u => u.id === list.id);
                this.lists[index] = list;
            }
        },
    }   
}
</script>