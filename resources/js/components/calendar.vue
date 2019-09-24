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
      counter: 0, // counts the number of received reservations to now which are dropped from user
      // success: false // the response of the server after submiting the reservations
    };
  },
  props: ["event"], // the atrribute that the gets the reservations from controller
  methods: {
    getNewEvents() {
      // gets new reservations dropped by user
      let allEvents = this.calendarApi.getEvents(); // Get all events in the calendar
      if (allEvents.length > this.counter) {
        for (let i = this.counter; i < allEvents.length; i++) {
          // loop through the events
          this.newEvn.push({
            // pushes the new Reservation(obj) to array
            title: allEvents[i].title, // add title
            start: this.toDateTime(allEvents[i].start.toJSON()), // add start
            end: this.toDateTime(allEvents[i].end.toJSON()) // add end
          });
        }
        this.counter++; // increment the counter
        this.sendEvents(); // send events to  the DB
      };
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
      // Send reservations to DB
      this.$http
        .post(
          // Send a post http request to controller via /calendar
          "/calendar",
          JSON.stringify({
            reservation_name: this.newEvn[0].title, // add title to reservations name
            start: this.newEvn[0].start, // add start date
            end: this.newEvn[0].end // add end date
          }) // JSON encoding
        )
        .then(request => {
          // response of controller
          // this.success = true; // result of the request
          window.location.reload();  // reload the page
        });
    },
    getReservations() {
      //Get Reservations from db
      for (let i = 0; i < this.event.length; i++) {
        // loop through reservations
        this.evn.push({
          // parse data
          id: this.event[i].id, // add id
          title: this.event[i].title, // add title
          isAllDay: this.event[i].isAllDay, // is all day Default(false)
          start: this.event[i].start.date, // add start
          end: this.event[i].end.date // add end
        });
      }
    },
    sameEvent(stillEvent, movingEvent) {
      return stillEvent.title !== movingEvent.title;
    }
  },
  mounted() {
    let self = this;
    self.getReservations(); // get reservations from controller
    self.counter = self.evn.length; // set the counter to the size of receivedResrvations array
    self.calendarApi = self.$refs.fullCalendar.getApi(); // set the Calandar API
    self.calendarApi.setOption("height", 590); // set the height of the calendar
    
    
    const clickhandler = function() { // const var pointing to the getNewEvents method
      self.getNewEvents();
    };
    EventBus.$on("i-got-clicked", clickhandler); // listen for the Reserve button click

  }
};

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
    minTime="08:00:00"
    maxTime="19:00:00"
  />
</template>

<style lang='scss'>
@import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css";
@import "~@fullcalendar/timegrid/main.css";
</style>
