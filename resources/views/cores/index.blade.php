@extends('layouts/layout')
@section('content')

    <a href="{{route('Cores.create')}}" class="btn btn-primary" style="margin-top: 2%; margin-bottom:2%;">Add core <i class="fa fa-plus-square-o" aria-hidden="true"></i></a>

    <table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Url</th>
            <th>Username</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cores as $core)
        <tr>
           
            <td>{{$core->core_name}}</td>
            <td>{{$core->core_url}}</td>
            <td>{{$core->core_username}}</td>
            <td> 
                    <button class="btn btn-success" data-toggle="modal" data-target="#editmodel" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Modifier</button> 
                    <button class="btn btn-danger" data-toggle="modal" data-target="#deletemodel"  style="padding-left: 4px;padding-right: 4px;"><i class="fa fa-trash" aria-hidden="true" ></i>Supprimer</button>
            </td>
           
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endsection
