<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-white leading-tight">
                積む
            </h2>
        </div>
    </x-slot>
    <div class="max-w-7xl mx auto px-6 text-white">
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif
        <form method="post" action="{{route('stack.store')}}" enctype="multipart/form-data">
        @csrf
            <div class="mt-8">
                <div class="w-full flex flex-col">
                    <label for="title" class="font-semibold mt-4">タイトル</label>
                    <x-input-error :messages="$errors->get('title')" class="mt-2"></x-input-error>
                    <input type="text" name= "title" class="text-black w-auto py-2 border border-gray-300" id="title" value="{{old('title')}}">
                </div>
                <div class="result" id="js-result" name="result"></div>
                <div class="w-full flex flex-col">
                    <label for="platform" class="font-semibold mt-4">プラットフォーム</label>
                    <x-input-error :messages="$errors->get('platform')" class="mt-2"></x-input-error>
                    <input type="text" name= "platform" class="text-black w-auto py-2 border border-gray-300" id="platform" value="{{old('platform')}}">
                </div>

                <div class="w-full flex flex-col mt-4">
                    <fieldset class="row mb-3">
                        <legend class="col-md-4 col-form-label text-md-end font-semibold">ジャンル</legend>
                        <div class="pl-3 flex flex-wrap gap-2">
                            @foreach($genres as $genre)
                            <div class="flex font-thin">
                                <input type="checkbox" name="genres[]" id="genre_{{ $genre->id }}" 
                                value="{{ $genre->id }}" @checked(in_array($genre->id, old('genres', [])))
                                class="form-check-input">
                                <label for="genre_{{ $genre->id }}" class="form-check-label">
                                    {{ $genre->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </fieldset>
                    <x-input-error :messages="$errors->get('genres')" class="mt-2"></x-input-error>
                </div>

                <div class="w-full flex flex-col">
                    <label for="launch_date" class="font-semibold mt-4">発売日</label>
                    <input type="date" name= "launch_date" class="text-black w-auto py-2 border border-gray-300" id="launch_date" value="{{old('launch_date')}}">
                </div>
                <div class="w-full flex flex-col">
                    <label for="purchase_date" class="font-semibold mt-4">購入日</label>
                    <input type="date" name= "purchase_date" class="text-black w-auto py-2 border border-gray-300" id="purchase_date" value="{{old('purchase_date')}}">
                </div>
                <div class="w-full flex flex-col">
                    <label for="developer" class="font-semibold mt-4">デベロッパー</label>
                    <input type="text" name= "developer" class="text-black w-auto py-2 border border-gray-300" id="developer"  value="{{old('developer')}}">
                </div>
                <div class="w-full flex flex-col">
                    <label for="publisher" class="font-semibold mt-4">パブリッシャー</label>
                    <input type="text" name= "publisher" class="text-black w-auto py-2 border border-gray-300" id="publisher"  value="{{old('publisher')}}">
                </div>

            </div>
                <!-- Steam画像プレビュー -->
                <div class="mb-4">
                    <label for="" class="block text-sm font-mediun">ゲーム画像</label>
                    <div id="image-preview" class="mt-2">
                        <img src="{{ $config['defaultImageUrl'] ?? asset('img/no-image.png') }}" alt="プレビュー" class="max-w-xs h-auto">
                    </div>                    
                </div>
                <!-- 手動画像アップロード -->
                <div class="w-full flex flex-col">
                    <label for="image" class="block font-semibold mt-4">画像</label>
                    <input type="file" name= "image" id="image" accept=".jpg,.jpeg,.png" class="mt-1 block w-full">
                    <p class="mt-1 text-sm">
                        最大{{ $config['maxFileSize'] }}KBまで(対応形式: {{ implode(',', $config['allowedExtensions']) }})
                    </p>
                </div>

                <!-- Steam画像URL用隠しフィールド -->
                 <input type="hidden" name="steam_image_url" id="steam_image_url">

            <x-custom-button class="my-8 bg-fuchsia-800 hover:bg-fuchsia-400">
                積む！
            </x-custom-button>
        </form>

        @push('scripts')
        <script>
            // ファイルアップロード時のプレビュー表示
            document.getElementById('image').addEventlistener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewContainer = document.getElementById('{{ $config['imagePreviewId'] }}');
                        const img = previewContainer.querySelector('img') || document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'max-w-xs h-auto';
                        if (!img.parentNode) {
                            previewContainer.appendChild(img);
                        }
                    }
                    reader.readAsDataURL(file);

                    // Steam画像URLをクリア
                    document.getElementByID('steam_image_url').value = '';
                }
            });
        </script>
        @endpush
    </div>
    @vite(['resources/js/main.js'])
</x-app-layout>