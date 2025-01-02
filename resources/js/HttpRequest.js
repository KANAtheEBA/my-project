import axios from 'axios';

const instance = axios.create({
    baseURL: '/api', // Laravelのエンドポイントを指定
    timeout: 15000,
});

// instance
export const searchSteamGames = async (keyword) => {
    try {
        const response = await instance.get('/steam/games/search', {
            params: { q: keyword } // クエリパラメータとしてkeywordを送信
        });

        // レスポンスデータの構造を確認
        console.log('API Response:', response.data);

        //データ構造の正規化
        return response.data.data || [];

    } catch (error) {
        console.error('検索エラー:', error.response?.data || error.message);
        throw new Error(error.response?.data?.message || 'ゲーム情報の取得に失敗しました');
    }
};
