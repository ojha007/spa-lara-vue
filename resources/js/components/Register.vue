<template>
    <div class="container">
        <div class="row justify-content-sm-center">
            <div class="col-sm-6 col-md-4">

                <div class="card border-dark text-center">
                    <div class="card-header">
                        Register for Free
                    </div>
                    <div class="card-body">
                        <form class="form-group" method="post" @submit.prevent="register">
                            <label for="username">User Name</label>
                            <input type="text" class="form-control" id='username' placeholder="Username" required
                                   autofocus v-model="form.username">
                            <label for="email">Email </label>
                            <input type="email"
                                   class="form-control"
                                   id='email' placeholder="Email"
                                   required
                                   v-model="form.email"
                                   autofocus>

                            <label for="password">Password </label>
                            <input type="password" class="form-control " id="password" placeholder="Password"
                                   v-model="form.password" required>

                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                   placeholder="Confirm your password"
                                   v-model="form.password_confirmation" required>


                            <br>

                            <label class="checkbox float-left">
                                <input type="checkbox" value="remember-me" v-model="form.remember_me">
                                Remember me
                            </label>
                            <br>
                            <button class="btn  btn-primary btn-block" type="submit">
                                Register
                            </button>
                            <a href="#" class="float-right">Need help?</a>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        name: 'Register',
        data() {
            return {
                form: {
                    username: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    remember_me: ''
                }
            }
        },
        methods: {
            register() {
                axios.post('api/v1/register', this.form)
                    .then(res => {
                        console.log(res);
                        if (res.status === 200) {
                            localStorage.setItem('access_token', res.token);
                            this.$router.push('/user');
                        }
                    })
                    .catch(err => {
                        console.log(err);
                    })
            }
        }
    }
</script>

