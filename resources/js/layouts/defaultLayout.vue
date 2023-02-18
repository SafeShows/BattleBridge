<script setup>
import moment from "moment"
import { onBeforeUnmount, ref } from "vue"
import { usePage, Link } from "@inertiajs/vue3";

const { props } = usePage()

const dialog = ref(false);

var time = ref(moment().utc().tz(props.AppSettings.communityTimezone).format("HH:mm:ss"));

const timeInterval = setInterval(() => {
    time.value = moment().utc().tz(props.AppSettings.communityTimezone).format("HH:mm:ss")
}, 1000);

onBeforeUnmount(() => {
    clearInterval(timeInterval);
})


</script>

<template>
    <v-app>
        <v-app-bar density="compact">
            <v-app-bar-title>{{ props.AppSettings.communityName }}</v-app-bar-title>
            <template v-slot:append>
                <v-card-subtitle>Current Community Time: {{ time }}</v-card-subtitle>
                <v-btn :color="props.AppSettings.communityTheme" v-if="props.User == null" variant="outlined"
                    href="/auth/discord">Login</v-btn>
                <Link as="div" href="/profile" v-else><v-btn :color="props.AppSettings.communityTheme"
                    variant="outlined">Profile</v-btn></Link>
            </template>
        </v-app-bar>
        <v-main>
            <v-container fluid>
                <template v-if="props.User">
                    <v-navigation-drawer expand-on-hover permanent>
                        <v-list nav>
                            <v-list-item :prepend-avatar="props.User.avatar" :title="props.User.name"></v-list-item>
                        </v-list>
                        <v-divider></v-divider>
                        <v-list density="compact" nav>
                            <v-list-item link prepend-icon="mdi-account-multiple" title="My Squad" />
                            <Link as="div" href="/orbat" >
                                <v-list-item link href="/orbat" prepend-icon="mdi-account-group" title="Community ORBAT" />
                            </Link>
                            <Link as="div" href="/events">
                                <v-list-item link href="/events" prepend-icon="mdi-calendar-month" title="Community Calendar" />
                            </Link>
                            <v-list-item link prepend-icon="mdi-clipboard-text-outline" title="Community Inventory" />
                        </v-list>
                        <template v-slot:append>
                            <v-divider></v-divider>
                            <v-list density="compact" nav>
                                <v-list-item link prepend-icon="mdi-cogs" title="Community Settings" />

                                <v-dialog v-model="dialog" width="auto">
                                    <template v-slot:activator="{ props }"><v-list-item v-bind="props" link
                                            prepend-icon="mdi-calendar-edit" title="New Event" />
                                    </template>

                                    <v-card max-width="650">
                                        <v-card-title>New Event</v-card-title>
                                        <v-card-text>
                                            <v-text-field label="Event Title" />
                                            <v-textarea label="Event Description" />
                                            <v-row>
                                                <v-col>
                                                    <v-btn color="red-darken-3" block @click="dialog = false">Cancel</v-btn>
                                                </v-col>
                                                <v-col>
                                                    <v-btn color="green-darken-3" block @click="dialog = false">Create</v-btn>
                                                </v-col>
                                            </v-row>
                                            <br>
                                        </v-card-text>
                                    </v-card>
                                </v-dialog>
                                <v-list-item link prepend-icon="mdi-account-supervisor" title="Onboarding" />
                            </v-list>
                        </template>
                    </v-navigation-drawer>
                </template>
                <slot />
            </v-container>
        </v-main>
    </v-app>
</template>