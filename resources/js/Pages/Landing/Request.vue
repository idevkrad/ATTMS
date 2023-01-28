<template>

    <Head title="Home" />

    <body>
        <div>
            <nav class="navbar navbar-expand-lg navigation fixed-top sticky" id="navbar">
                <div class="container">
                    <ul class="navbar-nav ms-auto" id="topnav-menu">
                        <li class="nav-item">
                            <Link href="/" class="nav-link">Home</Link>
                        </li>
                        <li class="nav-item">
                            <Link href="/myrequests" class="nav-link">My Requests</Link>
                        </li>
                    </ul>

                    <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item"
                        data-toggle="collapse" data-target="#topnav-menu-content" @click="toggleMenu()">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav ms-auto" id="topnav-menu">

                        </ul>

                        <Notification></Notification>

                        <b-dropdown right variant="black" toggle-class="header-item" menu-class="dropdown-menu-end">
                            <template v-slot:button-content>
                                <img class="rounded-circle header-profile-user"
                                    :src="currentUrl+'/images/avatars/'+$page.props.auth.data.avatar" alt="n/a" />
                                <span id="name"
                                    class="d-none d-xl-inline-block ms-1">{{($page.props.auth) ? $page.props.auth.data.firstname+' '+$page.props.auth.data.lastname : ''}}</span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </template>
                            <Link href="logout" method="post" as="button" class="dropdown-item text-danger">
                            <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                            Logout
                            </Link>
                        </b-dropdown>
                    </div>
                </div>
            </nav>
            <div>
                <section class="section hero-section bg-ico-hero" id="home" style="margin-bottom: -230px;">
                    <div class="bg-overlay bg-primary"></div>
                    <div class="container">
                        <div class="row" style="margin-top: -120px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-1 me-n2">
                                        <img src="images/sei.png" alt="" class="avatar-sm">
                                    </div>
                                    <div class="col-10 ms-n4">
                                        <div class="text-white-50">
                                            <h5 class="text-white fw-semibold mb-0 hero-title" style="font-size: 21px;">
                                                Agila Thesis Tracking and Management System </h5>
                                            <p class="font-size-14">Ateneo de Zamboanga University</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>

                <section id="about" class="section pt-4 bg-white" style="min-height: 250px;">
                    <div class="container">
                        <div class="row mt-4 mb-n5">

                            <div class="col-md-12">
                                <div class="card bg-soft bg-info border shadow-none mb-3">
                                    <div class="p-1">
                                        <div class="d-flex mt-1">
                                            <div class="avatar-xs align-self-center ml-2 ms-2 mr-2">
                                                <div class="avatar-title rounded bg-transparent"><i class="bx bx-news h4 mt-1"></i></div>
                                            </div>
                                            <div class="overflow-hidden mr-auto align-self-center">
                                                <h5 class="fw-bold font-size-12 mt-1 fw-bold">View Requests</h5>
                                          
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead class="table-light font-size-12">
                                            <tr>
                                                <th class="align-middle">Reference</th>
                                                <th class="text-center">Aguila ID</th>
                                                <th class="text-center">End Date</th>
                                                <th class="text-center">Time</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="view in views" v-bind:key="view.id">
                                                <td><a href="javascript: void(0);" class="text-body fw-bold">{{view.reference}}</a> </td>
                                                <td class="text-center">{{view.thesis}}</td>
                                                <td class="text-center">{{view.end}}</td>
                                                <td class="text-center">{{view.diff}} days remaining</td>
                                                <td class="text-end">
                                                    <a @click="win(view.thesis)" v-if="view.status.id == 4" type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"> View PDF</a>
                                                    <span v-else :class="'badge badge-pill badge-soft-'+view.status.color+' font-size-11'">{{view.status.name}}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <section id="team" class="section">
                    <div class="container">
                        <div class="row mt-n5">
                            <div class="col-md-12">
                                <div class="card bg-soft bg-info border shadow-none mb-3">
                                    <div class="p-1">
                                        <div class="d-flex mt-1">
                                            <div class="avatar-xs align-self-center ml-2 ms-2 mr-2">
                                                <div class="avatar-title rounded bg-transparent"><i class="bx bx-news h4 mt-1"></i></div>
                                            </div>
                                            <div class="overflow-hidden mr-auto align-self-center">
                                                <h5 class="fw-bold font-size-12 mt-1 fw-bold">Borrow Requests</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap mb-0">
                                        <thead class="table-light font-size-12">
                                            <tr>
                                                <th class="align-middle">Reference</th>
                                                <th class="text-center">Aguila ID</th>
                                                <th class="text-center">Office</th>
                                                <th class="text-center">Return Date</th>
                                                <th class="text-center">Time</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="borrow in borrows" v-bind:key="borrow.id">
                                                <td><a href="javascript: void(0);" class="text-body fw-bold">{{borrow.reference}}</a> </td>
                                                <td class="text-center">{{borrow.thesis}}</td>
                                                <td class="text-center">{{borrow.location_office}}</td>
                                                <td class="text-center">{{borrow.end}}</td>
                                                <td class="text-center">{{borrow.diff}} days remaining</td>
                                                <td class="text-end">
                                                    <span :class="'badge badge-pill badge-soft-'+borrow.status.color+' font-size-11'">{{borrow.status.name}}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </body>
    <b-modal v-model="message" hide-footer hide-header no-close-on-backdrop centered>
        <div class="p-4">
            <div class="text-center">
                <b-form>
                    <div class="avatar-md mx-auto">
                        <div class="avatar-title rounded-circle bg-light">
                            <i :class="'bx '+$page.props.flash.type+' h1 mb-0 text-success'"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="font-size-13 text-muted">{{$page.props.flash.message }}</p>
                        <div class="mt-2">
                            <button type="button" @click="check()" class="btn btn-sm btn-primary w-md">Okay</button>
                        </div>
                    </div>
                </b-form>
            </div>
        </div>
    </b-modal>
    <WindowPortal v-model="open" ref="open"/>
</template>
<script>
    import WindowPortal from "@/Shared/Window/Portal";
    import Notification from '../Notifications/Requests.vue';
    import Multiselect from '@suadelabs/vue3-multiselect';
    import View from './View.vue';
    export default {
        layout: null,
        components: {
            Multiselect,
            View,
            Notification,
            WindowPortal
        },
        props: ['departments', 'courses'],
        data() {
            return {
                currentUrl: window.location.origin,
                lists: [],
                options: [],
                tags: [],
                views: [],
                borrows: [],
                department: '',
                keyword: '',
                publication: '',
                tag: [],
                view: false,
                open: false
            };
        },

        computed: {
            message() {
                return (this.$page.props.flash.message) ? true : false;
            }
        },

        watch: {
            keyword(newVal) {
                this.checkSearchStr(newVal)
            },
            publication(newVal) {
                this.checkSearchStr(newVal)
            },
            tags() {
                this.fetch();
            }
        },

        created() {
            this.fetch();
            window.addEventListener("scroll", this.windowScroll);
        },
        destroyed() {
            window.removeEventListener("scroll", this.windowScroll);
        },

        methods: {
            fetch() {
                axios.get(this.currentUrl + '/requests/lists',{
                    params : {type: 'lists'}
                })
                .then(response => {
                    if (response) {
                        this.lists = response.data.data;
                        this.views = this.lists.filter(x => x.is_borrowed === 'View');
                        this.borrows = this.lists.filter(x => x.is_borrowed === 'Borrow');
                    }
                })
                .catch(err => console.log(err));
            },

            check() {
                this.$page.props.flash.message = '';
                this.message = false;
            },

            windowScroll() {
                const navbar = document.getElementById("navbar");
                const name = document.getElementById("name");
                if (
                    document.body.scrollTop >= 50 ||
                    document.documentElement.scrollTop >= 50
                ) {
                    navbar.classList.add("nav-sticky");
                    name.classList.add("text-dark");
                } else {
                    navbar.classList.remove("nav-sticky");
                    name.classList.remove("text-dark");
                }
            },
            toggleMenu() {
                document.getElementById("topnav-menu-content").classList.toggle("show");
            },
            nextSlide() {
                this.$refs.carousel.goToPage(this.$refs.carousel.getNextPage());
            },
            prevSlide() {
                this.$refs.carousel.goToPage(this.$refs.carousel.getPreviousPage());
            },
            win(attachment){
                this.open = true;
                this.$refs.open.set(attachment);
            }

        }
    }

</script>
<style>
    .multiselect__tags {
        font-size: 12px;
    }

</style>
