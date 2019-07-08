<template>
    <div class="container">
        <div class="row justify-content-sm-center">
            <div class="col-sm-6 col-md-4">

                <div class="card border-dark text-center">
                    <div class="card-header">
                        Sign in to continue
                    </div>
                    <div class="card-body">
                        <form class="form-group" @submit.prevent="login">
                            <label for="email">Email </label>
                            <input type="text" class="form-control" id='email' placeholder="Email" required
                                   autofocus>


                            <label for="password">Password </label>
                            <input type="password" class="form-control " id="password" placeholder="Password"
                                   required>

                            <br>

                            <label class="checkbox float-left">
                                <input type="checkbox" value="remember-me">
                                Remember me
                            </label>
                            <br>


                            <button class="btn  btn-primary btn-block" type="submit">
                                Sign in
                            </button>
                            <a href="#" class="float-right">Need help?</a>
                        </form>
                    </div>
                </div>
                <router-link class="float-left " to="/register">
                    Create an Free Account
                </router-link>

            </div>
        </div>
    </div>

</template>
<script>
    export default {
        name: 'Login',
        form:{
            email:'',
            password:'',
        },
        methods:{
            login(){
                axios.post('api/v1/login',this.form)
                    .then(res => {
                       console.log(res)
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        }
    }
</script>

