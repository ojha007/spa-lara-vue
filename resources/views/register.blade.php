<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
<div class="container" style=" margin-top: 139px;">
    <div class="row justify-content-sm-center">
        <div class="col-sm-6 col-md-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card border-dark text-center">
                <div class="card-header">
                    Register for Free
                </div>
                <div class="card-body">
                    <form class="form-group" method="post" action="{{route('register')}}">
                        <label for="username">User Name</label>
                        <input type="text" class="form-control"
                               name="username"
                               id='username'
                               placeholder="Username" required
                               autofocus
                        >
                        <label for="email">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               id='email' placeholder="Email"
                               required
                               autofocus>

                        <label for="password">Password </label>
                        <input type="password" class="form-control " id="password" placeholder="Password"
                               name="password" required>

                        <label for="password_confirmation">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation"
                               placeholder="Confirm your password"
                               name="password_confirmation"
                               required>
                        <br>

                        <label class="checkbox float-left">
                            <input type="checkbox" value="remember-me">
                            Remember me
                        </label>
                        <br>
                        <button class="btn  btn-primary btn-block" type="submit">
                            Register
                        </button>

                        <a href="#" class="float-right">Need help?</a>
                        <a href="{{route('showLoginForm')}}" class="float-left">
                            Already have an account ?
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<style>
    body {
        background: #37474f;
    }

    .card, input[type="text"], input[type="email"], input[type="password"], input[type="checkbox"] {
        background: #90a4ae;
    }

</style>
