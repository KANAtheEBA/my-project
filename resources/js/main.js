import { searchSteamGames } from "./HttpRequest";
import { showSearchResults } from "./SteamAppData"

const setupSearchHandler = () => {
    const titleInput = document.querySelector('#title');
    let debounceTimeout;

    titleInput.addEventListener('input', async(e) => {
        clearTimeout(debounceTimeout);

        debounceTimeout = setTimeout(async () => {
            const keyword = e.target.value;
            if (keyword.length < 2) {
                document.querySelector("#js-result").innerHTML = '';
                return;
            }

            try {
                const results = await searchSteamGames(keyword);
                showSearchResults(results);

                // 検索結果クリックイベントの設定
                document.querySelectorAll('.game-result').forEach(element => {
                    element.addEventListener('click', () => {
                        const gameTitle = element.dataset.gameTitle;
                        const imageUrl = element.dataset.imageUrl;

                        console.log('selected game:', { gameTitle, imageUrl });

                        // タイトルを設定
                        document.querySelector('#title').value = gameTitle;

                        // 画像URLを隠しフィールドに設定
                        let steamImageUrlInput = document.querySelector('#steam_image_url');
                        if (!steamImageUrlInput) {
                            steamImageUrlInput = document.createElement('input');
                            steamImageUrlInput.type = 'hidden';
                            steamImageUrlInput.id = 'steam_image_url';
                            steamImageUrlInput.name = 'steam_image_url';
                            document.querySelector('form').appendChild(steamImageUrlInput);
                        }
                        steamImageUrlInput.value = imageUrl;

                        // プレビュー画像表示
                        const previewContainer = document.querySelector('#image-preview');
                        if (previewContainer) {
                            const img = previewContainer.querySelector('img') || document.createElement('img');
                            img.src = imageUrl;
                            img.alt = gameTitle;
                            img.className ='max-w-xs h-auto';
                            if (!img.parentNode) {
                            previewContainer.appendChild(img);
                            } else {
                                img.parentNode.replaceChild(img, previewContainer.querySelector('img'));
                            }
                        }

                        document.querySelector("#js-result").innerHTML = ''; // 結果一覧をクリア
                    });
                });
            } catch (error) {
                console.error('検索エラー：', error);
                document.querySelector("#js-result").innerHTML =
                    '<div class="text-red-500">ゲーム情報の検索中にエラーが発生しました</div>';
            }
        }, 300);
    });
};

document.addEventListener('DOMContentLoaded', setupSearchHandler);
