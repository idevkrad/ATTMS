<template>

    <Head title="Welcome DOST Scholars" />

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
                                <a class="nav-link" href="javascript: void(0);">About</a>
                            </li>
                        </ul>

                        <div class="ms-lg-2">
                            <Link href="/login" class="btn btn-outline-success w-xs">Sign in</Link>
                        </div>
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
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="row g-3">
                                    <div class="text-center mb-5 mt-5">
                                        <h4 class="mb-1">Thesis Finder for Ateneans</h4>
                                        <div class="small-title">Search electronic theses contained in the ATTMS
                                            archive: </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-n2 mb-2">
                                        <div class="input-group me-2">
                                            <input type="text" class="form-control bg-transparent"
                                                placeholder="Search..." style="width: 50%;" v-model="keyword" />
                                            <label class="input-group-text">Department</label>
                                            <select v-model="department" @change="fetch()" class="form-select"
                                                style="width: 20%;">
                                                <option value="" selected>All Department</option>
                                                <option :value="dept.id" v-for="dept in departments"
                                                    v-bind:key="dept.id">{{dept.name}}</option>
                                            </select>
                                        </div>
                                        <button type="button" @click="create()" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-xl-4 col-sm-6">
                                        <div class="blog-box mb-4 mb-xl-0">
                                            <div class="mt-4 text-muted font-size-12">
                                                <p class="mb-2"><i class="bx bx-calendar me-1"></i> May 14, 2022 6:38 pm
                                                </p>
                                                <h6 class="mb-3 fw-bold">Scrabble Word Detection Via Tile Recognition With Automation Of Score Tallying And Word Verification Using Raspberry Pi</h6>
                                                <p>The long wait is over for the applicants to the 20..</p>
                                                <div><a href="#">Read more</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-6">
                                        <div class="blog-box mb-4 mb-xl-0">
                                            <div class="mt-4 text-muted font-size-12">
                                                <p class="mb-2"><i class="bx bx-calendar me-1"></i> May 14, 2022 5:57 pm
                                                </p>
                                                <h6 class="mb-3 fw-bold">TAP to GO: Automated Seaport Ticketing System with RFID-based
Reloadable Passenger Card for Zamboanga City Port</h6>
                                                <p>Congratulations, scholars! May your journey as sci..</p>
                                                <div><a href="#">Read more</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-sm-6">
                                        <div class="blog-box mb-4 mb-xl-0">
                                            <div class="mt-4 text-muted font-size-12">
                                                <p class="mb-2"><i class="bx bx-calendar me-1"></i> May 14, 2022 5:54 pm
                                                </p>
                                                <h6 class="mb-3 fw-bold">Enhancement Of The Daily Time Record (DTR)system Of The Ateneo De Zamboanga University</h6>
                                                <p>The Science and Technology Scholarship Information..</p>
                                                <div><a href="#">Read more</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>



                <!-- <footer class="landing-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <img src="images/logo-light.png" alt height="20" />
                                </div>
                                <p class="mb-2">{{ new Date().getFullYear() }} © ADZU-ATTMS</p>
                            </div>
                        </div>
                    </div>
                </footer> -->
            </div>
        </div>
    </body>
</template>
<script>
    export default {
        layout: null,
        props: ['departments'],
        data() {
            return {
                department: '',
            };
        },
        created() {
            window.addEventListener("scroll", this.windowScroll);
        },
        destroyed() {
            window.removeEventListener("scroll", this.windowScroll);
        },

        methods: {
            windowScroll() {
                const navbar = document.getElementById("navbar");
                if (
                    document.body.scrollTop >= 50 ||
                    document.documentElement.scrollTop >= 50
                ) {
                    navbar.classList.add("nav-sticky");
                } else {
                    navbar.classList.remove("nav-sticky");
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
