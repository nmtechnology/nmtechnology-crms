<template>
  <FullCalendar :options="calendarOptions">
    <template v-slot:eventContent="arg">
      <b>{{ arg.event.title }}</b>
      <b>{{ arg.event.extendedProps.description }}</b>
    </template>
  </FullCalendar>
</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import listPlugin from '@fullcalendar/list'

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    return {
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin, listPlugin], // an array of plugins
        initialView: 'dayGridMonth', // the default view
        dateClick: this.handleDateClick,
        events: this.fetchEvents
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