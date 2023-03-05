<template>
    <b-modal v-model="showModal" id="update" ok-title="Approve" title="Request Details" centered>
        <div class="d-flex">
            <div class="flex-grow-1 overflow-hidden">
                <h5 class="font-size-14">REF : {{ request.reference}}</h5>
                <!-- <p class="text-muted mt-n2">{{ document.route_slip}}</p> -->
                <ol class="breadcrumb ms-n3 mt-n3">
                    <li class="breadcrumb-item"><a class="">Aguila Code</a></li>
                    <li class="breadcrumb-item active"><span active="true" disabled="false">
                            {{ request.thesis}}</span></li>
                </ol>
            </div>
        </div>
        <div class="row font-size-12">
            <div class="col-sm-6">
                <h6 class="font-size-12"><i class="bx bx-user text-info"></i> Student
                </h6>
                <p class="font-size-13 text-muted mb-0">{{ request.name }}</p>
            </div>
            <div class="col-sm-6">
                <h6 class="font-size-12"><i
                        class="bx bx-calendar me-1 text-info"></i>Request Date</h6>
                <p class="font-size-13 text-muted mb-0">{{request.created_at }}</p>
            </div>
        </div>
        <div class="row font-size-12 mt-3" v-if="request.status.id == 3 || request.status.id == 4">
            <div class="col-sm-6">
                <h6 class="font-size-12"><i class="bx bx-building text-info"></i> Office</h6>
                <p class="font-size-13 text-muted mb-0">{{ request.location_office }}</p>
            </div>
            <div class="col-sm-6">
                <h6 class="font-size-12"><i class="bx bx-cabinet me-1 text-info"></i>Location</h6>
                <p class="font-size-13 text-muted mb-0">{{request.location_name }}</p>
            </div>
        </div>
        <div class="alert alert-warning mt-4" role="alert" v-if="$page.props.auth.data.role != 'Student'">
            Start and end date will be automatically added to the system based on the policy of the department.  
        </div>
        <div class="alert alert-warning mt-4" role="alert" v-else>
           Please claim the hardbound at <span class="fw-bold">{{request.location_office}}</span>, thank you.
        </div>
        <template v-slot:footer>
            <b-button @click="showModal=false" variant="secondary" block>Cancel</b-button>
            <b-button v-if="$page.props.auth.data.role != 'Student' && request.status.id == 2" @click="create('approve')" variant="primary" :disabled="form.processing" block>Approve</b-button>
            <b-button v-if="$page.props.auth.data.role != 'Student' && request.status.id == 3" @click="create('claim')" variant="primary" :disabled="form.processing" block>Claimed</b-button>
            <b-button v-if="$page.props.auth.data.role != 'Student' && request.status.id == 4" @click="create('return')" variant="primary" :disabled="form.processing" block>Returned</b-button>
        </template>
    </b-modal>
</template>

<script>
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                request: { status:{}},
                showModal: false,
                form:{}
            }
        },

        methods : {
            set(data){
                this.request = data;
                this.showModal = true;
            },

            create(data){
                this.form = this.$inertia.form({
                    id: this.request.id,
                    type: this.request.is_borrowed,
                    status: data,
                    count: this.request.policy_count,
                    time: this.request.policy_time
                });

                this.form.put('/requests/update',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.showModal = false;
                    }
                });
            },

            remove(){
                 this.form = this.$inertia.form({
                    id: this.user.id,
                });

                this.form.post('/registrants',{
                    preserveScroll: true,
                    onSuccess: (response) => {
                        this.showModal = false;
                    }
                });
            }
        }
    }
</script>
