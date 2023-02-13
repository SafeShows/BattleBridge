<script setup>
import { usePage } from '@inertiajs/vue3'
import debug from '../components/debug.vue';
const {props} = usePage();
</script>

<template>
    <div>
        <debug :value="props" />
    </div>
</template>

<style>
pre {outline: 1px solid #ccc; padding: 5px; margin: 5px; }
.string { color: green; }
.number { color: darkorange; }
.boolean { color: blue; }
.null { color: magenta; }
.key { color: red; }
</style>