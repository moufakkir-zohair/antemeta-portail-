<?php

namespace App\Http\Controllers;
use App\Models\Probe;
use App\Models\Core;
use App\Models\HistoryProbe;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProbeController extends Controller
{
    public function CreateProbes($probesAPI = [] , Core $core=null){
        foreach($probesAPI as $probe){
            Probe::create([
                'core_id' => $core->id,
                'objid' => $probe['objid'],
                'name' => $probe['name'],
                'status' => $probe['condition'],
                'changed' => true
            ]);
        }
    }

    // update or create function 

    public function UpdateProbes($probesAPI = [] , Core $core=null){
        foreach($probesAPI as $probe){
            $probeByid = Probe::where('core_id', $core->id)->where('objid', $probe['objid'])->first();
            if($probeByid){
                   $probeByid->update([
                       'core_id' => $core->id,
                       'objid' => $probe['objid'],
                       'name' => $probe['name'],
                       'status' => $probe['condition'],
                       'changed' => true,
                   ]);
            }else{
               Probe::create([
                   'core_id' => $core->id,
                   'objid' => $probe['objid'],
                   'name' => $probe['name'],
                   'status' => $probe['condition'],
                   'changed' => true,
                   ]); 
            }
       }
    }


    public function ReinitialiserProbes(){
        $probesDB = Probe::all(); 
        foreach($probesDB as $probe){
            if($probe->changed){
                $probe->update([
                    'changed' => false,
                ]);
            }else{
                $probe->update([
                    'status' => 'Deleted',
                    'changed' => false,
                ]);
            }
        }
    }

    public function AddHistoryProbes($probesDB=[]){
        foreach($probesDB as $probe){
            HistoryProbe::create([
                'core_id' => $probe->core_id,
                'objid' => $probe->objid,
                'name' => $probe->name,
                'status' => $probe->status,
            ]);
        }
    }

    public function index()
    {   
        try{
            $cores = Core::all();
            if($cores->count()){
                $probesDB = Probe::all();
                $this->AddHistoryProbes($probesDB);
                foreach($cores as $core ){
                    $probesAPI = Http::get($core->core_url.'api/table.json?columns=objid,name,condition&filter_type=probenode&username='.$core->core_username.'&passhash='.$core->core_passhash)->json()[""];
                    if($probesDB->count()){
                        $this->UpdateProbes($probesAPI,$core);
                    }else{
                        $this->CreateProbes($probesAPI,$core);
                    }
                }
                $this->ReinitialiserProbes();
            }
            Log::channel('info')->info("UPDATE_PROBES : probes probes are updated ".$core->core_name);   
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
        
    }



    public function Core_History (){
        $cores = Core::all();
        foreach($cores as $core ){
            $probes = file_get_contents($core->core_url.'api/gettreenodestats.xml?username='.$core->core_username.'&passhash='.$core->core_passhash);
            $xml = simplexml_load_string($probes, 'SimpleXMLElement', LIBXML_NOCDATA);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
            echo $json;
        }
    }
}
