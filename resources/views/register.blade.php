@extends('master')
@section("content")
<div class="container custom-login">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-4">
            <form action="register" method="POST">

                @csrf
                <div class="form-group">
                <label>Name</label>
                <input type="name" name="name" class="form-control"placeholder="Enter Name">
                </div>
                <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email">
                </div>
                <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control"placeholder="Enter Password">
                </div>
                <button type="submit" class="btn btn-default">Register</button>

            </form>
        </div>
    </div>
</div>
@endsection
