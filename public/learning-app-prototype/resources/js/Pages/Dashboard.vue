<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Arrow from '@/assets/Arrow.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed, onMounted, onUnmounted } from 'vue';
import Fig1 from '@/assets/Fig1.vue';
import Fig2 from '@/assets/Fig2.vue';
import Fig3 from '@/assets/Fig3.vue';

const props = defineProps({
    streak: Number
})
const handleScroll = (event) => {
    const delta = Math.max(-1, Math.min(1, (event.wheelDelta || -event.detail)));
    const scrolling = event.target.closest('.units');
    scrolling.scrollLeft += delta * -60;
    event.preventDefault();
};

onMounted(() => {
    const scrollContainer = document.querySelector('.units');
    if (scrollContainer === null) {
        return;
    }
    scrollContainer.addEventListener('mousewheel', handleScroll);
    scrollContainer.addEventListener('DOMMouseScroll', handleScroll);
});

onUnmounted(() => {
    const scrollContainer = document.querySelector('.units');
    if (scrollContainer === null) {
        return;
    }
    scrollContainer.removeEventListener('mousewheel', handleScroll);
    scrollContainer.removeEventListener('DOMMouseScroll', handleScroll);
});


</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="intro-text">
            <h1>Hey {{ $page.props.auth.user.name }}!<br>Schön dich zu sehen!</h1>
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
                    <h3>{{ streak }}</h3>
                    <p>Streak</p>
                </div>
            </div>
        </div>
        <div class="intro-text">
            <p><b>Hinter jeder Unit verbirgt sich ein neuer Schwerpunkt, den du vertiefen kannst.</b></p>
        </div>
        <div class="units">
            <div class="circle">
                <svg width="300" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg">

                </svg>
                <div class="content">
                    <Fig1 class="figure" />
                    <h3>Grundlagen</h3>
                    <Link :class="{ disabled: $page.props.auth.user.unit <= 1 }" href="unit1/lektionen" type="button"
                        class="btn btn-yellow">Unit 1
                    <!-- <Arrow /> -->
                    </Link>
                </div>
            </div>
            <div class="circle light">
                <svg width="300" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg">
                </svg>
                <div class="content">
                    <Fig2 class="figure" />
                    <h3>Security <br>Principles</h3>
                    <Link :class="{ disabled: $page.props.auth.user.unit <= 1 }" href="unit1/lektionen" type="button"
                        class="btn btn-yellow">Unit 2
                    <!-- <Arrow /> -->
                    </Link>
                </div>
            </div>
            <div class="circle">
                <svg width="300" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg">
                </svg>
                <div class="content">
                    <Fig3 class="figure" />
                    <h3>Security <br> Fokus Areas</h3>
                    <Link :class="{ disabled: $page.props.auth.user.unit <= 1 }" href="unit1/lektionen" type="button"
                        class="btn btn-yellow">Unit 3
                    <!-- <Arrow /> -->
                    </Link>
                </div>
            </div>
            <div class="circle">
                <svg width="300" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg">
                </svg>
                <div class="content">
                    <Fig1 class="figure" />
                    <h3>Security <br> Fokus Areas</h3>
                    <Link :class="{ disabled: $page.props.auth.user.unit <= 1 }" href="unit1/lektionen" type="button"
                        class="btn btn-yellow">Unit 3
                    <!-- <Arrow /> -->
                    </Link>
                </div>
            </div>
            <div class="circle">
                <svg width="300" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg">
                </svg>
                <div class="content">
                    <Fig2 class="figure" />
                    <h3>Security <br> Fokus Areas</h3>
                    <Link :class="{ disabled: $page.props.auth.user.unit <= 1 }" href="unit1/lektionen" type="button"
                        class="btn btn-yellow">Unit 3
                    <!-- <Arrow /> -->
                    </Link>
                </div>
            </div>
            <div class="circle">
                <svg width="300" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg">
                </svg>
                <div class="content">
                    <Fig3 class="figure" />
                    <h3>Security <br> Fokus Areas</h3>
                    <Link :class="{ disabled: $page.props.auth.user.unit <= 1 }" href="unit1/lektionen" type="button"
                        class="btn btn-yellow">Unit 3
                    <!-- <Arrow /> -->
                    </Link>
                </div>
            </div>
            <div class="circle">
                <svg width="300" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg">
                </svg>
                <div class="content">
                    <Fig1 class="figure" />
                    <h3>Security <br> Fokus Areas</h3>
                    <Link :class="{ disabled: $page.props.auth.user.unit <= 1 }" href="unit1/lektionen" type="button"
                        class="btn btn-yellow">Unit 3
                    <!-- <Arrow /> -->
                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';


.intro-text {
    text-align: center;
}

.units {
    overflow: auto;
    display: flex;
    flex-direction: row;
    background-color: $background-light;
    border-radius: 25px;
    margin: 2rem;

    .circle {
        position: relative;
        margin: 3rem;
        width: 300px;
        height: 310px;

        &:nth-child(3n+1) {
            background-image: url('data:image/svg+xml,%3Csvg width="250" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg"%3E%3Ccircle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 8)" fill="%23CCC8C8" /%3E%3Ccircle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 0)" fill="%2367917B" /%3E%3C/svg%3E');
        }

        &:nth-child(3n+2) {
            background-image: url('data:image/svg+xml,%3Csvg width="250" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg"%3E%3Ccircle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 8)" fill="%23CCC8C8" /%3E%3Ccircle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 0)" fill="%23FBF4CE" /%3E%3C/svg%3E');

            h3 {
                color: $blue !important;
            }
        }

        &:nth-child(3n) {
            background-image: url('data:image/svg+xml,%3Csvg width="250" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg"%3E%3Ccircle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 8)" fill="%23CCC8C8" /%3E%3Ccircle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 0)" fill="%23103A51" /%3E%3C/svg%3E');
        }

        background-size: cover;

        @include breakpoint('mobile') {
            width: 210px;
            height: 217px;
        }


        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            display: flex;
            gap: 1rem;
            flex-direction: column;
            align-items: center;

            .figure {
                position: relative;
                width: 55px;

                @include breakpoint('mobile') {
                    display: none;
                }
            }

            h3 {
                color: $white;
                font-size: 1.75rem;

                @include breakpoint('mobile') {
                    font-size: 1.25rem;
                }
            }

            p {
                color: $white;
                font-size: larger;
            }
        }


    }
}


.player-info {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-block: 2rem;
    gap: 2rem;

    @include breakpoint('mobile') {
        flex-direction: column;
    }

    .circle {
        position: relative;
        width: 100px;
        height: 100px;

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
                font-size: 1.5rem;

            }

            p {
                color: $white;
                font-size: larger;
            }
        }
    }
}
</style>
