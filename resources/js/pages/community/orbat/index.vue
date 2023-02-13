<script setup>
import { usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import Debug from '../../../components/debug.vue';
import Orbat from '../../../components/orbat.vue';

const { props } = usePage()

const selectedUnit = ref(null)

</script>

<template>
    <div>
        <Orbat :data="props.companies"/>
    </div>
    <!-- <div style="height: 100%;">
        <v-row height="100%">
            <v-col>
                <v-card max-width="300">
                    <v-list>
                        <v-list-subheader>Companies</v-list-subheader>
                        <v-list-item v-for="(item, i) in props.companies" :key="i" :value="item"
                            @click="selectedUnit = item" variant="plain">
                            <v-list-item-title v-text="item.name"></v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-card>
                <br>
                <v-card max-width="300">
                    <v-list>
                        <v-list-subheader>Platoons</v-list-subheader>
                        <v-list-item v-for="(item, i) in props.platoons" :key="i" :value="item"
                            @click="selectedUnit = item" variant="plain">
                            <v-list-item-title v-text="item.name"></v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-card>
                <br>
                <v-card max-width="300">
                    <v-list>
                        <v-list-subheader>Squads</v-list-subheader>
                        <v-list-item v-for="(item, i) in props.squads" :key="i" :value="item"
                            @click="selectedUnit = item" variant="plain">
                            <v-list-item-title v-text="item.name"></v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-card>
                <br>
                <v-card max-width="300">
                    <v-list>
                        <v-list-subheader>Fireteams</v-list-subheader>
                        <v-list-item v-for="(item, i) in props.fireteams" :key="i" :value="item"
                            @click="selectedUnit = item" variant="plain">
                            <v-list-item-title v-text="item.name"></v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-card>
            </v-col>
            <v-col>
                <template v-if="selectedUnit != null">
                    <v-card height="100%">
                        <v-card-title>
                            {{ selectedUnit.name }}
                        </v-card-title>
                        <v-card-text>
                            <div>
                                Part of
                                <template v-if="selectedUnit.squad">
                                    <div class="pl-4">
                                        Squad: {{ selectedUnit.squad.name }}
                                    </div>
                                    <div class="pl-4" v-if="selectedUnit.squad.platoon">
                                        Platoon: {{ selectedUnit.squad.platoon.name }}
                                    </div>
                                    <div class="pl-4" v-if="selectedUnit.squad.platoon.company">
                                        Company: {{ selectedUnit.squad.platoon.company.name }}
                                    </div>
                                </template>
                                <template v-if="selectedUnit.platoon">
                                    <div class="pl-4">
                                        Platoon: {{ selectedUnit.platoon.name }}
                                    </div>
                                    <div class="pl-4" v-if="selectedUnit.platoon.company">
                                        Company: {{ selectedUnit.platoon.company.name }}
                                    </div>
                                </template>
                                <template v-if="selectedUnit.company">
                                    <div class="pl-4">
                                        {{ selectedUnit.company.name }}
                                    </div>
                                </template>
                            </div>
                            <br>
                            <template v-if="selectedUnit.members.length > 0">
                                <div>
                                    Members:
                                </div>
                                <br>
                                <div class="pl-4" v-for="member in selectedUnit.members">
                                    {{ member.name }}
                                </div>
                            </template>
                            <template v-else>
                                No Members assigned
                            </template>
                        </v-card-text>
                    </v-card>
                </template>
            </v-col>
        </v-row>
    </div> -->
</template>