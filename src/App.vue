<template>
  <v-app>
    <v-layout justify-center>
      <v-flex class="app-wrapper">
        <component :is="route"
                   @routeChange="changeRoute"/>
      </v-flex>
    </v-layout>
  </v-app>
</template>

<script>
import Start from './components/Start'
import ParticipentSelection from './components/ParticipentSelection'

export default {
  name: 'App',
  components: {
    Start,
    ParticipentSelection
  },
  data: () => ({
    route: 'Start'
  }),
  methods: {
    changeRoute (route) {
      this.route = route
    }
  }
};
</script>

<style lang="stylus">
  .app-wrapper
    max-width: 600px
  .main-wrapper
    padding: 40px
    min-height: 100vh
    .v-btn
      width: 100% !important
      min-width: 100% !important
      height: 100px !important
</style>
