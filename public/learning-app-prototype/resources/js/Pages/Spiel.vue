<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import Fig1 from '@/assets/Fig1.vue';
import Fig2 from '@/assets/Fig2.vue';
import Fig3 from '@/assets/Fig3.vue';

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
        <div class="intro-text">
            <h1>Lektionsübersicht</h1>
            <h2>Hier kannst du deinen Lektionsfortschritt sehen</h2>
            <h2>{{ $page.props.auth.user.current_lecture }}</h2>
        </div>
        <div class="lecture">
            <div class="lecture-container">
                <div class="description">
                    <Fig1 />
                    <h3>Begriff und Einordnung</h3>
                </div>
                <Link href="spiel/lektion1" type="button" class="btn btn-yellow">Lektion 1</Link>
            </div>

            <div class="lecture-container">
                <div class="description">
                    <Fig2 />
                    <h3>Schutzziele</h3>
                </div>
                <Link :class="{ disabled: $page.props.auth.user.current_lecture <= 1 }" href="spiel/lektion2"
                    type="button" class="btn btn-yellow">Lektion 2</Link>
            </div>

            <div class="lecture-container">
                <div class="description">
                    <Fig3 />
                    <h3>Identity Management</h3>
                </div>
                <Link :class="{ disabled: $page.props.auth.user.current_lecture <= 2 }" href="spiel/lektion3"
                    type="button" class="btn btn-yellow">Lektion 3</Link>
            </div>

            <div class="lecture-container">
                <div class="description">
                    <Fig1 />
                    <h3>Security/Privacy by Design/Default</h3>
                </div>
                <Link :class="{ disabled: $page.props.auth.user.current_lecture <= 3 }" href="spiel/lektion4"
                    type="button" class="btn btn-yellow">Lektion 4</Link>
            </div>

            <div class="lecture-container">
                <div class="description">
                    <Fig2 />
                    <h3>Abschluss der Unit</h3>
                </div>
                <Link :class="{ disabled: $page.props.auth.user.current_lecture <= 4 }" href="spiel/lektion4"
                    type="button" class="btn btn-yellow">Lektion 5</Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.intro-text {
    h2 {
        text-align: center;
        margin-top: 2rem;
    }
}

.lecture-container {

    .disabled {
        opacity: 0.25;
        pointer-events: none;
    }

    background-color: $background-light;
    border-radius: 50px;
    padding: 2rem;
    display: flex;
    gap: 5rem;
    justify-content: center;
    align-items: center;
    margin: 2rem;

    &:nth-child(even) {
        flex-direction: row-reverse;

        @include breakpoint("mobile") {
            flex-direction: column;
        }
    }

    &:nth-child(odd) {
        flex-direction: row;

        @include breakpoint("mobile") {
            flex-direction: column;
        }
    }

    @include breakpoint("mobile") {
        gap: 2rem;
    }


    .description {

        display: flex;
        flex-direction: column;
        align-items: center;

        h3 {
            text-align: center;
            color: $blue;
            margin-top: 2rem;
        }
    }
}
</style>