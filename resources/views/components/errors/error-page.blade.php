<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $code }} | {{ $title }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen overflow-y-scroll">

    {{-- ヘッダー --}}
    <header class="bg-gray-200 shadow">
        <div class="container mx-auto">
            <div class="px-4 py-4 flex justify-between items-center">
                <a href="{{ route('items.index') }}">
                    <h1 class="text-xl font-bold">消費期限管理アプリ</h1>
                </a>
            </div>
        </div>
    </header>

    {{-- メイン --}}
    <main class="flex-grow flex flex-col justify-center items-center text-center px-4">
        <h2 class="text-xl font-bold mb-2">{{ $code }} | {{ $title }}</h2>
        <p class="mb-6">{!! $message !!}</p>
        <a href="{{ route('items.index') }}"
            class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 transition text-lg">
            食品一覧へ戻る
        </a>
    </main>

    {{-- フッター --}}
    <footer class="shadow bg-gray-200 py-4 text-center text-sm text-gray-500">
        © {{ date('Y') }} {{ config('app.name') }} All rights reserved
    </footer>

</body>
</html>
