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
                        console.log('Clicked title: ', element.dataset.gameTitle);
                        titleInput.value = element.dataset.gameTitle; // データ属性の値をタイトルに設定
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
