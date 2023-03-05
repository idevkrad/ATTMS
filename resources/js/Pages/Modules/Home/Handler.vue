<template>
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                <div class="col-lg-4" v-for="(list,name, index) in counts" v-bind:key="index">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex flex-wrap">
                                <div class="me-3">
                                    <p class="text-muted mb-2">{{name}}</p>
                                    <h5 class="mb-0">{{list}}</h5>
                                </div>
                                <div class="avatar-sm ms-auto">
                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20"><i
                                            class="bx bxs-book-bookmark"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex align-items-center mt-n1 mb-n1">
                                <ul class="list-unstyled hstack gap-3 mb-0 font-size-11 flex-grow-1">
                                    <li class="fw-bold font-size-13">Requests</li>
                                </ul>
                                <div class="hstack gap-2">
                                
                                </div>
                            </div>
                        </div>
                        <div class="card-body" data-simplebar style="height: calc(50vh - 170px);">
                            <div class="table-responsive" v-if="requests.data.length > 0">
                                <table class="table table-centered table-nowrap align-middle">
                                    <thead class="thead-light">
                                        <tr class="font-size-11">
                                            <th style="width: 15%;">Reference</th>
                                            <th style="width: 20%;" class="text-center">Thesis</th>
                                            <th style="width: 20%;" class="text-center">Student</th>
                                            <th style="width: 15%;" class="text-center">Type</th>
                                            <th style="width: 10%;" class="text-end"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(list,index) in requests.data" v-bind:key="list.id">
                                            <td class="fw-bold">{{list.reference}}</td>
                                            <td class="text-center">{{list.thesis}}</td>
                                            <td class="text-center">
                                                <h5 class="font-size-13 mb-0 text-dark text-center">{{list.name}}</h5>
                                            </td>
                                            <td class="text-center">
                                                {{ list.is_borrowed }}
                                            </td>
                                            <td class="text-end">
                                            <button type="button" @click="add(list,index)" class="btn btn-light btn-sm waves-effect waves-light">View</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else>
                                <div class="alert alert-info alert-dismissible" role="alert">No registrants found.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex align-items-center mt-n1 mb-n1">
                                <ul class="list-unstyled hstack gap-3 mb-0 font-size-11 flex-grow-1">
                                    <li class="fw-bold font-size-13">Claiming</li>
                                </ul>
                                <div class="hstack gap-2">
                                
                                </div>
                            </div>
                        </div>
                        <div class="card-body" data-simplebar style="height: calc(50vh - 190px);">
                            <div class="table-responsive" v-if="claiming.data.length > 0">
                                <table class="table table-centered table-nowrap align-middle">
                                    <thead class="thead-light">
                                        <tr class="font-size-11">
                                            <th style="width: 60%;">Student</th>
                                            <th style="width: 40%;" class="text-end"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(list,index) in claiming.data" v-bind:key="list.id">
                                            <td>
                                                <h5 class="font-size-13 mb-0 text-dark">{{list.name}}</h5>
                                                <p class="mb-0">{{list.reference}}</p>
                                            </td>
                                            <td class="text-end">
                                            <button type="button" @click="add(list,index)" class="btn btn-light btn-sm waves-effect waves-light">View</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else>
                                <div class="alert alert-info alert-dismissible" role="alert">No claiming found.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex align-items-center mt-n1 mb-n1">
                                <ul class="list-unstyled hstack gap-3 mb-0 font-size-11 flex-grow-1">
                                    <li class="fw-bold font-size-13">Returning</li>
                                </ul>
                                <div class="hstack gap-2">
                                
                                </div>
                            </div>
                        </div>
                        <div class="card-body" data-simplebar style="height: calc(50vh - 190px);">
                            <div class="table-responsive" v-if="returning.data.length > 0">
                                <table class="table table-centered table-nowrap align-middle">
                                    <thead class="thead-light">
                                        <tr class="font-size-11">
                                            <th style="width: 60%;">Student</th>
                                            <th style="width: 40%;" class="text-end"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(list,index) in returning.data" v-bind:key="list.id">
                                            <td>
                                                <h5 class="font-size-13 mb-0 text-dark">{{list.name}}</h5>
                                                <p class="mb-0">{{list.reference}}</p>
                                            </td>
                                            <td class="text-end">
                                            <button type="button" @click="add(list,index)" class="btn btn-light btn-sm waves-effect waves-light">View</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else>
                                <div class="alert alert-info alert-dismissible" role="alert">No claiming found.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="row">
                <div class="col=md-12">
                    <div class="card">
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex align-items-center mt-n1 mb-n1">
                                <ul class="list-unstyled hstack gap-3 mb-0 font-size-11 flex-grow-1">
                                    <li class="fw-bold font-size-13">Happenings</li>
                                </ul>
                                <div class="hstack gap-2">
                                
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-bottom">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        <p class="text-muted mb-2">Ongoing Borrowing</p>
                                        <h5>{{ongoing[0]}}</h5>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="text-sm-end mt-4 mt-sm-0">
                                        <p class="text-muted mb-2">Ongoing Viewing</p>
                                        <h5>{{ongoing[1]}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" data-simplebar :style="{ height: 'calc(50vh - 153px)' }">
                            <div @click="register()" type="button" class="text-center d-grid"><a href="javascript: void(0);" class="btn btn-info mt-3">New Student</a></div>
                            <div class="text-center d-grid"><a href="javascript: void(0);" class="btn btn-warning mt-1">New Request</a></div>
                        </div>
                    </div>
                </div>
                 <div class="col=md-12">
                    <div class="card">
                        <div class="card-body border-bottom py-3">
                            <div class="d-flex align-items-center mt-n1 mb-n1">
                                <ul class="list-unstyled hstack gap-3 mb-0 font-size-11 flex-grow-1">
                                    <li class="fw-bold font-size-13">Registrants</li>
                                </ul>
                                <div class="hstack gap-2">
                                
                                </div>
                            </div>
                        </div>
                        <div class="card-body" data-simplebar :style="{ height: 'calc(50vh - 190px)' }">
                            <div class="table-responsive" v-if="registrants.data.length > 0">
                                <table class="table table-centered table-nowrap align-middle">
                                    <thead class="thead-light">
                                        <tr class="font-size-11">
                                            <th style="width: 2%;"></th>
                                            <th style="width: 60%;">Name</th>
                                            <th style="width: 10%;" class="text-end"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(list,index) in registrants.data" v-bind:key="list.id">
                                            <td>
                                                <div class="avatar-xs">
                                                    <span class="avatar-title rounded-circle">{{list.lastname.charAt(0)}}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-13 mb-0 text-dark">{{list.lastname}}, {{list.firstname}} {{list.middlename}}</h5>
                                                <p class="text-muted">{{list.username}}</p>
                                            </td>
                                            <td class="text-end">
                                            <button type="button" @click="confirm(list,index)" class="btn btn-light btn-sm waves-effect waves-light">View</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else>
                                <div class="alert alert-info alert-dismissible" role="alert">No registrants found.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <Add ref="add"/>
    <Confirm ref="confirm"/>
    <Registration :departments="departments" :courses="courses" ref="create" />
</template>
<script>
import Confirm from '../Requests/Modals/Confirm.vue';
import Add from '../Registrants/Modals/Add.vue';
import Registration from '../../Landing/Modals/Registration.vue';
export default {
    components : { Add, Confirm, Registration },
    props: ['counts','departments','courses','registrants','requests','claiming','returning','ongoing'],
    methods : {
        confirm(list,index){
            this.$refs.add.set(list);
            this.index = index;
        },
          add(list,index){
            this.$refs.confirm.set(list);
            this.index = index;
        },
        register() {
            this.$refs.create.show();
        },
    }
}
</script>
