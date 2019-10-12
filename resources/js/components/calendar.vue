<!--
      The vue component that is responsible for the calendar fonctioning
      This component need revisioning for more simplicity and safe methodes
      I used FullCalendar library because it's a ready to use and no need to make one from scratch... 
-->
<script>
import FullCalendar from "@fullcalendar/vue"; // import FullCalendar vue core library
import dayGridPlugin from "@fullcalendar/daygrid"; // import the day grid module
import timeGridPlugin from "@fullcalendar/timegrid"; // import time grid module which is used in this calandar
import interaction from "@fullcalendar/interaction"; // import the interation module for the events modification
import interactionPlugin, { Draggable } from "@fullcalendar/interaction"; // import the interaction modul for the drag and drop
import { Calendar } from "@fullcalendar/core"; // import the calandar facade
import { EventBus } from "./EventBus.js";
import { mapGetters, mapActions, mapState } from "vuex";

// Start of vue componnent

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarPlugins: [timeGridPlugin, interactionPlugin], // the calandar plugins for the time grid vue and the interaction plugin
      evn: [], // contains the receivedReservations
      newEvn: [], // contains the new dropped reservations from user
      calendarApi: null, // contains the FullCalendar API
      counter: 0 // counts the number of received reservations to now which are dropped from user
    };
  },
  methods: {
    ...mapActions(["fetchResrvations", "createReservations"]),
    getNewEvents() {
      // gets new reservations dropped by user
      let allEvents = this.calendarApi.getEvents(); // Get all events in the calendar
      if (allEvents.length > this.counter) {
        for (this.counter; this.counter < allEvents.length; this.counter++) {
          // loop through the events
          this.newEvn.push({
            // pushes the new Reservation(obj) to array
            title: allEvents[this.counter].title, // add title
            start: this.toDateTime(allEvents[this.counter].start.toJSON()), // add start
            end: this.toDateTime(allEvents[this.counter].end.toJSON()) // add end
          });
        }
        this.sendEvents(); // send events to  the DB
      }
    },
    toDateTime(str) {
      // Parse string to DateTime
      let count = str.indexOf("T"); // get the position of 'T'
      let pt1 = str.substring(0, count); // the string before the 'T' containing the date
      let pt2 = str.substring(count + 1, count + 9); // the string after the 'T' containing the time
      /* Due to some reson the time is 3 hours later than the dropped time
      Need to find reason and fix later */
      pt2 =
        (Number(pt2[0] + pt2[1]) - 3).toString() +
        ":" +
        (pt2[3] + pt2[4]) +
        ":00"; // Substract 3 hours from time
      return pt1 + " " + pt2; //  return rebuilded string with correct DateTime and commit it to state
    },
    sendEvents() {
      for (let i = 0; i < this.newEvn.length; i++) {
        this.$store
          .dispatch("createReservations", {
            reservation_name: this.newEvn[i].title, // add title to reservations name
            start: this.newEvn[i].start, // add start date
            end: this.newEvn[i].end // add end date
          })
          .then(response => {
            window.location.reload();
          });
      }
    },
    getReservations() {
      let reservation = this.$store.state.reservations.reservations;
      //Get Reservations from db
      let counter = this.$store.getters.reservationCount;
      for (let i = 0; i < counter; i++) {
        // loop through reservations
        this.evn.push({
          // parse data
          id: reservation[i].id, // add id
          title: reservation[i].title, // add title
          isAllDay: reservation[i].isAllDay, // is all day Default(false)
          start: reservation[i].start.date, // add start
          end: reservation[i].end.date, // add end
          backgroundColor: this.labColor(reservation[i].title)
        });
      }
    },
    sameEvent(stillEvent, movingEvent) {
      return stillEvent.title !== movingEvent.title;
    },
    labColor(lab) {
      const colorsArray = ["#D64933", "#2B303A", "#F28123"];
      switch (lab.substring(0, 3)) {
        case "NYA":
          return colorsArray[0];
          break;
        case "NYB":
          return colorsArray[1];
          break;
        case "NYC":
          return colorsArray[2];
          break;
      }
    }
  },
  computed: {
    ...mapGetters(["reservationCount"]),
    ...mapState(["reservations"])
  },
  created() {
    this.$store.dispatch("fetchResrvations").then(() => {
      this.getReservations(); // get reservations from controller
      this.counter = this.evn.length; // set the counter to the size of receivedResrvations array
    });
  },
  mounted() {
    let self = this;
    self.calendarApi = self.$refs.fullCalendar.getApi(); // set the Calandar API
    self.calendarApi.setOption("height", 730); // set the height of the calendar

    const clickhandler = function() {
      // const var pointing to the getNewEvents method
      self.getNewEvents();
    };

    EventBus.$on("i-got-clicked", clickhandler); // listen for the Reserve button click
  }
};

// make reservations diffrent colors depending on lab name
function labColor(lab) {
  const colorsArray = ["#D64933", "#2B303A", "#F28123"];
  switch (lab.substring(0, 3)) {
    case "NYA":
      return colorsArray[0];
      break;
    case "NYB":
      return colorsArray[1];
      break;
    case "NYC":
      return colorsArray[2];
      break;
  }
}

let el = document.getElementById("labTypes"); // the dragable components
if (el) {
  document.addEventListener("DOMContentLoaded", function() {
    // an Event listener
    let draggableEl = document.getElementById("labTypes"); // the dragable components

    new Draggable(draggableEl, {
      // add drag and drop to component
      itemSelector: ".reservations", // class of draggable componnent
      eventData: function(eventEl) {
        // reservation data
        return {
          title: eventEl.innerText,
          duration: "01:00:00",
          editable: true,
          backgroundColor: labColor(eventEl.innerText)
        };
      }
    });
  });
}
</script>

<template>
  <FullCalendar
    ref="fullCalendar"
    defaultView="timeGridWeek"
    :plugins="calendarPlugins"
    :weekends="false"
    :allDaySlot="false"
    :nowIndicator="true"
    :events="this.evn"
    :droppable="true"
    :eventOverlap="sameEvent"
    eventTextColor="#fff"
    minTime="06:00:00"
    maxTime="20:00:00"
  />
</template>

<style lang='scss'>
@import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css";
@import "~@fullcalendar/timegrid/main.css";
</style>
