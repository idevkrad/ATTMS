<template>
    <b-dropdown right menu-class="dropdown-menu-lg p-0 dropdown-menu-end" toggle-class="header-item noti-icon" variant="black">
        <template v-slot:button-content>
            <i class="bx bxs-notepad" v-bind:class="[(lists.length != 0 ? 'bx-tada' : '')]"></i>
            <span v-if="lists.length != 0" class="badge bg-danger rounded-pill">{{total}}</span>
        </template>

        <div class="p-3">
            <div class="row align-items-center">
                <div class="col">
                    <h6 class="m-0">Request Notifications </h6>
                </div>
                <div class="col-auto" v-if="lists.length != 0">
                    <a href="#!" class="small" key="t-view-all"> View All ({{total}})</a>
                </div>
            </div>
        </div>
        <SimpleBar style="max-height: 230px;" v-if="lists.length != 0">
            <ul class="list-group">
                <li @click="view(list)" class="list-group-item" v-for="(list,index) in lists" v-bind:key="index" style="cursor: pointer;">
                    <div class="media">
                        <div class="avatar-xs me-3">
                            <span class="avatar-title rounded-circle" v-bind:class="[(list.is_borrowed == 'View' ? 'bg-warning' : 'bg-info')]">
                                <i class='bx' v-bind:class="[(list.is_borrowed == 'View' ? 'bx-show' : 'bx-badge-check')]"></i>
                            </span>
                        </div>
                        <div class="media-body">
                            <div class="float-end" style="margin-top: 5px;">
                                <p class="mb-0 font-size-10" style="margin-top: -5px;"><i class='bx bx-calendar me-1'></i>{{ list.created_at }}</p>
                            </div>
                            <h5 class="font-size-12 fw-bold mb-0">{{ list.reference }}</h5>
                            <p v-if="$page.props.auth.data.role != 'Student'" class="font-size-11 mt-2 mb-0"><span class="text-info fw-bold">{{ list.name }}</span> <span class="text-muted">request to {{ list.is_borrowed }} thesis with aguila code <span class="fw-bold"><u>{{list.thesis}}</u></span>.</span></p>
                            <p v-else class="font-size-11 mt-2 mb-0">
                                <span class="text-muted" v-if="list.is_borrowed">Your request to borrow hardbound is approved. Please claim the hardbound to the said office using Reference Code : <span class="fw-bold text-primary"><u>{{list.reference}}</u></span>.</span>
                                <span class="text-muted" v-else>Your request to access the PDF is approved. Aguila ID : <span class="fw-bold"><u>{{list.reference}}</u></span>.</span>
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
        </SimpleBar>
        <div class="p-2 border-top d-grid">
            <a class="btn btn-sm btn-link font-size-12 text-center" style="cursor: default;">
                <span key="t-view-more" v-if="lists.length == 0"> No notifications found. </span>
                <span @click.prevent="more()" @click.native.capture.stop v-else-if="page < last_page"> View More </span>
                <span v-else> Nothing to load </span>
            </a>
        </div>
    </b-dropdown>
    <Confirm ref="confirm"/>
</template>

<script>
    import Confirm from '../Modules/Requests/Modals/Confirm.vue';
    import { SimpleBar } from 'simplebar-vue3';
    export default {
        components : { SimpleBar, Confirm },
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                lists: [],
                links: {},
                total: 0,
                page: 1,
                last_page: ''
            }
        },
        
        created(){
            this.fetch();
            // this.listenForNewEvent();
            // this.roles = this.profile.roles.map(function(a) {return a.name;});
        },

        methods : {
            listenForNewEvent(){
                Echo.join('public-channel')
                .listen('TravelEvent', (data) => {
                    let user =  this.profile.id;
                    var exists = data.event.users.some(function(field){
                        return field.user_id === user;
                    });
                    if(data.event.type != "new"){
                        if(data.event.type == "comments"){
                            if(data.event.comment_by != user){
                                if(this.roles.includes('Regional Director')){
                                    data.event.action = data.event.action2;
                                    this.seens.unshift(data.event);
                                }else{
                                    (exists) ? this.seens.unshift(data.event) : '';
                                }
                            }
                        }else{
                            (exists) ? this.seens.unshift(data.event) : '';
                        }
                    }else{
                        (this.roles.includes('Regional Director')) ? this.seens.unshift(data.event) : '';
                    }
                });
            },

            fetch() {
                axios.get(this.currentUrl + '/requests/notifications',{
                    params : {type: 'notifications'}
                })
                .then(response => {
                    this.lists = response.data.data;
                     this.total = response.data.meta.total;
                    this.last_page = response.data.meta.last_page;
                })
                .catch(err => console.log(err));
            },

            view(list){
                axios.get(this.currentUrl + '/requests/'+list.id,{
                    params : {id: list.id}
                })
                .then(response => {
                    let index = this.lists.findIndex(l => l.id === list.id);
                    this.lists.splice(index, 1);
                    this.$refs.confirm.set(list);
                    this.total = this.total-1;
                })
                .catch(err => console.log(err));
            },

            more(){
                this.page = this.page + 1;
                let page_url = this.currentUrl +'/requests/notifications?page='+this.page;
                axios.get(page_url,{
                    params : {type: 'notifications'}
                })
                .then(response => {
                    this.lists.push(response.data.data[0]);
                })
                .catch(err => console.log(err));
            },

        }
    }
</script>
