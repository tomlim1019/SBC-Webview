<template>
  <v-card>
    <v-card-title class="display-1 pb-0">Profile</v-card-title>
    <v-divider class="mx-2"></v-divider>

    <v-card-text v-for="(value, key) in users" :key="key">
        <v-row>
          <v-col cols="4" class="pa-0">
            <div class="ml-4 font-weight-medium subtitle-1">{{key | capitalize}}:</div>
          </v-col>
          <v-col cols="8" class="pa-0 pt-1">
            <div class="mx-4 subtitle-2">{{value}}</div>
          </v-col>
        </v-row>
    </v-card-text>

    <v-card-actions>
      <v-dialog
        v-model="dialog"
        persistent
        max-width="600px"
      >
        <template v-slot:activator="{ on, attrs }">
          <v-btn
            outlined
            class="ml-auto"
            color="blue accent-4"
            dark
            v-bind="attrs"
            v-on="on"
          >
            Edit Profile
          </v-btn>
        </template>
        <v-card>
          <v-card-title>
            <span class="headline">Edit Profile</span>
          </v-card-title>
          <v-card-text class="px-0">
            <v-container>
                <v-col cols="12">
                  <v-text-field
                    v-model="update.name"
                    label="Name*"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="update.license"
                    label="License*"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="update.permit"
                    label="Permit*"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="update.address"
                    label="Address*"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="update.phone"
                    label="Phone*"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-text-field
                    v-model="update.email"
                    label="Email*"
                    required
                  ></v-text-field>
                </v-col>
            </v-container>
            <small class="ml-2">*indicates required field</small>
          </v-card-text>
          <v-card-actions>
            <v-btn
              color="grey darken-1"
              text
              @click="dialog = false"
            >
              Close
            </v-btn>
            <v-spacer></v-spacer>
            <v-btn
              color="blue accent-4"
              text
              @click="updateProfile(update); dialog = false"
            >
              Save
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-card-actions>
  </v-card>
</template>

<script>
import axios from 'axios';

  export default {
    data: () => ({
      dialog: '',
      users: '',
      update: '',
      items: [
        'name',
        'mykad',
        'username',
        'license',
        'permit',
        "address",
        'phone',
        'email'
      ],
    }),

    mounted: function() {
      axios.get('/user').then(response => {
        var data = response.data
        this.update = response.data
        const filtered = Object.keys(data)
        .filter(key => this.items.includes(key))
        .reduce((obj, key) => {
          obj[key] = data[key];
          return obj;
        }, {});
        this.users = filtered;
      }).catch(error => {
          location.reload();
      });
    },

    methods: {
      updateProfile: (data) => {
        axios.post('/user/update', data).then(response => {
          location.reload();
        }).catch(error => {
            location.reload();
        });
      }
    }

  }
</script>