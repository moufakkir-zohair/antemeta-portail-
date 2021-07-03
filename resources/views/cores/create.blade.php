@extends('layouts/layout')
@section('content')
<h1>Add core</h1>
    <form method="POST" action="{{route('Cores.store')}}">
           @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="core_name" placeholder="Name"/>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" name="core_username" placeholder="Username">
            </div>
            <div class="form-group">
              <label>Url</label>
              <input type="url" class="form-control" name="core_url" placeholder="https://.....">
            </div>
            <div class="form-group">
              <label>password</label>
              <input type="text" class="form-control" name="password" placeholder="********">
            </div>
            <button  class="btn btn-block btn-primary" type="submit"> Add core</button>
    </form>
@endsection