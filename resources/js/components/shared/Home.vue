<template>
  <v-container fluid v-if="name === 'Profile'">
    <Profile></Profile>
  </v-container>
  <v-container fluid v-else-if="name === 'Request'">
    <Request></Request>
  </v-container>
  <v-container fluid v-else-if="name === 'Notification'">
    <Notification></Notification>
  </v-container>
</template>

<script>
import Profile from '#Components/shared/Profile';
import Request from '#Components/shared/Request';
import Notification from '#Components/shared/Notification';

  export default {
    components: {Profile, Request, Notification},

    data: () => ({
      links: [
        'Profile',
        'Request',
        'Notification',
        'My Request'
      ],
    }),

    props: ['name']
  }
</script>
