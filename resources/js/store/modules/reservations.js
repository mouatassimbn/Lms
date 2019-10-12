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
    async fetchResrvations({
        commit
    }) {
        return await axios.get('/api/reservations').then(response => {

            commit('setReservations', response.data);

        });
    },
    async createReservations({
        commit
    }, reservation) {
        //this.$http.post('/api/reservations', JSON.stringify(reservation)).then((response) => {
        return await axios.post('/api/reservations', reservation).then(response => {
            commit('newReservations', response.data);
        }).catch((err) => {
            console.log(err);
        });
    },
}

const mutations = {
    setReservations: (state, reservation) => state.reservations = reservation,
    newReservations: (state, reservation) => state.reservations.unshift(reservation)
}

export default {
    state,
    mutations,
    actions,
    getters
}
