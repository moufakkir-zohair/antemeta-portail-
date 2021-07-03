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
                    <button class="btn btn-danger" data-toggle="modal" data-target="#deletemodel" style="padding-left: 4px;padding-right: 4px;"><i class="fa fa-trash" aria-hidden="true" ></i>Supprimer</button>
            </td>
            <div class="modal fade" id="deletemodel" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <form action="{{ route('Cores.destroy',['Core'=>$core->id])}}" method="POST">
                  @csrf
                  @method('DELETE')
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete core</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                  </div>
                  <div class="modal-body">
                  <input type="hidden" name="message" >Do you want to remove this core? </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger"> Yes </button>
                  </div>
                </div>
              </form>
              </div>
            </div>
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

        $('#deletemodel').on('show.bs.modal',function(event){
        var button = $(event.relatedTarget)
       // var delete_id=button.data('delete_id')
        
        var modal=$(this)
        //modal.find('.modal-body #delete_id').val(delete_id);
        
       })
    </script>
@endsection
