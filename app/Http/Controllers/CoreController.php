<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoreRequest;
use App\Http\Requests\UpdateCoreRequest;
use App\Models\Core;
use App\Models\HistoryCore;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CoreController extends Controller
{
  
    public function index()
    {
        try{
             $cores  = Core::all();
             Log::channel('info')->info("DISPLAY_CORES : user xxx display the list of cores");
             return view("cores.index", compact('cores'));
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function create()
    {
        try{
            Log::channel('info')->info("CREATE_CORE : user xxx ask to create core");
            return view("cores.create");
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
        
    }

    public function store(StoreCoreRequest $request)
    {
        try{
            Core::create([
                'core_name' => $request->get('core_name'),
                'core_url' => $request->get('core_url'),
                'core_username' => $request->get('core_username'),
                'core_passhash' =>$request->get('core_passhash'),
            ]);
            flash(sprintf("core %s is added successfully",$request->get('core_username')),'primary');
            Log::channel('info')->info("STRORE_CORE : user xxx store the core ".$request->get('core_name'));
            return redirect()->route("cores.index");
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function edit(Core $core)
    {
        try{
            Log::channel('info')->info("EDIT_CORE : user xxx ask to edit the core ".$core->core_name);
            return view('cores.edit',compact('core'));
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function update(StoreCoreRequest $request, Core $core)
    {
        try{
            $core->update([
                'core_name' => $request->get('core_name'),
                'core_username' => $request->get('core_username'),
                'core_url' => $request->get('core_url'),
                'core_passhash' => $request->get('core_passhash'),
            ]);
            flash(sprintf("core %s is updated successfully",$core->core_username),'success');
            Log::channel('info')->info("UPDATE_CORE : user xxx update the core ".$core->core_name);
            return redirect()->route("cores.index");
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function destroy(Core $core)
    {
        try{
            $core->delete();
            flash(sprintf("core %s is deleted successfully ",$core->core_username),'danger',$core->id);
            Log::channel('info')->info("DESTROY_CORE : user xxx destroy the core ".$core->core_name);
            return redirect()->route("cores.index");
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function restore(int $id)
    {
        try{
            Core::onlyTrashed()->find($id)->restore();
            flash("core is restore successfully",'warning');
            Log::channel('info')->info("RESTORE_CORE : user xxx restore the core ".$id);
            return redirect()->route("cores.index");
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function historyCore(){
        try{
            $cores = Core::all();
            foreach($cores as $core ){
                $probes = file_get_contents($core->core_url.'api/gettreenodestats.xml?username='.$core->core_username.'&passhash='.$core->core_passhash);
                $xml = simplexml_load_string($probes, 'SimpleXMLElement', LIBXML_NOCDATA);
                $json = json_encode($xml);
                $array = json_decode($json,TRUE);
                HistoryCore::create([
                    'core_id' => $core->id ,
                    'prtg-version'=> $array['prtg-version'] ,
                    'totalsens'=> $array['totalsens'] ,
                    'upsens'=> $array['upsens'] ,
                    'downsens'=> $array['downsens'] ,
                    'warnsens'=> $array['warnsens'] ,
                    'downacksens'=> $array['downacksens'] ,
                    'partialdownsens'=> $array['partialdownsens'] ,
                    'unusualsens'=> $array['unusualsens'] ,
                    'pausedsens'=> $array['pausedsens'] ,
                    'undefinedsens'=> $array['undefinedsens'] ,
                ]);
            }
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }
}
