<script setup>

const props = defineProps(['data'])

</script>

<template>
    <div class="d-flex flex-column align-center">
        <template v-for="company in props.data">
            <div style="min-width: 100px; padding: 1rem; border: white 1px solid;">
                {{ company.name }}
            </div>
            <div class="d-flex flex-row justify-center flex-wrap w-100 mt-4">
                <template v-for="platoon in company.platoons">
                    <div style="min-width: 100px; padding: 1rem; border: white 1px solid;">
                        {{ platoon.name }}
                    </div>
                    <div class="d-flex flex-row justify-space-between flex-wrap w-100 mt-4">
                        <template v-for="squad in platoon.squads">
                            <div class="flex-grow-1">
                                <div style="min-width: 100px; padding: 1rem; border: white 1px solid; margin: 0 5px;">
                                    {{ squad.name }}
                                </div>
                                <div class="d-flex flex-column align-center flex-wrap w-100 mt-4">
                                    <template v-for="fireteam in squad.fireteams">
                                        <div style="min-width: 100px; padding: 1rem; border: white 1px solid; margin: 0 5px;">
                                            {{ fireteam.name }}
                                        </div>
                                        <div class="d-flex flex-column align-end flex-wrap w-100 mt-4">
                                            <template v-for="member in fireteam.members">
                                                <div style="min-width: 100px; padding: 1rem; border: white 1px solid; margin: 0 5px;">
                                                    {{ member.name }}
                                                </div>
                                                <br>
                                            </template>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </template>
    </div>
</template>