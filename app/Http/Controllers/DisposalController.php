<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\DisposalModel;
use App\Models\CategoryAssetsModel;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class DisposalController extends Controller
{
    public function list()
    {
        $getRecord = DisposalModel::where('is_delete', 0)
                            ->with(['asset'])
                            ->selectRaw('MAX(id) as id')
                            ->groupBy('asset_id')
                            ->pluck('id');

         $getRecord = DisposalModel::with(['asset'])
                            ->whereIn('id', $getRecord)
                            ->orderByDesc('disposal_date')
                            ->paginate(10);

        return view('disposal.list', compact('getRecord'));
    }

    public function add():View
    {
        $getCategoryAsset = CategoryAssetsModel::getCategoryAsset();
        return view ('disposal.add', compact('getCategoryAsset'));
    }
    public function insert(Request $request)
    {
        $request->validate([
            'category_assets_id' => 'required',
            'asset_id' => 'required',
            'disposal_date' => 'required',
            'disposal_reason' => 'required',
            'disposal_method' => 'required',
            'support_doc' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:25600',
        ]);

        $disposal = new DisposalModel();
        $disposal->category_assets_id = $request->category_assets_id;
        $disposal->asset_id = $request->asset_id;
        $disposal->disposal_date = $request->disposal_date;
        $disposal->disposal_reason = $request->disposal_reason;
        $disposal->disposal_method = $request->disposal_method;
        if ($request->hasFile('support_doc') && $request->file('support_doc')->isValid()) {
            $file = $request->file('support_doc');
            $ext = $file->getClientOriginalExtension();
            $filename = strtolower(Str::random(20)) . '.' . $ext;
            $file->move('upload/disposal_docs/', $filename);
            $disposal->support_doc = $filename;
        }
        $disposal->is_delete = 0;
        $disposal->save();

        return redirect('/disposal/list')->with('success', 'Disposal record added successfully');
    }
    public function edit($id):View
    {
        $getRecord = DisposalModel::getSingle(base64_decode($id));

        if ($getRecord) {
            $getCategoryAsset = CategoryAssetsModel::getCategoryAsset();
            return view('disposal.edit', compact('getRecord','getCategoryAsset'));
        }
        else {
            abort(code:404);
        }
    }
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'category_assets_id' => 'required',
            'asset_id' => 'required',
            'disposal_date' => 'required',
            'disposal_reason' => 'required',
            'disposal_method' => 'required',
            'support_doc' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:25600',
        ]);

        // Dapatkan rekod lama
        $old = DisposalModel::findOrFail($id);

        // Fail upload (jika ada)
        $filename = $old->support_doc; // simpan nama lama
        if ($request->hasFile('support_doc') && $request->file('support_doc')->isValid()) {
            $file = $request->file('support_doc');
            $ext = $file->getClientOriginalExtension();
            $filename = strtolower(Str::random(20)) . '.' . $ext;
            $file->move('upload/disposal_docs/', $filename);
        }

        // Buat rekod baru (untuk simpan perubahan)
        $newRecord = DisposalModel::create([
            'category_assets_id' => $old->category_assets_id,
            'asset_id'           => $old->asset_id,
            'disposal_date'      => $request->disposal_date,
            'disposal_reason'    => $request->disposal_reason,
            'disposal_method'    => $request->disposal_method,
            'support_doc'        => $filename,
        ]);



        return redirect('/disposal/view/' . base64_encode($newRecord->asset_id))
            ->with('success', 'Disposal saved and history recorded successfully.');
    }

    public function view($id)
    {
        $assetId = base64_decode($id);

        $getRecord = \App\Models\AssetsModel::with([
            'brand',
            'categoryAsset',
            'company',
            'category',
            'user',
            'location',
            'disposals' => function ($q) {
                $q->where('is_delete', 0)->orderByDesc('disposal_date');
            }
        ])->findOrFail($assetId);

        return view('disposal.view', compact('getRecord'));
    }

    public function delete($id):RedirectResponse
    {
        $assets = AssetsModel::findOrFail($id);
        $assets->is_delete = 1; 
        $assets ->save();
        
        return redirect() -> route('disposal.list') ->with('success','Disposal record deleted sucessfully');
    }
}
