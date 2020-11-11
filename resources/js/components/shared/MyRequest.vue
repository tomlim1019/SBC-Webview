<template>
  <v-container class="pa-0">
    <v-card flat class="pa-0 pb-2" v-for="(booking, index) in bookings" :key="index">
      <v-card-text class="pb-0">
        <v-row
          align="center"
          class="mx-0"
        >
          <v-row v-if="booking.status === 'booked'">
            <v-col cols="4" class="pa-0 pt-1">
              <v-chip pill color="yellow accent-3" class="ml-4">
              {{booking.status | capitalize}}
            </v-chip>
            </v-col>
            <v-col cols="8" class="pa-1 text-center">
              <div class="font-weight-bold subtitle-1">Booking {{booking.booking_id}}</div>            
            </v-col>
          </v-row>
          <v-row v-else-if="booking.status === 'completed'">
            <v-col cols="4" class="pa-0 pt-1">
              <v-chip pill color="green accent-3" class="ml-4">
              {{booking.status | capitalize}}
            </v-chip>
            </v-col>
            <v-col cols="8" class="pa-1 text-center">
              <div class="font-weight-bold subtitle-1">Booking {{booking.booking_id}}</div>            
            </v-col>
          </v-row> 
          <v-row v-else>
            <v-col cols="4" class="pa-0 pt-1">
              <v-chip pill color="red accent-4" class="ml-4">
              {{booking.status | capitalize}}
            </v-chip>
            </v-col>
            <v-col cols="8" class="pa-1 text-center">
              <div class="font-weight-bold subtitle-1">Booking {{booking.booking_id}}</div>            
            </v-col>
          </v-row> 
        </v-row>

        <v-row>
          <v-col cols="4" class="pa-0 pt-1">
            <div class="ml-4 font-weight-medium subtitle-1">Date:</div>
          </v-col>
          <v-col cols="8" class="pa-1">
            <div class="mx-4 subtitle-2">{{booking.start_date}} - {{booking.end_date}}</div>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4" class="pa-0">
            <div class="ml-4 font-weight-medium subtitle-1">Time:</div>
          </v-col>
          <v-col cols="8" class="pa-1">
            <div class="mx-4 subtitle-2">{{booking.time}}</div>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4" class="pa-0">
            <div class="ml-4 font-weight-medium subtitle-1">Departure:</div>
          </v-col>
          <v-col cols="8" class="pa-1">
            <div class="mx-4 subtitle-2">{{booking.departure}}</div>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4" class="pa-0">
            <div class="ml-4 font-weight-medium subtitle-1">Arrival:</div>
          </v-col>
          <v-col cols="8" class="pa-1">
            <div class="mx-4 subtitle-2">{{booking.arrival}}</div>
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="4" class="pa-0">
            <div class="ml-4 font-weight-medium subtitle-1">Remarks:</div>
          </v-col>
          <v-col cols="8" class="pa-1">
            <div class="mx-4 subtitle-2">{{booking.special}}</div>
          </v-col>
        </v-row>
      </v-card-text>

      <v-card-actions>
        <v-dialog
          v-model="dialog"
          :retain-focus="false"
          persistent
          max-width="600"
        >
          <template v-slot:activator="{ attrs }">
            <v-btn
              v-if="booking.status !== 'cancelled' && booking.status !== 'completed'"
              class="ml-auto"
              color="red accent-4"
              outlined
              dark
              v-bind="attrs"
              v-on:click="dialog = true; booking_id = booking.booking_id"
            >
              Abandon Request
            </v-btn>
          </template>
          
          <v-card>
            <v-card-title class="headline">
              Abandon This Request?
            </v-card-title>
            <v-card-text>
              Do you want to abandon the booking request on {{booking.start_date}} to {{booking.end_date}} at {{booking.time}}?
            </v-card-text>
            <v-card-actions>
              <v-btn
                color="grey darken-1"
                text
                @click="dialog = false"
              >
                Cancel
              </v-btn>
              <v-spacer></v-spacer>
              <v-btn
                color="red accent-4"
                text
                @click="cancelRequest(booking_id); dialog = false"
              >
                Yes
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog
          v-model="dialog2"
          :retain-focus="false"
          persistent
          max-width="600"
        >
          <template v-slot:activator="{ attrs }">
            <v-btn
              v-if="booking.status !== 'cancelled' && booking.status !== 'completed'"
              class="ml-auto"
              color="blue accent-4"
              outlined
              dark
              v-bind="attrs"
              v-on:click="dialog2 = true; booking_id = booking.booking_id"
            >
              Complete Request
            </v-btn>
          </template>
          
          <v-card>
            <v-card-title class="headline">
              Complete This Request?
            </v-card-title>
            <v-card-text>
              Do you want to complete the booking request on {{booking.start_date}} to {{booking.end_date}} at {{booking.time}}?
            </v-card-text>
            <v-card-actions>
              <v-btn
                color="grey darken-1"
                text
                @click="dialog2 = false"
              >
                Cancel
              </v-btn>
              <v-spacer></v-spacer>
              <v-btn
                color="blue accent-4"
                text
                @click="completeRequest(booking_id); dialog2 = false"
              >
                Yes
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-card-actions>
      <v-divider class="mx-2 my-0"></v-divider>
    </v-card>
  </v-container>
</template>

<script>
import axios from 'axios';

  export default {
    data: () => ({
      bookings: '',
      booking_id: '',
      dialog: '',
      dialog2: ''
    }),

    mounted: function() {
      axios.get('/request').then(response => {
        var data = [];
        for(var i=0; i<response.data['length']; i++){
          if(response.data[`${i}`].status === 'booked')
            data.push(response.data[`${i}`]);
        }
        for(var i=0; i<response.data['length']; i++){
          if(response.data[`${i}`].status !== 'booked')
            data.push(response.data[`${i}`]);
        }
        this.bookings = data;
      }).catch(error => {
          location.reload();
      });
    },

    methods: {
      cancelRequest: (booking) => {
        axios.post(`/${booking}/cancel`).then(response => {
            location.reload();
        }).catch(error => {
            location.reload();
        });
      },

      completeRequest: (booking) => {
        axios.post(`/${booking}/complete`).then(response => {
            location.reload();
        }).catch(error => {
            location.reload();
        });
      }
    }

  }
</script>