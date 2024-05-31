<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    event.dataTransfer.setData("text", event.target.id);
}

function drop(event) {
    event.preventDefault();
    const data = event.dataTransfer.getData("text");
    event.target.appendChild(document.getElementById(data));
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <h1>You're logged in!</h1>
        <!-- TODO Button mit richtigem Link -->
        <Link href="spiel" type="button" class="btn btn-yellow">Spiel starten</Link>
        <p>Drag the W3Schools image into the rectangle:</p>

        <div id="div1" @drop="drop" @dragover="allowDrop" style="width: 350px; height: 150px; border: 1px solid black;"></div>
        <br>
        <p id="drag1" draggable="true" @dragstart="drag" style="width: 336px; height: 69px;">draaaaag</p>
        
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

#div1 {
    width: 350px;
    height: 70px;
    padding: 10px;
    border: 1px solid #aaaaaa;
}
</style>

