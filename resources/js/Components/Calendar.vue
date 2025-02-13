<template>
  <FullCalendar :options="calendarOptions">
    <template v-slot:eventContent='arg'>
      <b>{{ arg.event.title }}</b>
    </template>
  </FullCalendar>
</template>
  
  <script>
  import { ref } from 'vue';
  import { CalendarIcon, ChevronLeftIcon, ChevronRightIcon, EllipsisHorizontalIcon, MapPinIcon } from '@heroicons/vue/20/solid';
  import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'


export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarOptions: {
        plugins: [ dayGridPlugin, interactionPlugin ],
        initialView: 'dayGridMonth',
        dateClick: this.handleDateClick,
        events: [
          { title: 'event 1', date: '2019-04-01' },
          { title: 'event 2', date: '2019-04-02' }
        ]
      }
    }
  },
  methods: {
    handleDateClick: function(arg) {
      alert('date click! ' + arg.dateStr)
    }
  }
}
  
  </script>
  
  <style scoped>
  /* Add any styles you need here */
  </style>