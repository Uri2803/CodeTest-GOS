import api from './api';

export function searchScore(sbd) {
    return api.get(`/scores/${sbd}`);
}

export function scoreDistribution() {
    return api.get(`/report/score-distribution`);
}

export function topStudents(block) {
    return api.get(`/top-students/${block}`);
}