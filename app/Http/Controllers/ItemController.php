<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Services\ItemControllerService;
use App\Http\Requests\ItemFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $items = Auth::user()->items()->get();

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
            $imagePath = $request->file('image_path')->store('items', 'public');
        }

        // 保存
        Item::create(ItemControllerService::storeItemRequestData($request, $imagePath));

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
        if($item->expiration_type === 0){$item->expiration_label = '消費期限';}
        if($item->expiration_type === 1){$item->expiration_label = '賞味期限';}

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

        $imagePath = $item->image_path; // 既存の画像パスを取得

        // 新しい画像がアップロードされた場合
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('items', 'public');
        }

        // 更新
        $item->update(ItemControllerService::updateItemRequestData($request, $imagePath));

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
        $item->delete();

        return to_route('items.index');
    }
}
