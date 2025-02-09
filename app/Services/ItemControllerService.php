<?php 
namespace App\Services;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemControllerService
{
  public static function storeItemRequestData($request, $imagePath){
    return[
      'name' => $request->name,
      'expiration_type' => $request->expiration_type,
      'deadline' => $request->deadline,
      'image_path' => $imagePath,
      'comment' => $request->comment,
      'user_id' => Auth::id(),
    ];
  }

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