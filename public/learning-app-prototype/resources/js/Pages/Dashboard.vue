<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <h1>You're logged in!</h1>
        <button class="btn btn-yellow">Spiel starten</button>
    </AuthenticatedLayout>
</template>

<style scoped>
@import '../../css/_main.scss';
</style>

