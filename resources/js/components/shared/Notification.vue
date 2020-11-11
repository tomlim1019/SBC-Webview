<template>
  <v-card>
    <v-card-title class="display-1 pb-0">Notification</v-card-title>
    <v-divider class="mx-4"></v-divider>

    <v-card-text class="pa-0" v-for="(notification, index) in notifications" :key="index">
      <div v-if="notification.status !== 'cancelled'">
        <v-icon class="mx-4" large>{{info}}</v-icon>
        Booking {{notification.booking_id}} has been changed!
        <v-divider></v-divider>
      </div>
      <div v-else>
        <v-icon class="mx-4" large>{{alert}}</v-icon>
        Booking {{notification.booking_id}} has been cancelled!
        <v-divider></v-divider>
      </div>
    </v-card-text>

    <v-card-actions>
    
      <v-dialog
        v-model="dialog"
        :retain-focus="false"
        persistent
        max-width="600"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            class="ml-auto"
            color="red accent-4"
            outlined
            dark
            v-bind="attrs"
            v-on="on"
          >
            Clear Notification
          </v-btn>
        </template>
        
        <v-card>
          <v-card-title class="headline">
            Clear Notification?
          </v-card-title>
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
              @click="clearNotification(); dialog = false"
            >
              Clear
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-card-actions>
  </v-card>
</template>

<script>
import axios from 'axios';
import { mdiInformationOutline, mdiAlert } from '@mdi/js';

  export default {
    data: () => ({
      notifications: '',
      dialog: '',
      info: mdiInformationOutline,
      alert: mdiAlert,
    }),

    mounted: function() {
      axios.get('/notification').then(response => {
        this.notifications = response.data;
      }).catch(error => {
          location.reload();
      });
    },

    methods: {
      clearNotification: () => {
        axios.post(`/notification/clear`).then(response => {
            location.reload();
        }).catch(error => {
            location.reload();
        });
      }
    }

  }
</script>