<script setup>
import { ref } from "vue";
import { useForm } from '@inertiajs/vue3'
import moment_timezone from "moment-timezone";

const tab = ref('CommunitySettings');

const timezones = ref(moment_timezone.tz.names());
const form = useForm({
    communityTimezone: "UTC",
    communityName: "",
    communityTheme: "#ffffffff",
    discordServerID: "",
    discordClientID: "",
    discordSecret: "",
    discordBotToken: "",
    teamspeakServerIP: "",
    teamspeakServerPort: "",
    teamspeakServerQueryUsername: "",
    teamspeakServerQueryPassword: "",
    teamspeakServerQueryPort: "",
})

defineOptions({
    layout: (h, page) => h(page)
});
</script>
<template>
    <v-app>
        <v-main>
            <v-row justify="center">
                <v-col />
                <v-col>
                    <br>
                    <v-card class="">
                        <v-card-title :style="{ color: form.communityTheme }">BattleBridge - Installer</v-card-title>
                        <v-tabs :color="form.communityTheme" v-model="tab">
                            <v-tab value="CommunitySettings">Community Settings</v-tab>
                            <v-tab value="DiscordSettings">Discord Settings</v-tab>
                            <v-tab value="TeamSpeakSettings">TeamSpeak Settings</v-tab>
                        </v-tabs>

                        <v-card-text>
                            <v-window v-model="tab">
                                <v-window-item value="CommunitySettings">
                                    <br>
                                    <v-text-field label="Community Name" v-model="form.communityName" :rules="[
                                        v => !!v || 'Field is required'
                                    ]" />
                                    <br>
                                    <h4>
                                        Community Primary Color
                                    </h4>
                                    <br>
                                    <v-row>
                                        <v-col>
                                            <v-color-picker v-model="form.communityTheme" hide-sliders hide-inputs
                                                canvas-height="250" height="250" />
                                        </v-col>
                                        <v-col style="padding-top: 0px;">
                                            <v-color-picker v-model="form.communityTheme" hide-canvas hide-sliders
                                                hide-inputs show-swatches swatches-max-height="250" />
                                        </v-col>
                                    </v-row>
                                    <br>
                                    <v-autocomplete label="Community Time Zone" :menu-props="{
                                        height: 250
                                    }" v-model="form.communityTimezone" :items="timezones"></v-autocomplete>
                                    <br>
                                    <v-row>
                                        <v-col />
                                        <v-col style="text-align: right;">
                                            <v-btn :disabled="form.communityName == ''"
                                                @click="() => { tab = 'DiscordSettings' }" color="green-darken-3">Next</v-btn>
                                        </v-col>
                                    </v-row>
                                </v-window-item>

                                <v-window-item value="DiscordSettings">
                                    <br>
                                    <v-text-field label="Discord Server ID" v-model="form.discordServerID" :rules="[
                                        v => !!v || 'Field is required'
                                    ]" />
                                    <br>
                                    <v-text-field label="Discord Client ID" v-model="form.discordClientID" :rules="[
                                        v => !!v || 'Field is required'
                                    ]" />
                                    <br>
                                    <v-text-field label="Discord Secret" type="password" v-model="form.discordSecret"
                                        :rules="[
                                            v => !!v || 'Field is required'
                                        ]" />
                                    <br>
                                    <v-text-field label="Discord Bot Token" type="password"
                                        v-model="form.discordBotToken" :rules="[
                                            v => !!v || 'Field is required'
                                        ]" />
                                    <v-row>
                                        <v-col style="text-align: left;">
                                            <v-btn
                                                @click="() => { tab = 'CommunitySettings' }"
                                                color="red-darken-3">Back</v-btn>
                                        </v-col>
                                        <v-col style="text-align: right;">
                                            <v-btn
                                                :disabled="form.discordClientID == '' || form.discordSecret == '' || form.discordBotToken == ''"
                                                @click="() => { tab = 'TeamSpeakSettings' }"
                                                color="green-darken-3">Next</v-btn>
                                        </v-col>
                                    </v-row>
                                </v-window-item>

                                <v-window-item value="TeamSpeakSettings">
                                    <br>
                                    <v-text-field label="TeamSpeak Server IP" v-model="form.teamspeakServerIP" :rules="[
                                        v => !!v || 'Field is required'
                                    ]" />
                                    <br>
                                    <v-text-field label="TeamSpeak Server Port" v-model="form.teamspeakServerPort"
                                        :rules="[
                                            v => !!v || 'Field is required'
                                        ]" />
                                    <br>
                                    <v-text-field label="TeamSpeak ServerQuery Username"
                                        v-model="form.teamspeakServerQueryUsername" :rules="[
                                            v => !!v || 'Field is required'
                                        ]" />
                                    <br>
                                    <v-text-field label="TeamSpeak ServerQuery Password" type="password"
                                        v-model="form.teamspeakServerQueryPassword" :rules="[
                                            v => !!v || 'Field is required'
                                        ]" />
                                    <br>
                                    <v-text-field label="TeamSpeak ServerQuery Port"
                                        v-model="form.teamspeakServerQueryPort" :rules="[
                                            v => !!v || 'Field is required'
                                        ]" />
                                    <br>
                                    <v-row>
                                        <v-col style="text-align: left;">
                                            <v-btn
                                                @click="() => { tab = 'DiscordSettings' }"
                                                color="red-darken-3">Back</v-btn>
                                        </v-col>
                                        <v-col style="text-align: right;">
                                            <v-btn
                                                :disabled="form.teamspeakServerIP == '' || form.teamspeakServerPort == '' || form.teamspeakServerQueryUsername == '' || form.teamspeakServerQueryPassword == '' || form.teamspeakServerQueryPort == ''"
                                                @click="form.post('/installer')"
                                                color="green-darken-3">Install</v-btn>
                                        </v-col>
                                    </v-row>
                                </v-window-item>
                            </v-window>
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col />
            </v-row>
        </v-main>
    </v-app>
</template>

<style>
#switch-8 {
    z-index: 1000;
}
</style>