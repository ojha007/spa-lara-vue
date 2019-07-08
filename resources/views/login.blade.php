<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<body>
<div class="container" style="padding-top: 100px">
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
            @if(session()->has('message'))
                <div class="alert alert-danger" role="alert">
                    {{session()->get('message')}}
                </div>
            @endif
            <div class="card border-dark text-center">
                <div class="card-header">
                    Sign in to continue
                </div>
                <div class="card-body">
                    <form class="form-group" action="{{route('login')}}" method="post">
                        <label for="email">Email </label>
                        <input type="email"
                               class="form-control"
                               id='email'
                               placeholder="Email"
                               name="email"
                               required
                               autofocus>
                        <label for="password">Password </label>
                        <input type="password"
                               class="form-control"
                               id="password"
                               placeholder="Password"
                               name="password"
                               required

                        >

                        <br>
                        <label class="checkbox float-left">
                            <input type="checkbox" value="remember-me" name="remember_me">
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
            <a href="{{route('showRegisterForm')}}" class="float-right">
                Create an Free Account
            </a>

        </div>
    </div>
</div>
</body>
<style>
    body {
        background: #37474f;
    }

    .card, input[type="email"], input[type="password"], input[type="checkbox"] {
        background: #90a4ae;
    }

</style>

