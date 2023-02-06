<script setup>
import { ref } from "vue";

const tab = ref(0);

defineOptions({
    layout: (h, page) => h(page)
});

const colorPicker = ref("#ffffff");
</script>
<template>
    <v-row justify="center">
        <v-col />
        <v-col>
            <br>
            <v-card class="pa-4">
                <v-card-title class="pa-0">BattleBridge - Installer</v-card-title>
                <v-tabs color="#fff" v-model="tab">
                    <v-tab value="one">Community Settings</v-tab>
                    <v-tab value="two">Discord Settings</v-tab>
                    <v-tab value="three">TeamSpeak Settings</v-tab>
                </v-tabs>

                <v-card-text class="pa-0">
                    <v-window v-model="tab">
                        <v-window-item value="one">
                            <br>
                            <v-text-field label="Community Name" :rules="[
                                v => !!v || 'Field is required'
                            ]" />
                            <br>
                            <h4>
                                Community Primary Color
                            </h4>
                            <br>
                            <v-color-picker v-model="colorPicker" />
                        </v-window-item>

                        <v-window-item value="two">
                            Two
                        </v-window-item>

                        <v-window-item value="three">
                            Three
                        </v-window-item>
                    </v-window>
                </v-card-text>
            </v-card>
        </v-col>
        <v-col />
    </v-row>
</template>