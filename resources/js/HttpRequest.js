import axios from 'axios';

const instance = axios.create({
    baseURL: '/api', // Laravelのエンドポイントを指定
    timeout: 10000,
});

// instance
export const searchSteamGames = async (keyword) => {
    try {
        const response = await instance.get('/steam/games/search', {
            params: { q: keyword } // クエリパラメータとしてkeywordを送信
        });
        return response.data;
    } catch (error) {
        console.error('検索エラー:', error.response?.data || error.message);
        throw new Error(error.response?.data?.message || 'ゲーム情報の取得に失敗しました');
    }
};
