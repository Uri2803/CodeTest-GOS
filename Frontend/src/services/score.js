import api from './api';

export function searchScore(sbd) {
    return api.get(`/scores/${sbd}`);
}