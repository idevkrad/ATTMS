<template>
    <Head title="Thesis Archive Management"/>
    <div class="col-12 mt-2">
        <div class="card">
            <div class="card-body border-bottom py-3">
                <div class="d-flex align-items-center mt-n1 mb-n1">
                    <ul class="list-unstyled hstack gap-3 mb-0 font-size-11 flex-grow-1">
                        <li class="fw-bold font-size-13">
                            Thesis Archive Management
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
                                <th style="width: 10%;" class="text-center">Code</th>
                                <th style="width: 60%;" class="text-center">Title</th>
                                <th style="width: 7%;" class="text-center">Year Publication</th>
                                <th style="width: 4%;" class="text-center">Softcopy</th>
                                <th style="width: 4%;" class="text-center">Hardbound</th>
                                <th style="width: 5%;" class="text-end"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="list in lists" v-bind:key="list.id">
                                <td class="text-center fw-bold">
                                    {{list.code }}
                                </td>
                                 <td class="text-center">
                                    {{list.title }}
                                </td>
                                <td class="text-center">{{list.publication}}</td>
                                <td class="text-center">
                                    <i v-if="list.has_softcopy == 1" class='bx bxs-check-circle text-success h2 mb-n3'></i>
                                    <i v-else class='bx bxs-x-circle text-danger h2 mb-n3'></i>
                                </td>
                                <td class="text-center">
                                    <i v-if="list.has_hardbound == 1" class='bx bxs-check-circle text-success h2 mb-n3'></i>
                                    <i v-else class='bx bxs-x-circle text-danger h2 mb-n3'></i>
                                </td>
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
    <Create :departments="departments" :offices="offices" @info="message" ref="create"/>
</template>
<script>
import Create from "./Modals/Create.vue";
import Pagination from "@/Shared/Pagination.vue";
import _ from 'lodash';
export default {
    inject:['count', 'height'],
    components : { Pagination, Create },
    props: ['departments','offices'],
    data(){
        return {
            currentUrl: window.location.origin,
            lists: [],
            meta: {},
            links: {},
            keyword: '',
            department: '',
            page: '',
            editable: false
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
            page_url = page_url || '/theses';
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