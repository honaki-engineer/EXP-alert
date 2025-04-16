<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GuestLoginController extends Controller
{
    public function login(Request $request)
    {
        // 🔐 リファラーをチェック
        $referer = $request->headers->get('referer');
        if (!$referer || !str_contains($referer, 'https://akkun1114.com/collections')) {
            abort(403, 'このページにはアクセスできません');
        }

        // ✅ ゲストユーザーを取得 or 作成
        $guestUser = User::firstOrCreate(
            ['email' => 'guest@example.com'],
            [
                'name' => 'ゲスト',
                'password' => bcrypt('guestpassword'), // 初回だけ実行
            ]
        );

        Auth::login($guestUser);

        return redirect('/'); // 任意のページにリダイレクト
    }
}

