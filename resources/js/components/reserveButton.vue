<template>
    <button class="btn btn-success btn-block p-2" id="reservationButton" v-on:click="emitGlobalClickEvent()">{{name}}</button>
</template>

<script>
import { EventBus } from './EventBus.js';

export default {
    data () {
        return {
        name: "Reserve",
        clickCount: 0
        }
    },
    methods: {
        emitGlobalClickEvent() {
            this.clickCount++;
            EventBus.$emit('i-got-clicked', this.clickCount);
        }
    }

}
</script>

<style>

</style>