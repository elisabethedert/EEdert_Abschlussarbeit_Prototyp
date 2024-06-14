<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Arrow from '@/assets/Arrow.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    sessionCount: Number
})
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="intro-text">
            <h1>Schön dich zu sehen!</h1>
            <h2>Hier ist dein Lernfortschritt im Überblick</h2>
        </div>
        <div class="player-info">
            <div class="circle">
                <svg width="250" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 8)" fill="#CCC8C8" />
                    <circle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 0)" fill="#67917B" />
                </svg>
                <div class="content">
                    <h3> {{ $page.props.auth.user.experience_points }}</h3>
                    <p>Punkte</p>
                </div>
            </div>
            <div class="circle">
                <svg width="250" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 8)" fill="#CCC8C8" />
                    <circle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 0)" fill="#67917B" />
                </svg>
                <div class="content">
                    <h3> {{ $page.props.auth.user.current_lecture }}.</h3>
                    <p>Lektion</p>
                </div>
            </div>
            <div class="circle">
                <svg width="250" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 8)" fill="#CCC8C8" />
                    <circle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 0)" fill="#67917B" />
                </svg>
                <div class="content">
                    <h3>{{ sessionCount }}</h3>
                    <p>Streak</p>
                </div>
            </div>
        </div>
        <h2>Zeit für eine neue Lektion?</h2>
        <div class="links">
            <Link :href="'/spiel'" class="btn btn-yellow">Lektionsübersicht
                <Arrow/>
            </Link>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.player-info {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-block: 4rem;
    gap: 2rem;

    @include breakpoint('mobile') {
        flex-direction: column;
    }

    .circle {
        position: relative;
        width: 200px;
        height: 200px;

        @include breakpoint('mobile') {
            width: 150px;
            height: 150px;
        }

        svg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            fill: $green;
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;

            h3 {
                color: $white;
                font-size: 3rem;

            }

            p {
                color: $white;
                font-size: larger;
            }
        }
    }
}

.links {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
}
</style>
