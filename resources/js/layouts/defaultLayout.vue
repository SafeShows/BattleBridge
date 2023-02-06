<script setup>
import moment from "moment"
import {onBeforeUnmount, ref} from "vue"

var time = ref(moment().utc().format("HH:mm:ss"));

const timeInterval = setInterval(()=>{
    time.value = moment().utc().format("HH:mm:ss")
}, 1000);

onBeforeUnmount(()=>{
    clearInterval(timeInterval);
})

const theme = ref(localStorage.getItem('theme')?localStorage.getItem('theme'):'dark')

function onClick () {
  theme.value = theme.value === 'light' ? 'dark' : 'light'
  localStorage.setItem("theme", theme.value)
}

</script>

<template>
    <v-app :theme="theme">
        <v-app-bar density="compact" >
            <v-app-bar-title>Joint Defence Force</v-app-bar-title>
            <template v-slot:append>
                <v-card-subtitle>Current UTC time: {{ time }}</v-card-subtitle>
                <v-btn
                    density="compact"
                    variant="text"
                    elevation="0"
                    :prepend-icon="theme === 'light' ? 'mdi-weather-sunny' : 'mdi-weather-night'"
                    @click="onClick"
                >Toggle Theme</v-btn>
            </template>
        </v-app-bar>
        <v-main>
            <v-container>
                <slot />
            </v-container>
        </v-main>
    </v-app>
</template>