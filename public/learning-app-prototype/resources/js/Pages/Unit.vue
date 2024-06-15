<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Arrow from '@/assets/Arrow.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import Fig1 from '@/assets/Fig1.vue';
import Fig2 from '@/assets/Fig2.vue';
import Fig3 from '@/assets/Fig3.vue';
</script>
<template>

    <Head title="Spiel" />

    <AuthenticatedLayout>
        <div class="intro-text">
            <h1>Unit-Übersicht</h1>
            <h2>Hinter jeder Unit verbirgt sich ein neuer Schwerpunkt, den du vertiefen kannst</h2>
        </div>
        <div class="units">
            <div class="circle">
                <svg width="300" height="258" viewBox="0 0 250 258" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 8)" fill="#CCC8C8" />
                    <circle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 0)" fill="#103A51" />
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
                    <circle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 8)" fill="#CCC8C8" />
                    <circle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 0)" fill="#FCF9E7" />
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
                    <circle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 8)" fill="#CCC8C8" />
                    <circle cx="125" cy="125" r="125" transform="matrix(-1 0 0 1 250 0)" fill="#67917B" />
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
        </div>
        <div class="links">
            <Link href="/units" type="button" class="btn btn-yellow">Link zurück zum Dashboard</Link>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.units {
    display: flex;
    flex-direction: column;

    .circle:nth-child(even) {
        align-self: flex-end;
        width: 75%;
    }

    .circle:nth-child(odd) {
        width: 75%;
        align-self: flex-start;
    }
}

.circle {
    position: relative;
    margin-block: 3rem;
    width: 300px;
    height: 300px;

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
        display: flex;
        flex-direction: column;
        gap: 1rem;
        align-items: center;

        .figure {
            position: relative;
            width: 55px;
        }

        h3 {
            color: $white;
            font-size: 1.75rem;
        }

        p {
            color: $white;
            font-size: larger;
        }
    }

    &.light {
        .content {

            h3,
            p {
                color: $blue;
            }
        }
    }
}

.links {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>