<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import HappyDance from '@/Components/Animations/HappyDance.vue';
import Arrow from '@/Assets/Arrow.vue';
import Share from '@/Assets/Share.vue';
import Tick from '@/Assets/Tick.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    lectureCount: Number,
    correctAnsweredFirstTry: Number,
    numLecturesInUnit: Number,
    lecture: Number,
    lectureAlreadyAnswered: Number,
    unit: Number,
    isHighestLectureInUnit: Boolean,
    bestScore: Number
})

const showTick = ref(false);
const showShare = ref(true);

/**
 * copies current url to clipboard
 */
function copyToClipboard() {
    const url = window.location.href;
    navigator.clipboard.writeText(url);
    showTick.value = true;
    showShare.value = false;
    setTimeout(() => {
        showTick.value = false;
        showShare.value = true;
    }, 2000);
}
</script>

<template>

    <Head title="Ergebnis" />

    <AuthenticatedLayout>
        <div class="info-header">
            <h1 v-if="!isHighestLectureInUnit">Lektion {{ lecture }} <br> abgeschlossen!</h1>
            <h1 v-if="isHighestLectureInUnit">Unit {{ unit }} <br> abgeschlossen!</h1>
        </div>
        <div class="result-text">
            <p><b>Super, du hast {{ correctAnsweredFirstTry }} von {{ lectureCount }} Aufgaben richtig beantwortet!</b>
            </p>
            <p><b>Dein bestes Ergebnis ist {{ bestScore }} von {{ lectureCount }}</b></p>
            <p v-if="lectureAlreadyAnswered === 1">Damit erhälst du {{ correctAnsweredFirstTry * 3 }}
                Punkte für die richtigen Antworten
                dazu und hast insgesamt {{ $page.props.auth.user.experience_points }} Punkte</p>
            <p v-else="lectureAlreadyAnswered !== 1">Damit erhälst du {{ correctAnsweredFirstTry }}
                Punkte für die Wiederholung der Aufgaben dazu und hast jetzt insgesamt {{
                    $page.props.auth.user.experience_points }} Punkte!</p>
            <HappyDance />

            <div class="links">
                <Link :href="'/unit1/lektionen'" class="btn btn-green">Zurück zur Lektionsübersicht</Link>
                <Link v-if="!isHighestLectureInUnit" :href="'/unit1/lektion' + (lecture + 1)" type="button"
                    class="btn btn-yellow">Nächste Lektion
                <Arrow />
                </Link>
                <Link v-if="isHighestLectureInUnit" :href="'/dashboard'" type="button" class="btn btn-yellow">Zurück zum
                Dashboard
                <Arrow />
                </Link>
            </div>

            <div class="link-share">
                <p><b>Teile dein Ergebnis:</b></p>
                <button class="btn btn-text" @click="copyToClipboard">URL kopieren
                    <Share v-if="showShare" />
                    <Tick v-if="showTick" />
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped lang="scss">
@import '../../css/_main.scss';

.info-header {
    @include breakpoint("mobile") {
        margin-top: 2rem;
    }
}


.result-text {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    text-align: center;

    .link-share {
        margin-top: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;

        .btn {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }
    }
}

.links {
    display: flex;
    flex-direction: row;
    justify-content: center;
    gap: 20px;
    margin-top: 1rem;

    @include breakpoint("mobile") {
        flex-direction: column-reverse;
        width: fit-content;
        align-items: center;
    }
}
</style>
