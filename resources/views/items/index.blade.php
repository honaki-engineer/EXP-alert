<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          消費/賞味期限の一覧
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">
                    <a href="{{ route('items.create') }}" class="text-blue-500">食品登録</a><br>

                    <form class="mb-8" action="{{ route('items.index')}}" method="get">
                        <input type="text" name="search" placeholder="検索">
                        <button class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">検索</button>
                    </form>
                    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                        <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                            <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">詳細</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">食品名</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">種類</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">期限</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">コメント</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr @class(['bg-red-100 text-red-700' => $item->is_near_deadline])>
                            <td class="border-t-2 border-gray-200 px-4 py-3"><a class="text-blue-500" href="{{ route('items.show', ['item' => $item->id]) }}">詳細</a></td>
                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->name }}</td>
                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->expiration_type }}</td>
                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->deadline }}</td>
                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->comment }}</td>
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
</x-app-layout>
