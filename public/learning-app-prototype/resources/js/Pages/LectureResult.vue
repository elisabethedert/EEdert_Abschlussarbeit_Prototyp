<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    correctAnswered: Number,
    incorrectAnswered: Number,
    lecture: Number,
})
</script>

<template>
    <Head title="Ergebnis" />

    <AuthenticatedLayout>
        <h1>richtige: {{ correctAnswered }}</h1>
        <h1>falsche: {{ incorrectAnswered }}</h1>
        <h1>Lektion: {{ lecture }}</h1>
        <p>{{ $page.props.auth.user.experience_points }}</p>
    </AuthenticatedLayout>
</template>
<style scoped>
@import '../../css/_main.scss';
</style>
