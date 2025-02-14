<?php 
namespace App\Services;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemControllerService
{
    // テーブル内の数字を日本語に変換
    public static function expirationChangeLabel($item) {
      if($item->expiration_type === 0){$item->expiration_label = '消費期限';}
      if($item->expiration_type === 1){$item->expiration_label = '賞味期限';}
      return $item;
    }

  // 保存
  public static function storeItemRequestData($request, $imagePath){
    return[
      'name' => $request->name,
      'expiration_type' => $request->expiration_type,
      'deadline' => $request->deadline,
      'image_path' => $imagePath, // 画像がある場合のみ保存
      'comment' => $request->comment,
      'user_id' => Auth::id(),
    ];
  }

  // 更新
  public static function updateItemRequestData($request, $imagePath){
    return[
      'name' => $request->name,
      'expiration_type' => $request->expiration_type,
      'deadline' => $request->deadline,
      'comment' => $request->comment,
      'image_path' => $imagePath,
    ];
  }
}

?>