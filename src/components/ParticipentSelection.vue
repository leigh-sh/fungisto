<template>
  <div>
    <v-layout column justify-space-between class="main-wrapper">
      <v-flex shrink>
        <h1>Employees</h1>
        <hr/>
      </v-flex>
      <v-flex>
        <v-select
            :items="regions"
            label="Filter by region"
            v-model="region"
          ></v-select>
        <ul>
          <li v-for="(person, index) in personsFiltered" :key="index">
            <v-layout align-center
                      justify-space-between>
              <v-flex shrink>
                {{ person.name }}
              </v-flex>
              <v-flex shrink>
                <v-switch @change="selectParticipent(person)"></v-switch>
              </v-flex>
            </v-layout>
          </li>
        </ul>
      </v-flex>
      <v-flex shrink>
        <v-layout justify-space-between>
          <v-flex shrink>
            <v-btn @click="$emit('routeChange', 'start')">
              <v-icon>mdi-chevron-left</v-icon>
              Back
            </v-btn>
          </v-flex>
          <v-flex shrink>
            <v-btn @click="raffle">Raffle</v-btn>
          </v-flex>
        </v-layout>
      </v-flex>
    </v-layout>
    <v-dialog
      v-model="winnersDialog"
      :fullscreen="$vuetify.breakpoint.smAndDown"
      width="500">
      <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title>
          And the Winners are
        </v-card-title>
        <v-card-text>
          <div class="dialog-content">
            <ul>
              <li v-for="(winner, index) in winners" :key="index">
                <v-layout justify-space-between align-center>
                  <v-flex shrink>
                    {{ winner.name }}
                  </v-flex>
                  <v-flex shrink>
                    <v-btn icon>
                      <v-icon>mdi-account-switch</v-icon>
                    </v-btn>
                  </v-flex>
                </v-layout>
              </li>
            </ul>
          </div>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <div class="flex-grow-1"></div>
          <v-btn
            color="primary"
            text
            @click="winnersDialog = false">
            Close
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
export default {
  data: () => {
    return {
      persons: [
        // { name: 'Eyal',   isSelected: false, region: 1, score: 10 },
        // { name: 'Eilon',  isSelected: false, region: 1, score: 20 },
        // { name: 'Asi',    isSelected: false, region: 2, score: 30 },
        // { name: 'Andrei', isSelected: false, region: 2, score: 10 },
        // { name: 'Uri',    isSelected: false, region: 3, score: 20 },
        // { name: 'Noam',   isSelected: false, region: 3, score: 30 },
        // { name: 'Leigh',  isSelected: false, region: 3, score: 10 },
        // { name: 'Meir',   isSelected: false, region: 3, score: 20 }
      ],
      regions: [
        'All'
      ],
      region: 'All',
      selectedPersons: [],
      winners: [],
      currentWinnerIdx: 0,
      winnersDialog: false
    }
  },
  methods: {
    selectParticipent(person) {
      this.persons.forEach( (dataPerson) => {
        if (person.name === dataPerson.name) {
          dataPerson.isSelected = !dataPerson.isSelected
        }
      })
    },
    raffle() {
      this.selectedPersons = this.selectedParticipents.sort((a,b) => (a.score > b.score) ? 1 : -1)
      this.winners = []
      if (this.selectedPersons.length >= 5) {
        for ( this.currentWinnerIdx = 0 ; this.currentWinnerIdx < 5 ; this.currentWinnerIdx++) {
          this.winners.push(this.selectedPersons[this.currentWinnerIdx])
          this.winnersDialog = true
        }
      } else {
        return
      }
    }
  },
  computed: {
    selectedParticipents () {
      return this.persons.filter( person => {
        return person.isSelected
      })
    },
    personsFiltered () {
      return this.persons.filter(person => person.region === this.region ||
                                           this.region === 'All')
    }
  },
  mounted: function () {
    this.$http.get('https://fungisto.narxx.com/getPersons.php').then( (resp) => {
      this.persons = resp.body
      this.persons.forEach( (person) => {
        this.regions.push(person.region)
      })
      this.regions = Array.from(new Set(this.regions))
    })
  }
}
</script>

<style scoped lang="stylus">
  ul
    padding: 0 !important
    list-style-type: none
  .dialog-content
    padding-top: 20px
    ul
      li
        padding: 10px

</style>
