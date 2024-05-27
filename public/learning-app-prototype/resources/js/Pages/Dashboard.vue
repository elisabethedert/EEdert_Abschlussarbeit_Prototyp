<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <h1>You're logged in!</h1>
        <!-- TODO Button mit richtigem Link -->
        <Link href="spiel" type="button" class="btn btn-yellow">Spiel starten</Link>
        </AuthenticatedLayout>
</template>

<style scoped>
@import '../../css/_main.scss';
</style>

