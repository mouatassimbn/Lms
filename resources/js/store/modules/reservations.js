import axios from 'axios';

const state = {
    reservations: [],
}

const getters = {
    reservationCount: (state) => {
        return state.reservations.length;
    },

}

const actions = {
    // Fetch reservations from db
    async fetchResrvations({
        commit
    }) {
        return await axios.get('/api/reservations').then(response => {
            let todayTime = new Date();
            for (let i = 0; i < response.data.length; i++) {
                let comparedDate = new Date(response.data[i].end.date);
                if (comparedDate.getTime() > todayTime.getTime()) {
                    commit('setReservations', response.data[i]);
                }

            }
        });
    },
    // Creat reservations in db
    async createReservations({
        commit
    }, reservation) {
        return await axios.post('/api/reservations', reservation).then(response => {
            commit('newReservations', response.data);
        }).catch((err) => {
            console.log(err);
        });
    },

}

const mutations = {
    setReservations: (state, reservation) => state.reservations.push(reservation),
    newReservations: (state, reservation) => state.reservations.unshift(reservation)
}

export default {
    state,
    mutations,
    actions,
    getters
}
