<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    public function index(){
        $packages = Package::all()->sortByDesc("created_at");
        return view("admin.dashboard",["packages" => $packages]);
    }

    public function create(){
        return view("admin.create");
    }

    public function store(Request $request){
        $package = $request->validate([
            "name" => "required | max:255",
            "price" => "required | numeric",
            "description" => "required | max:255"
        ]);

        Package::create($package);
        return redirect('/admindashboard')->with('success','Package created successfully');
    }

    public function destroy($id){
        $package = Package::find($id);
        $package->delete();
        return redirect('/admindashboard')->with('success','Package Deleted Successfully');
    }
}
