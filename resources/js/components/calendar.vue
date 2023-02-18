<script>
import moment from "moment"
export default {
    name: 'Calendar',
    data: () => ({
        today: moment(),
        dateContext: moment(),
        days: ['M', 'T', 'W', 'T', 'F', 'S', 'S']
    }),
    methods: {
        nextMonth: function () {
            var t = this;
            t.dateContext = moment(t.dateContext).add(1, 'month');
        },
        lastMonth: function () {
            var t = this;
            t.dateContext = moment(t.dateContext).subtract(1, 'month');
        }
    },
    computed: {
        year: function () {
            var t = this;
            return t.dateContext.format('YYYY');
        },
        month: function () {
            var t = this;
            return t.dateContext.format('MMMM');
        },
        daysInMonth: function () {
            var t = this;
            return t.dateContext.daysInMonth();
        },
        currentDate: function () {
            var t = this;
            return t.dateContext.get('date');
        },
        firstDayOfMonth: function () {
            var t = this;
            var firstDay = moment(t.dateContext).subtract(1, 'days');
            return firstDay.weekday();
        },
        lastDayOfMonth: function () {
            var t = this;
            var firstDay = moment(t.dateContext).add(2, 'days');
            return firstDay.weekday();
        },
        //Previous Code Above
        initialDate: function () {
            var t = this;
            return t.today.get('date');
        },
        initialMonth: function () {
            var t = this;
            return t.today.format('MMMM');
        },
        initialYear: function () {
            var t = this;
            return t.today.format('YYYY');
        }
    }
}
</script>

<template>

</template>
<style lang="scss" scoped>
.calendar {
    display: grid;
    grid-template-columns: repeat(7, auto);
    text-align: center;
    .days{
        font-weight: 800;
        padding: 1rem;
    }
    .dates {
        border: 1px #fff solid;
        padding: 1rem;
    }
    .title {
        grid-column-start: 1;
        grid-column-end: 8;
        background-color: #222;
        padding: 1rem;
        display: flex;
        justify-content: space-between;
        margin-bottom: 1em;
    }
}
</style>