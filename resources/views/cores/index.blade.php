@extends('layouts/layout')
@section('content')
      <div class="row">
          <div class="col-md-12 main-datatable">
              <div class="card_body">
                  <div class="row d-flex">
                      <div class="col-sm-4 createSegment"> 
                       <a class="btn dim_button create_new" href="{{route('cores.create')}}"> <span><i class="fa fa-plus-square-o" aria-hidden="true"></i></span> Create New</a>
                      </div>
                      <div class="col-sm-8 add_flex">
                          <div class="form-group searchInput">
                              <label for="search">Search:</label>
                              <input type="search" class="form-control" id="filterbox" placeholder=" ">
                          </div>
                      </div> 
                  </div>
                  <div class="overflow-x">
                      <table style="width:100%;" id="filtertable" class="table cust-datatable dataTable no-footer">
                          <thead>
                              <tr>
                                  <th style="min-width:150px;">Name</th>
                                  <th style="min-width:150px;">Url</th>
                                  <th style="min-width:100px;">Username</th>
                                  <th style="min-width:100px;">Date</th>
                                  <th style="min-width:150px;">Action</th>
                              </tr>
                          </thead>
                          <tbody>

                          @foreach ($cores as $core)
                            <tr>
                                <td>{{$core->core_name}}</td>
                                <td>{{$core->core_url}}</td>
                                <td>{{$core->core_username}}</td>
                                <td>{{$core->created_at->format('d/m/Y')}}</td>
                                <td> 
                                  <span class="actionCust">
                                    <a href="{{route('cores.edit',['core'=>$core])}}"><i class="fa fa-pencil-square-o"></i></a>
                                  </span>
                                  <span class="actionCust">
                                    <a href="" data-toggle="modal" data-target="#deletemodel{{$core->id}}" ><i class="fa  fa-trash"></i></a>
                                  </span>
                                  <span class="actionCust">
                                    <a href="" data-toggle="modal" data-target="#showmodel{{$core->id}}"><i class="fa  fa-info-circle"></i></a>
                                  </span>
                                </td>



                                <div class="modal fade" id="deletemodel{{$core->id}}" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <form action="{{ route('cores.destroy',['core'=>$core])}}" method="POST">
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

                              
                                <div class="modal fade" id="showmodel{{$core->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="show" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title">Detail of core</h5>
                                          <button aria-hidden="true" data-dismiss="modal" class="close"
                                            type="button">×</button>
                                        </div>
                                        <div class="modal-body">
                                          <?php 
                                          $probes = file_get_contents($core->core_url.'api/gettreenodestats.xml?username='.$core->core_username.'&passhash='.$core->core_passhash);
                                          $xml = simplexml_load_string($probes, 'SimpleXMLElement', LIBXML_NOCDATA);
                                          $json = json_encode($xml);
                                          $array = json_decode($json,TRUE);
                                          ?>
                                          <h5>total sensor : {{$array['totalsens']}}</h5> 
                                          <h5>up sensor : {{$array['upsens']}}</h5> 
                                          <h5> down sensor : {{$array['downsens']}}</h5> 
                                          <h5> warning sensor : {{$array['warnsens']}}</h5> 
                                          <h5> downack sensor : {{$array['downacksens']}}</h5> 
                                          <h5> partial down sensor : {{$array['partialdownsens']}}</h5> 
                                          <h5> unusual sensor : {{$array['unusualsens']}}</h5> 
                                          <h5> paused sensor : {{$array['pausedsens']}}</h5> 
                                          <h5> undefined sensor: {{$array['undefinedsens']}}</h5> 
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
                                        </div>
                                      </div>
                                    </div>
                                </div> 
                            </tr>
                          @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
@endsection

@section('script')
<script>
       $(document).ready(function() {
        var dataTable = $('#filtertable').DataTable({
          "pageLength":5,
          'aoColumnDefs':[{
              'aTargets':['nosort'],
          }],
          "bLengthChange":false,
          "dom":'<"top">ct<"top"p><"clear">'
        });
        $("#filterbox").keyup(function(){
          dataTable.search(this.value).draw();
        });
      });

      $('#deletemodel').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget)
			var modal = $(this)
		  })


        $('#deletemodel').on('show.bs.modal',function(event){
            var button = $(event.relatedTarget)
            var modal=$(this)
        })
</script>
@endsection
