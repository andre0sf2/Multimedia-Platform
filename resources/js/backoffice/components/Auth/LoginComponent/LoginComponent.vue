<template>
    <div class="card">
        <div class="card-header">Login</div>

        <div class="card-body">
            <form method="POST" @submit.prevent="doLogin">
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label text-md-right">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control"
                            name="email" value="" v-model="email" required autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control"
                            name="password" required v-model="password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'c-login',
        props: {

        },
        data(){
            return {
                email: '',
                password: ''
            }
        },
        methods:{
            doLogin: function(){
                let data = {
                    email: this.email,
                    password: this.password
                };

                axios.post('/api/login', data).then(function (response) {
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.success.token;
                    axios.get('/api/view').then();
                }).catch(function (error) {
                    console.log(error);
                })
            }
        },
        mounted(){
            
        }
    }
</script>