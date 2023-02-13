<template>
    <div id="orbat" ref="orbat"></div>
</template>

<script>
import OrgChart from '@balkangraph/orgchart.js'
import { usePage } from '@inertiajs/vue3';
export default {
    name: 'orbat',
    props: [
        "data"
    ],
    data() {
        return {
            page: null,
            nodes: [],
            chart: null,
        }
    },
    methods: {
        mytree: function (domEl, x) {
            OrgChart.templates.ORBAT = Object.assign({}, OrgChart.templates.ana);
            OrgChart.templates.ORBAT.node = '<rect width="{w}" height="{h}" fill="#0000" stroke="#aeaeae" stroke-width="1"></rect>';
            OrgChart.templates.ORBAT.field_1 =
                '<text class="field_0" style="font-size: 20px;" fill="#ffffff" x="125" y="50" text-anchor="middle">{val}</text>';
            OrgChart.templates.ORBAT.field_2 =
                '<text class="field_1" data-width="200" data-text-overflow="multiline-2-ellipsis" style="font-size: 14px;" fill="#ffffff" x="125" y="65" text-anchor="middle">{val}</text>';

            OrgChart.templates.ORBAT_Company = Object.assign({}, OrgChart.templates.ORBAT)
            OrgChart.templates.ORBAT_Company.field_0 =
                '<text class="field_1" style="font-size: 14px;" fill="#ffffff" x="125" y="20" text-anchor="middle">Company</text>';
            OrgChart.templates.ORBAT_Platoon = Object.assign({}, OrgChart.templates.ORBAT)
            OrgChart.templates.ORBAT_Platoon.field_0 =
                '<text class="field_1" style="font-size: 14px;" fill="#ffffff" x="125" y="20" text-anchor="middle">Platoon</text>';
            OrgChart.templates.ORBAT_Squad = Object.assign({}, OrgChart.templates.ORBAT)
            OrgChart.templates.ORBAT_Squad.field_0 =
                '<text class="field_1" style="font-size: 14px;" fill="#ffffff" x="125" y="20" text-anchor="middle">Squad</text>';
            OrgChart.templates.ORBAT_Fireteam = Object.assign({}, OrgChart.templates.ORBAT)
            OrgChart.templates.ORBAT_Fireteam.field_0 =
                '<text class="field_1" style="font-size: 14px;" fill="#ffffff" x="125" y="20" text-anchor="middle">Fireteam</text>';
            OrgChart.templates.ORBAT_Member = Object.assign({}, OrgChart.templates.ORBAT)
            OrgChart.templates.ORBAT_Member.field_0 =
                '<text class="field_1" style="font-size: 14px;" fill="#ffffff" x="125" y="20" text-anchor="middle">Member</text>';
            this.page = usePage();

            let can_edit = false;
            for (let i = 0; i < this.page.props.User.roles.length; i++) {
                for (let e = 0; e < this.page.props.User.roles[i].permissions.length; e++) {
                    if (this.page.props.User.roles[i].permissions[e] == "orbat.update") {
                        can_edit=true;
                        break;
                    }
                }
            }

            this.chart = new OrgChart(domEl, {
                mode: 'dark',
                template: 'ORBAT',
                nodes: x,
                enableSearch: false,
                nodeMouseClick: OrgChart.action.none,
                nodeBinding: {
                    field_0: "id",
                    field_1: "name",
                    field_2: "description",
                },
                orientation: OrgChart.orientation.left_top,
                tags: {
                    "company": {
                        mode: 'dark',
                        template: 'ORBAT_Company',
                    },
                    "platoon": {
                        mode: 'dark',
                        template: 'ORBAT_Platoon',
                    },
                    "squad": {
                        mode: 'dark',
                        template: 'ORBAT_Squad',
                    },
                    "fireteam": {
                        mode: 'dark',
                        template: 'ORBAT_Fireteam',
                    },
                    "member": {
                        mode: 'dark',
                        template: 'ORBAT_Member',
                    }
                }
            });
        }
    },
    mounted() {
        this.data.forEach(company => {
            this.nodes.push({
                id: company.id,
                name: company.name,
                description: company.description,
                tags: ['company']
            })
            company.platoons.forEach(platoon => {
                this.nodes.push({
                    id: platoon.id,
                    pid: platoon.company_id,
                    description: platoon.description,
                    name: platoon.name,
                    tags: ['platoon']
                })
                platoon.squads.forEach(squad => {
                    this.nodes.push({
                        id: squad.id,
                        pid: squad.platoon_id,
                        description: squad.description,
                        name: squad.name,
                        tags: ['squad']
                    })
                    squad.fireteams.forEach(fireteam => {
                        this.nodes.push({
                            id: fireteam.id,
                            pid: fireteam.squad_id,
                            description: fireteam.description,
                            name: fireteam.name,
                            tags: ['fireteam']
                        })
                        fireteam.members.forEach(member => {
                            this.nodes.push({
                                id: member.uuid,
                                pid: member.fireteam_id,
                                name: member.name,
                                tags: ['member']
                            })
                        })
                    })
                })
            })
        });
        this.mytree(this.$refs.orbat, this.nodes)
        this.chart.on('save', (sender, args, args1, args2) => {
            console.log({sender, args, args1, args2})
        })
    }
}
</script>
<style>
#orbat {
    height: calc(100vh - 80px) !important;
}
</style>