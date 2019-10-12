<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Testing Vuex</div>

                    <div class="card-body">
                        {{ reservation }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';
    export default {
        data() {
            return {
                reservation: "hello"
            }
        },
        computed: mapGetters(['allReservations']),
        methods: {
            ...mapActions(['fetchResrvations']),
        },
        mounted() {
            console.log(this.$store.getters.allReservations);//('fetchResrvations');
            console.log('Component mounted.');
        }
    }
</script>
