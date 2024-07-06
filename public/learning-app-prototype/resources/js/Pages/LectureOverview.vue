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

    <Head title="Lektionsübersicht" />

    <AuthenticatedLayout>
        <div class="intro-text">
            <h1>Lektionsübersicht</h1>
            <h2>Wähle eine Lektion aus, um Neues zu lernen</h2>
        </div>
        <div class="lecture">
            <div class="lecture-container">
                <div class="description">
                    <Fig1 />
                    <h3>Begriff und Einordnung</h3>
                </div>
                <Link href="lektion1" type="button" class="btn btn-green">Lektion 1
                <Arrow />
                </Link>
            </div>

            <div class="lecture-container">
                <div class="description">
                    <Fig2 />
                    <h3>Schutzziele</h3>
                </div>
                <Link :class="{ disabled: $page.props.auth.user.current_lecture <= 1 }" href="lektion2" type="button"
                    class="btn btn-green">Lektion 2
                <Arrow />
                </Link>
            </div>

            <div class="lecture-container">
                <div class="description">
                    <Fig3 />
                    <h3>Identity Management</h3>
                </div>
                <Link :class="{ disabled: $page.props.auth.user.current_lecture <= 2 }" href="lektion3" type="button"
                    class="btn btn-green">Lektion 3
                <Arrow />
                </Link>
            </div>

            <div class="lecture-container">
                <div class="description">
                    <Fig1 />
                    <h3>Security/Privacy by Design/Default</h3>
                </div>
                <Link :class="{ disabled: $page.props.auth.user.current_lecture <= 3 }" href="lektion4" type="button"
                    class="btn btn-green">Lektion 4
                <Arrow />
                </Link>
            </div>

            <div class="lecture-container">
                <div class="description">
                    <Fig2 />
                    <h3>Abschluss der Unit</h3>
                </div>
                <Link :class="{ disabled: $page.props.auth.user.current_lecture <= 4 }" href="lektion5" type="button"
                    class="btn btn-green">Lektion 5
                <Arrow />
                </Link>
            </div>
        </div>
        <div class="links">
            <Link href="/dashboard" type="button" class="btn btn-yellow">Link zurück zum Dashboard</Link>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.lecture-container {

    .disabled {
        opacity: 0.25;
        pointer-events: none;
    }

    background-color: $background-light;
    border-radius: 50px;
    padding: 2rem;
    display: flex;
    gap: 10rem;
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

.links {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>