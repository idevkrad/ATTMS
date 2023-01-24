<template>
    <b-modal v-model="showModal" @ok="create($event)" id="update" ok-title="Confirm" title="Update Status" centered>
        <p>Are you sure you want to <span class="fw-bold text-success">activate</span> {{user.firstname}} {{user.lastname}}?</p>
        <div class="alert alert-warning" role="alert">
            This should allow user from accessing the system.
        </div>
    </b-modal>
</template>

<script>
    export default {
        data(){
            return {
                currentUrl: window.location.origin,
                errors: [], 
                user: {},
                showModal: false
            }
        },

        methods : {
            set(user){
                this.user = user;
                this.showModal = true;
            },

            create(){
                this.form = this.$inertia.form({
                    id: this.user.id,
                    firstname: this.user.firstname,
                    lastname: this.user.lastname,
                    middlename: this.user.middlename,
                    email: this.user.email,
                    username: this.user.username,
                    role: 'Student',
                    mobile: this.user.mobile,
                    gender: this.user.gender,
                    course_id: (this.user.course) ? this.user.course.id : '',
                    department_id: (this.user.department) ? this.user.department.id : '',
                    profile_id: this.user.profile_id,
                    img: this.user.img,
                    type: 'register',
                    editable: this.editable
                });

                this.form.post('/users',{
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
