<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          食品一覧
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                    
                    <form class="mb-8" action="{{ route('items.index')}}" method="get">
                        <input type="text" name="search" placeholder="検索">
                        <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">検索</button>
                    </form>
                    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <table class="whitespace-nowrap table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                            <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">詳細</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">食品名</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">期限</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">種類</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">コメント</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr @class(['bg-red-100 text-red-700' => $item->is_near_deadline])>
                            <td class="border-t-2 border-gray-200 px-4 py-3"><a class="text-blue-500" href="{{ route('items.show', ['item' => $item->id]) }}">詳細</a></td>
                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->name }}</td>
                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->deadline }}</td>
                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->expiration_label }}</td>
                            <td class="border-t-2 border-gray-200 px-4 py-3 max-w-xs overflow-auto">{{ $item->comment }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                    {{ $items->links() }}
              </div>
          </div>
      </div>
  </div>
<!-- フローティングボタン -->
<a href="{{ route('items.create') }}"
class="sm:hidden fixed z-50 bottom-4 right-4 w-12 h-12 bg-blue-500 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-blue-700">
<!-- アイコン（プラス記号） -->
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
</svg>
</a>
</x-app-layout>
