@extends('layouts/layout')
@section('content')
<h1>Edit core</h1>
    <form method="POST" action="{{route('cores.update',['core'=>$core->id])}}">
           @csrf
           @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control @error('core_name') is-invalid  @enderror"  name="core_name" placeholder="Name" value="{{old('core_name',$core->core_name)}}"/>
                <span style="color: red">
                    @error('core_name')
                        {{$message}}
                    @enderror
                </span>
            </div>
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control @error('core_username') is-invalid  @enderror"  name="core_username" placeholder="Username"  value="{{ old('core_username',$core->core_username)}}">
              <span style="color: red">
                @error('core_username')
                    {{$message}}
                @enderror
            </span>
            </div>
            <div class="form-group">
              <label>Url</label>
              <input type="url" class="form-control @error('core_url') is-invalid  @enderror"  name="core_url" placeholder="https://....."  value="{{ old('core_url',$core->core_url)}}">
              <span style="color: red">
                @error('core_url')
                    {{$message}}
                @enderror
            </span>
            </div>
            <div class="form-group">
              <label>password</label>
              <input type="text" class="form-control @error('core_passhash') is-invalid  @enderror"  name="core_passhash" placeholder="********" value="{{ old('core_passhash',$core->core_passhash)}}">
              <span style="color: red">
                @error('core_passhash')
                    {{$message}}
                @enderror
            </span>
            </div>
            <button  class="btn btn-block btn-warning" type="submit"> Edit core</button>
    </form>
@endsection