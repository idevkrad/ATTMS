<template>
    <Head title="Requests"/>
    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="d-flex align-items-center mt-n1 mb-n1">
                    <ul class="list-unstyled hstack gap-3 mb-0 font-size-11 flex-grow-1">
                        <li class="fw-bold font-size-13">
                            Requests
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
                    <table class="table table-centered table-nowrap align-middle">
                        <thead class="thead-light">
                            <tr class="font-size-11">
                                <th style="width: 15%;">Reference</th>
                                <th style="width: 20%;" class="text-center">Thesis</th>
                                <th style="width: 20%;" class="text-center">Student</th>
                                <th style="width: 20%;" class="text-center">Course</th>
                                <th style="width: 15%;" class="text-center">Type</th>
                                <th style="width: 15%;" class="text-center">Status</th>
                                <th style="width: 10%;" class="text-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(list,index) in lists" v-bind:key="list.id">
                                <td class="fw-bold">{{list.reference}}</td>
                                <td class="text-center">{{list.thesis}}</td>
                                <td class="text-center">
                                    <h5 class="font-size-13 mb-0 text-dark text-center">{{list.name}}</h5>
                                </td>
                                <td class="text-center">
                                    {{ list.course }}
                                </td>
                                 <td class="text-center">
                                    {{ list.is_borrowed }}
                                </td>
                                 <td class="text-center">
                                     <span :class="'badge bg-'+list.status.color">{{list.status.name}}</span>
                                </td>
                                <td class="text-end">
                                   <button type="button" @click="add(list,index)" class="btn btn-light btn-sm waves-effect waves-light">View</button>
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
    <Confirm ref="confirm"/>
</template>
<script>
import Confirm from "./Modals/Confirm.vue";
import Pagination from "@/Shared/Pagination.vue";
import _ from 'lodash';
export default {
    inject:['count', 'height'],
    components : { Pagination,Confirm },
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
            page: '',
            index:''
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
                    this.message();
                }
            },
        },
        keyword(newVal){
            this.checkSearchStr(newVal)
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
            page_url = page_url || '/requests';
            axios.get(page_url,{
                params : {
                    keyword : this.keyword,
                    course: this.course,
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

        add(list,index){
            this.$refs.confirm.set(list);
            this.index = index;
        },

        message(){
           this.lists.splice(this.index, 1);
        },
    }   
}
</script>