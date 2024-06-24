<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import HappyDance from '@/Components/Animations/HappyDance.vue';
import Arrow from '@/assets/Arrow.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    correctAnswered: Number,
    incorrectAnswered: Number,
    allAnswered: Number,
    lecture: Number,
    // bestScore: Number
})

</script>

<template>

    <Head title="Ergebnis" />

    <AuthenticatedLayout>
        <h1>Lektion {{ lecture }} <br> abgeschlossen!</h1>
        <div class="result-text">
            <p><b>Super, du hast {{ correctAnswered }} von {{ allAnswered }} richtig beantwortet!</b></p>
            <p><b>Dein bestes Ergebnis ist xxxx von {{ allAnswered }}</b></p>
            <p v-if="lecture === $page.props.auth.user.current_lecture">Damit erhälst du {{ correctAnswered * 3 }}
                Punkte
                dazu und hast insgesamt {{ $page.props.auth.user.experience_points }} Punkte</p>
            <HappyDance />
            <div class="links">
                <Link :href="'/unit1/lektionen'" class="btn btn-green">Zurück zur Lektionsübersicht</Link>
                <Link :href="'/unit1/lektion' + (lecture + 1)" type="button" class="btn btn-yellow">Nächste Lektion
                <Arrow />
                </Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped lang="scss">
@import '../../css/_main.scss';

.result-text {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
}

.links {
    display: flex;
    flex-direction: row;
    justify-content: center;
    gap: 20px;
    margin-top: 1rem;

    @include breakpoint("mobile") {
        flex-direction: column;
        width: fit-content;
        align-items: center;
    }
}
</style>
