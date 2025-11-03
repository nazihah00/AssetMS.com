<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use App\Models\RelocationModel;
use App\Models\CategoryAssetsModel;
use App\Models\UserAssetModel;
use App\Models\LocationModel;
use App\Models\AssetsModel;

class RelocationController extends Controller
{
    /**
     * Paparkan senarai relocation (hanya yang latest bagi setiap asset)
     */
    public function list(): View
    {
        $latestRelocations = RelocationModel::where('is_delete', 0)
            ->selectRaw('MAX(id) as id')
            ->groupBy('asset_id')
            ->pluck('id');

        $getRecord = RelocationModel::with(['asset', 'newUser', 'newLocation'])
            ->whereIn('id', $latestRelocations)
            ->orderByDesc('relocation_date')
            ->paginate(10);

        return view('relocation.list', compact('getRecord'));
    }

    /**
     * Paparkan borang tambah relocation
     */
    public function add(): View
    {
        $getCategoryAsset = CategoryAssetsModel::getCategoryAsset();
        $getUserAsset = UserAssetModel::getUserAsset();
        $getLocation = LocationModel::getLocation();

        return view('relocation.add', compact('getCategoryAsset', 'getUserAsset', 'getLocation'));
    }

    /**
     * Simpan relocation baru
     */
    public function insert(Request $request): RedirectResponse
    {
        $request->validate([
            'category_assets_id' => 'required',
            'asset_id'           => 'required',
            'new_user_id'        => 'required',
            'new_location_id'    => 'required',
            'reason'             => 'required',
            'relocation_date'    => 'required',
            'attachment'         => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:25600',
        ]);

        $relocation = new RelocationModel();
        $relocation->category_assets_id = $request->category_assets_id;
        $relocation->asset_id = $request->asset_id;
        $relocation->new_user_id = $request->new_user_id;
        $relocation->new_location_id = $request->new_location_id;
        $relocation->reason = $request->reason;
        $relocation->relocation_date = $request->relocation_date;

        if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
            $file = $request->file('attachment');
            $ext = $file->getClientOriginalExtension();
            $filename = strtolower(Str::random(20)) . '.' . $ext;
            $file->move('upload/relocation_docs/', $filename);
            $relocation->attachment = $filename;
        }

        $relocation->save();

        // Kemas kini status asset semasa
        $asset = AssetsModel::find($request->asset_id);
        if ($asset) {
            $asset->assets_location_id = $request->new_location_id;
            $asset->assets_assigned_user_id = $request->new_user_id;
            $asset->assets_handover_date = $request->relocation_date;
            $asset->save();
        }

        return redirect()->route('relocation.list')->with('success', 'Relocation record added successfully.');
    }

    /**
     * Paparkan borang edit relocation
     */
    public function edit($id): View
    {
        $getRecord = RelocationModel::getSingle(base64_decode($id));

        if (!$getRecord) {
            abort(404);
        }

        $getCategoryAsset = CategoryAssetsModel::getCategoryAsset();
        $getUserAsset = UserAssetModel::getUserAsset();
        $getLocation = LocationModel::getLocation();

        return view('relocation.edit', compact('getRecord', 'getCategoryAsset', 'getUserAsset', 'getLocation'));
    }

    /**
     * Kemas kini relocation (dan cipta rekod baru untuk sejarah)
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $id = base64_decode($id);

        $request->validate([
            'category_assets_id' => 'required',
            'asset_id'           => 'required',
            'new_user_id'        => 'required',
            'new_location_id'    => 'required',
            'relocation_date'    => 'required',
            'reason'             => 'required',
            'attachment'         => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:25600',
        ]);

        $old = RelocationModel::findOrFail($id);

        // Simpan fail baru jika ada
        $filename = $old->attachment;
        if ($request->hasFile('attachment') && $request->file('attachment')->isValid()) {
            $file = $request->file('attachment');
            $ext = $file->getClientOriginalExtension();
            $filename = strtolower(Str::random(20)) . '.' . $ext;
            $file->move('upload/relocation_docs/', $filename);
        }

        // Cipta rekod baru untuk simpan perubahan
        $newRecord = RelocationModel::create([
            'category_assets_id' => $old->category_assets_id,
            'asset_id'           => $old->asset_id,
            'new_user_id'        => $request->new_user_id,
            'new_location_id'    => $request->new_location_id,
            'relocation_date'    => $request->relocation_date,
            'reason'             => $request->reason,
            'attachment'         => $filename,
        ]);

        // Kemas kini status semasa dalam jadual assets
        $asset = AssetsModel::find($request->asset_id);
        if ($asset) {
            $asset->assets_location_id = $request->new_location_id;
            $asset->assets_assigned_user_id = $request->new_user_id;
            $asset->assets_handover_date = $request->relocation_date;
            $asset->save();
        }

        return redirect()->route('relocation.view', base64_encode($newRecord->asset_id))
            ->with('success', 'Relocation saved and history recorded successfully.');
    }

    /**
     * Paparkan maklumat penuh relocation (history)
     */
    public function view($id): View
    {
        $assetId = base64_decode($id);

        $getRecord = AssetsModel::with([
            'brand',
            'categoryAsset',
            'company',
            'category',
            'user',
            'location',
            'relocations.newLocation',
            'relocations.newUser',
        ])->findOrFail($assetId);

        return view('relocation.view', compact('getRecord'));
    }

    /**
     * Padam relocation (soft delete)
     */
    public function delete($id): RedirectResponse
    {
        $assets = AssetsModel::findOrFail($id);
        $assets->is_delete = 1;
        $assets->save();

        return redirect()->route('relocation.list')->with('success', 'Relocation record deleted successfully.');
    }
}
