<?php

namespace App\Http\Controllers\Dashboard\Commission;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommissionController extends Controller{

    
    public function index(Request $request)
    {
        $perPage = 10;
        
        $commissions = Commission::withCount(['teachers', 'projects'])->paginate($perPage);
    
        return view('dashboard.commission.index', compact('commissions'));
    }

    public function create(){
        return view('dashboard.commission.create');
    }

    public function store(Request $request){
      
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required',
            'name_fr' => 'required', 
             
        ], [
            'name_ar.required' => 'The name in arabic is required.',
            'name_fr.required' => 'The name in franche is required.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $commission = new Commission;
        $commission->name_ar = $request->input('name_ar');
        $commission->name_fr = $request->input('name_fr');
        $commission->status = 1;
        $commission->save();
        toastr()->success(trans('message.success.create'));
        return redirect()->route('dashboard.commission.index');
    }

    public function edit($id)
    {
        $commission = Commission::find($id);
        if (!$commission) {
            return redirect()->route('dashboard.commission.index')->with('error', 'Commission not found.');
        }
        return view('dashboard.commission.edit', compact('commission'));
    }

    // دالة update لتحديث بيانات العمولة
    public function update(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_fr' => 'required|string|max:255',
        ]);

        // البحث عن السجل في قاعدة البيانات
        $commission = Commission::find($id);
        if (!$commission) {
            return redirect()->back()->with('error', 'Commission not found.');
        }

        // تحديث بيانات العمولة
        $commission->name_ar = $request->input('name_ar');
        $commission->name_fr = $request->input('name_fr');
        $commission->save();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('dashboard.commission.index')->with('success', trans('message.success.update'));
    }

    // دالة destroy لحذف بيانات العمولة
    public function destroy($id)
    {
        $commission = Commission::find($id);
        if (!$commission) {
            return redirect()->route('dashboard.commission.index')->with('error', 'Commission not found.');
        }

        $commission->delete();

        return redirect()->route('dashboard.commission.index')->with('success', trans('message.success.delete'));
    }
}
