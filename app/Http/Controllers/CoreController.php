<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoreRequest;
use App\Http\Requests\UpdateCoreRequest;
use App\Models\Core;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CoreController extends Controller
{
  
    public function index()
    {
        try{
             $cores  = Core::all();
             return view("cores.index", compact('cores'));
             Log::info("l'utilisateur xxxx exécute l'action index de Core");
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function create()
    {
        try{
            Log::info("l'utilisateur xxxx exécute l'action create de Core");
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
                'core_passhash' => Hash::make($request->get('core_passhash')),
            ]);
            flash(sprintf("core %s is added successfully",$request->get('core_username')),'primary');
            Log::info("l'utilisateur xxxx exécute l'action store de Core");
            return redirect()->route("cores.index");
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function edit(Core $core)
    {
        try{
            Log::info("l'utilisateur xxxx exécute l'action edit de Core");
            return view('cores.edit',compact('core'));
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }

    public function update(UpdateCoreRequest $request, Core $core)
    {
        try{
            $core->update([
                'core_name' => $request->get('core_name'),
                'core_username' => $request->get('core_username'),
                'core_url' => $request->get('core_url'),
                'core_passhash' =>  Hash::make($request->get('password')),
            ]);
            flash(sprintf("core %s is updated successfully",$core->core_username),'success');
            Log::info("l'utilisateur xxxx exécute l'action update de Core");
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
            Log::info("l'utilisateur xxxx exécute l'action destroy de Core");
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
            Log::info("l'utilisateur xxxx exécute l'action restore de Core");
            return redirect()->route("cores.index");
        }catch(Exception $e){
            Log::error($e->getMessage());
        }
    }
}
