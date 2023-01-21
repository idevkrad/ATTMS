<template>
    <Head title="Users"/>
    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="d-flex align-items-center mt-n1 mb-n1">
                    <ul class="list-unstyled hstack gap-3 mb-0 font-size-11 flex-grow-1">
                        <li class="fw-bold font-size-13">
                            Policy Management
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
                        <input type="text" class="form-control" placeholder="Search..." style="width: 50%;" v-model="keyword"/>
                        <label class="input-group-text">Department</label>
                        <select v-model="department" @change="fetch()" class="form-select form-select-sm" style="width: 20%;">
                            <option value="" selected>All Department</option>
                            <option :value="dept.id" v-for="dept in departments" v-bind:key="dept.id">{{dept.name}}</option>
                        </select>
                    </div>
                    <button type="button" @click="create()" class="btn btn-primary btn-sm"> Create</button>
                </div>

                 <div class="table-responsive">
                    <table class="table table-centered table-nowrap align-middle">
                        <thead class="thead-light">
                            <tr class="font-size-11">
                                <th style="width: 20%;" class="text-center">Department</th>
                                <th style="width: 20%;" class="text-center">Is Borrowable</th>
                                <th style="width: 20%;" class="text-center">Borrow Duration</th>
                                <th style="width: 20%;" class="text-center">Is Viewable</th>
                                <th style="width: 20%;" class="text-center">View Duration</th>
                                <th style="width: 10%;" class="text-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="list in lists" v-bind:key="list.id">
                                <td class="text-center">
                                    {{(list.department) ? list.department.name : 'n/a'}}
                                </td>
                                
                                <td class="text-center">
                                    <span v-if="list.is_borrowable == 1" class="badge bg-success fs-11">Enabled</span>
                                    <span v-else class="badge bg-danger fs-11">Disabled</span>
                                </td>
                                <td class="text-center">{{list.borrow}}</td>
                                <td class="text-center">
                                    <span v-if="list.is_viewable == 1" class="badge bg-success fs-11">Enabled</span>
                                    <span v-else class="badge bg-danger fs-11">Disabled</span>
                                </td>
                                <td class="text-center">{{list.view}}</td>
                                <td class="text-end">
                                    <a v-b-tooltip.hover title="Edit User" class="me-3 text-warning" @click="edit(list)"><i class='bx bx-edit-alt' ></i></a>
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
    <Create :departments="departments"  @info="message" ref="create"/>
</template>
<script>
import Create from "./Modals/Create.vue";
import Pagination from "@/Shared/Pagination.vue";
import _ from 'lodash';
export default {
    inject:['count', 'height'],
    components : { Pagination, Create },
    props: ['departments'],
    data(){
        return {
            currentUrl: window.location.origin,
            lists: [],
            meta: {},
            links: {},
            keyword: '',
            department: '',
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
            page_url = page_url || '/policies';
            axios.get(page_url,{
                params : {
                    keyword : this.keyword,
                    department: this.department,
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

        create(){
            this.$refs.create.show();
            this.editable = false;
        },

        edit(list){
            this.$refs.create.edit(list);
            this.editable = true;
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