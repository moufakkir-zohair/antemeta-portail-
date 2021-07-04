<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCore;
use App\Http\Requests\StroreCoreRequest;
use Illuminate\Http\Request;
use App\Models\Core;
use Illuminate\Support\Facades\Hash;

class CoreController extends Controller
{
  
    public function index()
    {
        $cores  = Core::all();
        return view("cores.index", compact('cores'));
    }

    public function create()
    {
        return view("cores.create");
    }

    public function store(StroreCoreRequest $request)
    {
        Core::create([
            'core_name' => $request->get('core_name'),
            'core_url' => $request->get('core_url'),
            'core_username' => $request->get('core_username'),
            'core_passhash' => Hash::make($request->get('core_passhash')),
        ]);
        flash(sprintf("core %s is added successfully",$request->get('core_username')),'primary');
        return redirect()->route("cores.index");
    }

    public function show($id)
    {
        //
    }

    public function edit(Core $core)
    {
        return view('cores.edit',compact('core'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
