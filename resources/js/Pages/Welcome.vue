<template>

    <Head title="Home" />

    <body>
        <div>
            <nav class="navbar navbar-expand-lg navigation fixed-top sticky" id="navbar">
                <div class="container">
                    <a class="navbar-logo" href="/">
                        <img src="images/logo-dark.png" alt height="19" class="logo logo-dark" />
                        <img src="images/logo-light.png" alt height="19" class="logo logo-light" />
                    </a>

                    <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item"
                        data-toggle="collapse" data-target="#topnav-menu-content" @click="toggleMenu()">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav ms-auto" id="topnav-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="javascript: void(0);">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript: void(0);">Requests</a>
                            </li>
                        </ul>
                        
                        <Notification></Notification>

                        <b-dropdown right variant="black" toggle-class="header-item" menu-class="dropdown-menu-end">
                            <template v-slot:button-content>
                                <img class="rounded-circle header-profile-user" :src="currentUrl+'/images/avatars/'+$page.props.auth.data.avatar" alt="n/a" />
                                <span id="name" class="d-none d-xl-inline-block ms-1">{{($page.props.auth) ? $page.props.auth.data.firstname+' '+$page.props.auth.data.lastname : ''}}</span>
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

                <section id="about" class="section pt-4 bg-white">
                    <div class="container">
                        <div class="row mt-4 mb-n5">
                            <div class="col-lg-12">
                                <div class="row g-3">
                                    <div class="text-center mb-5 mt-4">
                                        <h4 class="mb-1">Thesis Finder for Ateneans</h4>
                                        <div class="small-title">Search electronic theses contained in the ATTMS archive: </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-n2 ">
                                        <div class="input-group me-2">
                                            <input type="text" class="form-control bg-transparent"
                                                placeholder="Search..." style="width: 30%;" v-model="keyword" />
                                            <label class="input-group-text">Department</label>
                                            <select v-model="department" @change="fetch()" class="form-select"
                                                style="width: 20%;">
                                                <option value="" selected>All Department</option>
                                                <option :value="dept.id" v-for="dept in departments"
                                                    v-bind:key="dept.id">{{dept.name}}</option>
                                            </select>
                                            <label class="input-group-text">Publication</label>
                                            <input type="text" class="form-control bg-transparent" placeholder="Enter Year" style="width: 7%;"
                                                v-model="publication" />
                                        </div>
                                        <button type="button" class="btn btn-primary">Search</button>
                                    </div>
                                    <div class="form-group">
                                    <Multiselect 
                                        id="company"
                                        style="font-size: 10px;"
                                        @search-change="asyncTags"
                                        v-model="tags" 
                                        :options="options"
                                        :allow-empty="true"
                                        :show-labels="false"
                                        :multiple="true"
                                        label="name" track-by="id"
                                        placeholder="Search tags"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="team" class="section" v-if="view == false">
                    <div class="container">
                        <div class="row mt-n5">
                            <div class="col-lg-12">
                                <div>
                                    <div class="table-responsive">
                                        <table
                                            class="table project-list-table table-nowrap table-centered table-borderless align-middle">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Title</th>
                                                    <th scope="col" class="text-center">Published Year</th>
                                                    <th scope="col" class="text-center">Status</th>
                                                    <th scope="col" class="text-center">Researcher</th>
                                                    <th class="text-right"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="list in lists" v-bind:key="list.id">
                                                    <td>
                                                        <h5 class="text-truncate font-size-12">
                                                            <a href="javascript: void(0);" class="text-dark">{{list.code}}</a>
                                                        </h5>
                                                        <p class="text-muted mb-0 mt-n1">{{list.title.substring(0,70)+".."}}</p>
                                                    </td>
                                                    <td class="text-center">{{list.publication}}</td>
                                                    <td class="text-center"><span class="badge bg-success">Completed</span></td>
                                                    <td>
                                                        <div class="avatar-group">
                                                            <div class="avatar-group-item" v-for="(researcher,index) in list.researchers" v-bind:key="index">
                                                                <a href="javascript: void(0);" class="d-inline-block">
                                                                    <div class="avatar-xs" v-b-tooltip.hover :title="researcher.name">
                                                                        <span class="avatar-title rounded-circle">{{researcher.name[0]}}</span>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-end">
                                                       <button @click="show(list)" type="button" class="btn btn-primary btn-sm waves-effect waves-light">View</button>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="team" class="section" v-else>
                    <View ref="view"/>
                </section>

            </div>
        </div>
    </body>
    <Registration :departments="departments" :courses="courses" ref="create" />
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
</template>
<script>
    import Notification from './Notifications/Requests.vue';
    import Multiselect from '@suadelabs/vue3-multiselect';
    import View from './Landing/View.vue';
    import Registration from './Landing/Modals/Registration.vue';
    export default {
        layout: null,
        components: {
            Registration , Multiselect, View, Notification
        },
        props: ['departments', 'courses'],
        data() {
            return {
                currentUrl: window.location.origin,
                lists: [],
                options: [],
                tags: [],
                department: '',
                keyword: '',
                publication: '',
                tag: [],
                view : false
            };
        },

        computed: {
            message() {
                return (this.$page.props.flash.message) ? true : false;
            }
        },

        watch: {
            keyword(newVal){
                this.checkSearchStr(newVal)
            },
            publication(newVal){
                this.checkSearchStr(newVal)
            },
            tags(){
                this.fetch();
            }
        },

        created() {
            window.addEventListener("scroll", this.windowScroll);
        },
        destroyed() {
            window.removeEventListener("scroll", this.windowScroll);
        },

        methods: {
            asyncTags: _.debounce(function(value) {
                axios.get(this.currentUrl + '/names/search', {params : {word: value}})
                .then(response => {this.options = response.data })
                .catch(err => console.log(err));
            }, 300),

            checkSearchStr: _.debounce(function(string) {
                this.fetch();
            }, 300),

            fetch(page_url){
                this.tag = [];
                if(this.tags.length > 0){
                    for(let i = 0; i < this.tags.length; i++){
                        this.tag.push(this.tags[i].id)
                    }
                }
                console.log(this.tag);

                page_url = page_url || '/search';
                axios.get(page_url,{
                    params : {
                        keyword : this.keyword,
                        department: this.department,
                        publication: this.publication,
                        tags: this.tag,
                        search: true
                    }
                })
                .then(response => {
                    if(response){
                        this.lists = response.data.data;                    
                    }
                })
                .catch(err => console.log(err));
            },

            check() {
                this.$page.props.flash.message = '';
                this.message = false;
            },

            show(list){
                this.view = true;
                this.$nextTick(function () {
                    this.$refs.view.set(list);
                });
            },

            create() {
                this.$refs.create.show();
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
            }

        }
    }
</script>
<style>
.multiselect__tags {
  font-size: 12px;
}
</style>

