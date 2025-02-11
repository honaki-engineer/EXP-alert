<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        食品登録
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">

                <section class="text-gray-600 body-font relative">
                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="container px-5 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                            <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-full">
                                <div class="relative">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    <label for="name" class="leading-7 text-sm text-gray-600">食品名</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                </div>

                                <div class="p-2 w-full">
                                <div class="relative">
                                    <x-input-error :messages="$errors->get('expiration_type')" class="mt-2" />
                                    <label class="leading-7 text-sm text-gray-600">消費 or 賞味</label>
                                    <br>
                                    <input type="radio" name="expiration_type" value="0" {{ old('expiration_type') == 0 ? 'checked' : '' }}>消費期限
                                    <input type="radio" name="expiration_type" value="1" {{ old('expiration_type') == 1 ? 'checked' : '' }}>賞味期限
                                </div>
                                </div>

                                <div class="p-2 w-1/2">
                                <div class="relative">
                                    <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                                    <label for="deadline" class="leading-7 text-sm text-gray-600">有効期限</label>
                                    <input type="date" id="deadline" name="deadline" value="{{ old('deadline') }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                </div>
                                </div>

                                {{-- 画像 --}}
                                <div class="p-2 w-full">
                                    <div class="mb-1">
                                        <div class="relative">
                                            {{-- 画像選択 --}}
                                            <x-input-error :messages="$errors->get('image_path')" class="mt-2" />
                                            <label for="image_path" class="leading-7 text-sm text-gray-600">食品画像</label><br>
                                            <input type="file" id="image_path" name="image_path" accept="image/*" class="text-base file:text-base"
                                            onchange="previewImage(event)">
                                        </div>
                                        <div class="relative">
                                            {{-- プレビュー --}}
                                            <label for="image_path" class="leading-7 text-sm text-gray-600">選択した画像：</label>
                                            <img id="imagePreview" class="lg:w-3/6 md:w-4/6 w-4/6 object-cover object-center rounded" 
                                            src="{{ session('image_path') 
                                            ? asset('storage/tmp/' . session('image_path')) 
                                            : asset('storage/items/noImage.jpg') }}" 
                                            alt="画像プレビュー">
                                        </div>
                                    </div>
                                </div>
    
                                <div class="p-2 w-full">
                                <div class="relative">
                                    <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                                    <label for="comment" class="leading-7 text-sm text-gray-600">コメント</label>
                                    <textarea id="comment" name="comment" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('comment') }}</textarea>
                                </div>
                                </div>

                                <div class="p-2 w-full">
                                <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">食品を登録する</button>
                                </div>
                                
                            </div>
                            </div>
                        </div>
                    </form>
                </section>
              </div>
          </div>
      </div>
  </div>
{{-- 日付クリック有効範囲を全域にする --}}
<script>
document.getElementById("deadline").addEventListener("click", function() {
    this.showPicker(); // Chrome でカレンダーを開く
});

// プレビューを変更
function previewImage(event) {
    const input = event.target; // input要素を取得
    const reader = new FileReader(); // FileReader オブジェクトを作成

    reader.onload = function() { // FileReader が画像を読み込み終わったら onload が発火
        const imagePreview = document.getElementById('imagePreview'); // プレビュー画像の要素を取得
        imagePreview.src = reader.result;  // 選択した画像をプレビューで表示
    };

    if (input.files && input.files[0]) { // ファイルが選択されている場合
        reader.readAsDataURL(input.files[0]);  // 画像ファイルを読み込む
    }
}
</script>
</x-app-layout>
