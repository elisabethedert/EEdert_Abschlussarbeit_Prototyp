<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

// function goToLesson(number) {
//     //TODO abfragen welches die höchste Lecture number des Users ist
//     axios.post('/spiel/lektion{number}', [
    // neue Route im Backend
    //wenn in L1alle richtig sind kann l2 angezeigt sind
    // get reqeust an /lectures hier die höchste lecture number zurückgeben
// }
</script>
<template>
    <Head title="Spiel" />

    <AuthenticatedLayout>
        <h1>Lektionsübersicht</h1>
        <div>
            <Link href="spiel/lektion1" type="button" class="btn btn-yellow">Lektion 1</Link>
            <Link href="spiel/lektion2" type="button" class="btn btn-yellow">Lektion 2</Link>
            <Link href="spiel/lektion3" type="button" class="btn btn-yellow">Lektion 3</Link>
            <Link href="spiel/lektion4" type="button" class="btn btn-yellow">Lektion 4</Link>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
@import '../../css/_main.scss';
</style>