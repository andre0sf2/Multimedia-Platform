<template>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">
            <img src="/storage/icons/logo.png" width="30" height="30" alt=""> BackOffice
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li v-if="user" class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{user.name}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/settings">Settings</a>
                        <a class="dropdown-item" v-on:click="doLogout" href="/logout">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script>
    export default {
        name: 'navbar-vue',
        props: {
            user: {
                type: Object
            }
        },
        data(){
            return {

            }
        },
        methods: {
            checkUser: function(){
                if(this.user){
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.user.api_token;
                    localStorage.setItem('token', this.user.api_token);
                }else{
                    var a = document.createElement("A");
                    a.href="/login";
                    a.click();
                }
            },
            doLogout: function() {
                axios.get('api/logout/'+this.user.id).then(function(response){
                    console.log(response);
                });
                localStorage.removeItem('token');
                delete axios.defaults.headers.common['Authorization'];
            }
        },
        mounted(){
            this.checkUser();
        },
        computed:{

        }
    }
</script>