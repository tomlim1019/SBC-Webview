<template>
  <v-container class="pa-0">
    <v-card flat class="pa-0 pb-2" v-for="(booking, index) in bookings" :key="index">
      <v-card-text class="pb-0">
        <v-row>
          <v-col cols="4" class="pa-0 pt-1">
            <v-chip pill color="green accent-3" class="ml-4">
            {{booking.status | capitalize}}
          </v-chip>
          </v-col>
          <v-col cols="8" class="pa-1 text-center">
            <div class="font-weight-bold subtitle-1">Booking {{booking.booking_id}}</div>            
          </v-col>
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
              class="ml-auto"
              color="blue accent-4"
              outlined
              dark
              v-bind="attrs"
              v-on:click="dialog = true; booking_id = booking.booking_id"
            >
              Accept Request {{booking.booking_id}}
            </v-btn>
          </template>
          <v-stepper v-model="e1">
            <v-stepper-header>
              <v-stepper-step
                :complete="e1 > 1"
                step="1"
              >
              </v-stepper-step>

              <v-divider></v-divider>

              <v-stepper-step
                :complete="e1 > 2"
                step="2"
              >
              </v-stepper-step>

              <v-divider></v-divider>

              <v-stepper-step
                :complete="e1 > 3"
                step="3"
              >
              </v-stepper-step>

              <v-divider></v-divider>

              <v-stepper-step step="4">
              </v-stepper-step>
            </v-stepper-header>

            <v-stepper-items>
              <v-stepper-content class="pa-0" step="1">
                <v-container>
                  <v-radio-group v-model="selectedFleet" mandatory>
                    <v-radio
                      v-for="(fleet, index) in fleets"
                      :key="index"
                      :label="`${fleet.plate_no} (${fleet.category} with ${fleet.capacity} seats)`"
                      :value="fleet.fleet_id"
                    ></v-radio>
                  </v-radio-group>
                </v-container>

                <v-btn 
                  color="grey darken-1"
                  text 
                  @click="dialog = false; e1 = 1"
                >
                  Cancel
                </v-btn>
                <v-btn
                  color="blue accent-4"
                  class="float-right"
                  text
                  @click="e1 = 2"
                >
                  Continue
                </v-btn>
              </v-stepper-content>

              <v-stepper-content class="pa-0" step="2">
                <v-container>
                  <v-radio-group v-model="selectedDriver" mandatory>
                    <v-radio
                      v-for="(driver, index) in drivers"
                      :key="index"
                      :label="driver.name"
                      :value="driver"
                    ></v-radio>
                  </v-radio-group>
                </v-container>
                <v-btn 
                  color="grey darken-1"
                  text 
                  @click="dialog = false; e1 = 1"
                >
                  Cancel
                </v-btn>
                <v-btn
                  color="blue accent-4"
                  class="float-right"
                  text
                  @click="e1 = 3"
                >
                  Continue
                </v-btn>
              </v-stepper-content>

              <v-stepper-content class="pa-0" step="3">
                <v-card flat>
                  <v-card-title>
                    <span class="headline">Edit Driver</span>
                  </v-card-title>
                  <v-card-text class="px-0">
                    <v-container>
                        <v-col cols="12">
                          <v-text-field
                            v-model="selectedDriver.name"
                            label="Name*"
                            required
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                          <v-text-field
                            v-model="selectedDriver.mykad"
                            label="Mykad*"
                            required
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                          <v-text-field
                            v-model="selectedDriver.license"
                            label="License*"
                            required
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                          <v-text-field
                            v-model="selectedDriver.phone"
                            label="Phone*"
                            required
                          ></v-text-field>
                        </v-col>
                    </v-container>
                    <small class="ml-2">*indicates required field</small>
                  </v-card-text>
                </v-card>
                <v-btn 
                  color="grey darken-1"
                  text 
                  @click="dialog = false; e1 = 1"
                >
                  Cancel
                </v-btn>
                <v-btn
                  color="blue accent-4"
                  class="float-right"
                  text
                  @click="e1 = 4"
                >
                  Continue
                </v-btn>
              </v-stepper-content>

              <v-stepper-content class="pa-0" step="4">
                <v-card>
                  <v-card-title class="headline">
                    Accept This Request?
                  </v-card-title>
                  <v-card-text>
                    Do you want to accept the booking {{booking_id}} request on {{booking.start_date}} to {{booking.end_date}} at {{booking.time}}?
                  </v-card-text>
                  <v-card-actions>
                    <v-btn
                      color="grey darken-1"
                      text
                      @click="dialog = false; e1 = 1"
                    >
                      Cancel
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn
                      color="blue accent-4"
                      text
                      @click="acceptRequest(booking_id, selectedFleet, selectedDriver); dialog = false; e1 = 1"
                    >
                      Accept
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-stepper-content>
            </v-stepper-items>
          </v-stepper>
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
      fleets: '',
      drivers: '',
      selectedFleet: '',
      selectedDriver: '',
      dialog: '',
      e1: 1,
    }),

    mounted: function() {
      axios.get('/pending').then(response => {
        this.bookings = response.data;
      }).catch(error => {
          location.reload();
      });

      axios.get('/fleet').then(response => {
        this.fleets = response.data;
      }).catch(error => {
          location.reload();
      });

      axios.get('/driver').then(response => {
        this.drivers = response.data;
      }).catch(error => {
          location.reload();
      });
    },

    methods: {
      acceptRequest: (booking, fleet, driver) => {
        var data = {fleet: `${fleet}`, driver};
        axios.post(`/${booking}/accept`, data).then(response => {
            location.reload();
        }).catch(error => {
            location.reload();
        });
      }
    }

  }
</script>