<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Services\ItemControllerService;
use App\Http\Requests\ItemFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $search = $request->search;

        /** @var \App\Models\User $user */
        $items = Auth::user()
        ->items()
        ->search($search)
        ->orderBy('deadline', 'asc')
        ->paginate(10);

        foreach($items as $item) {
            if($item->deadline) {
                // 過ぎていたらアラーム
                $item->is_lt_deadline = Carbon::parse($item->deadline)->lt(today()); //less than
            
                // 3日以内に期限がくるアラーム
                $item->is_near_deadline = Carbon::parse($item->deadline)->gte(today()) // 今日以降のみ対象
                && Carbon::parse($item->deadline)->diffInDays(today()) <= 3;
            }

            // テーブル内の数字を日本語に変換
            ItemControllerService::expirationChangeLabel($item);
        }
        

        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemFormRequest $request)
    {
        $imagePath = null;

        // 画像がアップロードされた場合
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path');

            $imageName = time() . '.' . $imagePath->getClientOriginalExtension();
            
            // 'root' => storage_path('app/public'),
            $imagePath->storeAs('items', $imageName);
        }
        
        // 保存
        Item::create(ItemControllerService::storeItemRequestData($request, $imageName));
        

        return to_route('items.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Auth::user()->items()->findOrFail($id);

        // テーブル内の数字を日本語に変換
        ItemControllerService::expirationChangeLabel($item);

        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Auth::user()->items()->findOrFail($id);

        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemFormRequest $request, $id)
    {
        $item = Auth::user()->items()->findOrFail($id);

        $imagePath = $item->image_path; // 既存の画像を取得

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path');

            $imageName = time() . '.' . $imagePath->getClientOriginalExtension();
            
            $imagePath->storeAs('items', $imageName);
        }

        // 更新
        $item->update(ItemControllerService::updateItemRequestData($request, $imageName));


        return to_route('items.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Auth::user()->items()->findOrFail($id);

        // 🔹 画像が `storage/app/public/items/` に存在する場合、削除
        if ($item->image_path) {
            // if('items/' . $item->image_path !== )
            Storage::disk('public')->delete('items/' . $item->image_path);
        }

        $item->delete();

        return to_route('items.index');
    }
}
