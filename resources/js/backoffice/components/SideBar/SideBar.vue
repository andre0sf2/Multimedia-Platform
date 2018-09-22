<template>
    <nav class="col-md-2 d-none d-md-block bg-dark sidebar" style="min-height: calc(100vh - 56.84px);">
        <div class="sidebar-sticky">

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Pages</span>
                <a class="d-flex align-items-center text-muted" href="#">
                    <span data-feather="plus-circle"></span>
                </a>
            </h6>
            <ul class="nav flex-column my-2">
                <li v-for="(menu, i) in menus" :key="i" class="nav-item">
                    <router-link class="nav-link" tag="a" :to="menu.path">
                        <span data-feather="file-text"></span>
                        {{menu.component.name}}
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
    export default {
        name: 'side-bar',
        props: {

        },
        data() {
            return {
               menus: [] 
            }
        },
        methods: {

        },
        mounted() {
            console.log(this.$router.options.routes);
            this.menus = this.$router.options.routes;
        }
    }
</script>