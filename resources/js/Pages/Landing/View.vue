<template>
    <div class="container">
        <div class="row mt-n5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body border-bottom">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="fw-bold font-size-13">{{ thesis.title}}</p>
                                <ul class="list-unstyled hstack mt-n2 mb-0 font-size-12">
                                    <li>
                                        <i class="bx bx-code-block"></i> <span class="text-muted">{{thesis.code }}</span>
                                    </li>
                                    <li>
                                        <i class="bx bx-building-house ms-3"></i> <span class="text-muted">{{thesis.department.name }}</span>
                                    </li>
                                    <li>
                                        <i class="bx bx-calendar ms-3"></i> <span class="text-muted">{{ thesis.publication }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-muted font-size-14">
                                    <p style="white-space: pre-line;">{{thesis.abstract}}</p>
                                </div>
                                <hr />
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Researchers:</td>
                                                <td class="fw-bold">
                                                    <span v-for="(researcher,index) in thesis.researchers" v-bind:key="index">
                                                        {{((thesis.researchers.length-1) == index) ? 'and' : ''}}
                                                        {{researcher.name}}
                                                        {{((thesis.researchers.length-1) != index) ? ((thesis.researchers.length) == index+1) ? ',' : '' : ''}}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Panelists:</td>
                                                <td class="fw-bold">
                                                    <span v-for="(panelist,index) in thesis.panelists" v-bind:key="index">
                                                        {{((thesis.panelists.length-1) == index) ? 'and' : ''}}
                                                        {{panelist.name}}
                                                        {{((thesis.panelists.length-1) != index) ? ((thesis.panelists.length) == index+1) ? ',' : '' : ''}}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border: 0;">Adviser :</td>
                                                <td style="border: 0;" class="fw-bold">{{thesis.adviser.name}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 border-top">
                        <span class="badge bg-primary me-1 font-size-11" v-for="(tag,index) in thesis.tags" v-bind:key="index">{{ tag.name }}</span>
                        <div class="float-end">
                            <button v-if="thesis.has_hardbound" @click="borrow()" type="button" class="btn btn-danger btn-sm w-sm waves-effect waves-light">Borrow</button>
                            <button v-if="thesis.has_softcopy" @click="access()" type="button" class="ms-1 btn btn-danger btn-sm w-sm waves-effect waves-light">View</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Access @info="s" ref="access"/>
    <Borrow @info="h" ref="borrow"/>
</template>
<script>
import Access from './Modals/Access.vue';
import Borrow from './Modals/Borrow.vue';
import _ from 'lodash';
export default {
    components : { Access, Borrow },
    data() {
        return {
            currentUrl: window.location.origin,
            thesis: {
                department : {
                    policy: {}
                },
                adviser: {}
            }
        }
    },

    methods: {
        set(data){
            this.thesis = data;
        },

        borrow(){
            this.$refs.borrow.set(this.thesis);
        },

        access(){
            this.$refs.access.set(this.thesis);
        },
        s(){
            this.thesis.has_softcopy = false;
        },
        h(){
            this.thesis.has_hardbound = false;
        }
    }
}
</script>
