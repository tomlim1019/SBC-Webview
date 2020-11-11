<template>
  <v-card>
    <v-tabs
      v-model="tab"
      fixed-tabs
      hide-slider
      color="blue accent-4"
    >
      <v-tab
        v-for="item in items"
        :key="item"
      >
        {{ item }}
      </v-tab>
    </v-tabs>

    <v-divider class="mx-2 my-0"></v-divider>

    <v-tabs-items v-model="tab">
      <v-tab-item
        v-for="item in items"
        :key="item"
      >
        <v-container class="pa-0" v-if="item === 'Pending Request'">
          <PendingRequest></PendingRequest>
        </v-container>
        <v-container class="pa-0" v-else>
          <MyRequest></MyRequest>
        </v-container>
      </v-tab-item>
    </v-tabs-items>
  </v-card>
</template>

<script>
import MyRequest from '#Components/shared/MyRequest';
import PendingRequest from '#Components/shared/PendingRequest';

  export default {
    components: {
      MyRequest, PendingRequest
      },

    data () {
      return {
        tab: null,
        items: [
          'Pending Request', 'My Request'
        ],
      }
    },
  }
</script>
