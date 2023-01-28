<template>
    <nav class="navbar navbar-expand-lg navigation fixed-top sticky" id="navbar">
        <div class="container">
            <ul class="navbar-nav ms-auto" id="topnav-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript: void(0);">Home</a>
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
</template>
<script>
export default {
    data(){
        return {

        }
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