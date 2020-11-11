<template>
  <v-app id="inspire">
    <v-app-bar
    app
      color="white"
      flat
    >
      <div class="text-center justify-center py-6 mt-2">
        <h1 class="font-weight-bold display-1 font-italic">
          SBC 
          <span class="overline"> Mobile Webview</span>
        </h1>
      </div>
      <v-btn outlined class="ml-auto mt-2" color="red accent-4" v-on:click="logout">
        Log Out
      </v-btn>
    </v-app-bar>

    <v-main>
        <v-tabs
          v-model="tab"
          color="grey darken-1"
          fixed-tabs
        >
          <v-tab
            v-for="link in links"
            :key="link"
          >
            {{ link }}
          </v-tab>
        </v-tabs>
      
        <v-tabs-items v-model="tab">
          <v-tab-item
            v-for="link in links"
            :key="link"
          >
              <Home v-bind:name="link"></Home>
          </v-tab-item>
        </v-tabs-items>
        <div class="text-center ma-2">
          <v-snackbar
            v-model="snackbar"
          >
            You have new notification!

            <template v-slot:action="{ attrs }">
              <v-btn
                color="pink"
                text
                v-bind="attrs"
                @click="snackbar = false"
              >
                Close
              </v-btn>
            </template>
          </v-snackbar>
        </div>
    </v-main>
  </v-app>
</template>

<script>
import Home from '#Components/shared/Home';
import Login from '#Components/shared/Login';
import axios from 'axios';

export default {
  name: 'App',

  components: {
    Home,
    Login
  },

  props: ['login'],

  data: () => ({
    snackbar: '',
    tab: null,
    links: [
      'Profile',
      'Request',
      'Notification',
    ],
  }),

  mounted: function() {
      axios.get('/notification').then(response => {
        if(response.data['length'] > 0){
          this.snackbar = true;
        }
      }).catch(error => {
          console.log(error)
          location.reload();
      });
    },

  methods: {
            logout() {
                axios.post('/logout').then(response => {
                    this.$router.push("/login")

                }).catch(error => {
                    location.reload();
                });
            }
 }
};
</script>

<style>
 .v-window__container {
   height: 100%;
 }
</style>