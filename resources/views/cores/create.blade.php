@extends('layouts/layout')
@section('content')
<h1>Add core</h1>
    <form method="POST" action="{{route('Cores.store')}}">
           @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="core_name" placeholder="Name" value="{{old('core_name')}}"/>
                <span style="color: red">
                    @error('core_name')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" name="core_username" placeholder="Username"  value="{{old('core_username')}}">
              <span style="color: red">
                @error('core_username')
                    {{$message}}
                @enderror
            </span>
            </div>
            <div class="form-group">
              <label>Url</label>
              <input type="url" class="form-control" name="core_url" placeholder="https://....."  value="{{old('core_url')}}">
              <span style="color: red">
                @error('core_url')
                    {{$message}}
                @enderror
            </span>
            </div>
            <div class="form-group">
              <label>password</label>
              <input type="password" class="form-control" name="password" placeholder="********" value="{{old('password')}}">
              <span style="color: red">
                @error('password')
                    {{$message}}
                @enderror
            </span>
            </div>
            <button  class="btn btn-block btn-primary" type="submit"> Add core</button>
    </form>
@endsection