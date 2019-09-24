/*
        The container of the application state!
        needed to make the vue componenents get the same state.
        When the application's scale get bigger i need to use this.
        For the moment i need to learn more about vuex to introduce is to the app
*/

import { start } from "repl";

const store = new Vuex.store({
    state: {
        receivedReservations: [], // Reservations received from DB
        newReservations: [],    // Reservations newly added by user
        counter: 0  // counts the number of received reservations


    },
    mutation: {
        toDateTime(state) { // parse data into dateTime in preparation to be sent to DB
            let count = state.indexOf("T"); // Find index of letter T in the string
            let pt1 = state.substring(0, count); // Get the first part of the string before the T containing the Date
            let pt2 = state.substring(count + 1, count + 9); // Get the second part of the string after the T containing the Time
            /* Due to some reson the time is 3 hours later than the dropped time
            Need to find reason and fix later */
            pt2 = (Number(pt2[0] + pt2[1]) - 3).toString() + ":" + (pt2[3] + pt[4]) + ":00"; // Substract 3 hours from time
            state = pt1 + " " + pt2; //  rebuild the string with correct DateTime and commit it to state
        },
        addReservation(state, reservation) { // add new reservations to the array
            state.push(reservation); // push the reservation to the array
        }
    },
    actions: {
        toDate(context) { // get DateTime 
            context.commit('toDateTime');
        }
    },
    getters: {
        getStart: state => { // get reservation starting date and time
            return state.toDate(start); // return the start date and time
        },
        getEnd: state => { // get reservation ending date and time
            return state.toDate(end);  // return the end date and time

        },
        getAllReservations: state => { // get all reservations
            return receivedReservations.concat(newReservations); // return an array of receivedReservations and newReservations
        },
        getNewReservations: state => { // get just new reservations
            return state.newReservations;
        }

    }
});
