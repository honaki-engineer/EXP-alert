<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        食品詳細
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">

                <section class="text-gray-600 body-font relative">
                    
                        <div class="container px-5 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                            <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">食品名</label>
                                    <div class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $item->name }}</div>
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label class="leading-7 text-sm text-gray-600">消費 or 賞味</label>
                                    <br>
                                    <div class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $item->expiration_label }}</div>
                                </div>
                                </div>
                                <div class="p-2 w-1/2">
                                <div class="relative">
                                    <label for="deadline" class="leading-7 text-sm text-gray-600">有効期限</label>
                                    <div class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $item->deadline }}</div>
                                </div>
                                </div>
                                {{-- 画像 --}}
                                <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="image_path" class="leading-7 text-sm text-gray-600">食品画像</label><br>
                                        <img class="lg:w-2/6 md:w-3/6 w-5/6 object-cover object-center rounded" 
                                        alt="食品画像" 
                                        src="{{ asset('storage/' . (optional($item)->image_path ?? 'items/noImage.jpg')) }} ">
                                </div>
                                </div>
                                <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="comment" class="leading-7 text-sm text-gray-600">コメント</label>
                                    <div class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $item->comment }}</div>
                                </div>
                                </div>

                                <form action="{{ route('items.edit', ['item' => $item->id]) }}" method="get">
                                    <div class="p-2 w-full">
                                    <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">編集する</button>
                                    </div>
                                </form>
                                
                            </div>
                            </div>
                        </div>

                </section>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
