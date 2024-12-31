// 検索結果表示用コンポーネント
export const showSearchResults = (results) => {
    console.log('Results:', results); //
    console.log('Type:', typeof results); //

    const gamesArray = results.data || Array.isArray(results) ? results : [];

    const resultHtml = gamesArray.map(game => `
        <div class="game-result border p-4 mb-2 cursor-pointer hover:bg-gray-100"
            data-game-title="${game.title}"
            data-image-url="${game.img}">
            <div class="font-semibold">${game.title}</div>
            <img src="${game.img}" alt="${game.title}" class="W-full mb-2">
            
        </div>
    `).join('');

    document.querySelector("#js-result").innerHTML = resultHtml || '<div class="text-gray-500">該当するゲームが見つかりませんでした。</div>';
};