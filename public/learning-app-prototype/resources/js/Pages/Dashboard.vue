<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2>Dashboard</h2>
        </template>
        <h1>You're logged in!</h1>
        <h2>You're logged in!</h2>
        <h3>You're logged in!</h3>
        <button class="btn btn-yellow">Spiel starten</button>
        <button class="btn btn-green">Spiel starten</button>
        <button class="btn btn-danger">Spiel starten</button>
        <button class="btn-text">Spiel starten</button>
    </AuthenticatedLayout>
</template>

<style scoped>
@import '../../css/_main.scss';
</style>

