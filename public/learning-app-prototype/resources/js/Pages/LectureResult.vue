<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    percentage: Number,
    comment: String
})
</script>

<template>
    <Head title="Ergebnis" />

    <AuthenticatedLayout>
        <h1>{{ comment }}</h1>
        <p class="lead mb-4">Your Score is {{ percentage }}%</p>
    </AuthenticatedLayout>
</template>
<style scoped>
@import '../../css/_main.scss';
</style>
