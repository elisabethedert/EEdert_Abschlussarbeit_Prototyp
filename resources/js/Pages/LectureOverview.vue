<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Footer from '@/Layouts/Footer.vue';
import Arrow from '@/Assets/Arrow.vue';
import Level from '@/Components/Level.vue';
import { Head, Link } from '@inertiajs/vue3';
import Fig1 from '@/Assets/Fig1.vue';
import Fig2 from '@/Assets/Fig2.vue';
import Fig3 from '@/Assets/Fig3.vue';

defineProps({
    highestLectureInUnit: Number,
})
</script>
<template>

    <Head title="Lektionsübersicht" />

    <AuthenticatedLayout>
        <div class="intro-text">
            <h1>Lektionsübersicht</h1>
            <h2>Wähle eine Lektion aus, um Neues zu lernen</h2>
        </div>

        <!-- all lectures of unit -->
        <div class="lecture">
            <div class="lecture-container">
                <div class="description">
                    <h3>Sicheres Produktdesign & Secure Development Lifecycle</h3>
                    <Level :level="1" />
                </div>
                <Link href="lektion1" type="button" class="btn btn-green">Lektion 1
                <Arrow />
                </Link>
            </div>

            <div class="lecture-container">
                <div class="description">
                    <h3>Schutzziele</h3>
                    <Level :level="1" />
                </div>
                <div class="figure">
                    <Fig1 :width="95" />
                    <Link :class="{ disabled: highestLectureInUnit <= 0 }" href="lektion2" type="button"
                        class="btn btn-green">Lektion 2
                    <Arrow />
                    </Link>
                </div>
            </div>

            <div class="lecture-container">
                <div class="description">
                    <h3>Schutzziele</h3>
                    <Level :level="1" />
                    <h3>Sicheres Produktdesign & Secure Development Lifecycle</h3>
                    <Level :level="2" />
                </div>
                <Link :class="{ disabled: highestLectureInUnit <= 1 }" href="lektion3" type="button"
                    class="btn btn-green">Lektion 3
                <Arrow />
                </Link>
            </div>

            <div class="lecture-container">
                <div class="description">
                    <h3>Identity Management</h3>
                    <Level :level="1" />
                    <h3>Schutzziele</h3>
                    <Level :level="2" />
                </div>
                <Link :class="{ disabled: highestLectureInUnit <= 2 }" href="lektion4" type="button"
                    class="btn btn-green">Lektion 4
                <Arrow />
                </Link>
            </div>

            <div class="lecture-container">
                <div class="description">
                    <h3>Schutzziele </h3>
                    <Level :level="1" />
                    <h3>Sicheres Produktdesign & Secure Development Lifecycle</h3>
                    <Level :level="3" />
                </div>
                <div class="figure">
                    <Fig2 :width="95"/>
                    <Link :class="{ disabled: highestLectureInUnit <= 3 }" href="lektion5" type="button"
                        class="btn btn-green">Lektion 5
                    <Arrow />
                    </Link>
                </div>
            </div>
            <div class="lecture-container">
                <div class="description">
                    <h3>Security/Privacy by Design/Default</h3>
                    <Level :level="1" />
                    <h3>Identity Management</h3>
                    <Level :level="2" />
                </div>
                <Link :class="{ disabled: highestLectureInUnit <= 4 }" href="lektion6" type="button"
                    class="btn btn-green">Lektion 6
                <Arrow />
                </Link>
            </div>
            <div class="lecture-container">
                <div class="description">
                    <h3>Identity Management</h3>
                    <Level :level="2" />
                    <h3>Schutzziele</h3>
                    <Level :level="3" />
                </div>

                <Link :class="{ disabled: highestLectureInUnit <= 5 }" href="lektion7" type="button"
                    class="btn btn-green">Lektion 7
                <Arrow />
                </Link>
            </div>
            <div class="lecture-container">
                <div class="description">
                    <h3>Security/Privacy by Design/Default</h3>
                    <Level :level="2" />
                    <h3>Identity Management</h3>
                    <Level :level="3" />
                </div>
                <div class="figure">
                    <Fig3 :width="95"/>
                    <Link :class="{ disabled: highestLectureInUnit <= 6 }" href="lektion8" type="button"
                        class="btn btn-green">Lektion 8
                    <Arrow />
                    </Link>
                </div>
            </div>
            <div class="lecture-container">
                <div class="description">
                    <h3>Security/Privacy by Design/Default</h3>
                    <Level :level="3" />
                    <h3>+ Wiederholung</h3>
                </div>
                <Link :class="{ disabled: highestLectureInUnit <= 7 }" href="lektion9" type="button"
                    class="btn btn-green">Lektion 9
                <Arrow />
                </Link>
            </div>
        </div>
        <div class="links">
            <Link href="/dashboard" type="button" class="btn btn-yellow">Link zurück zum Dashboard</Link>
        </div>
    </AuthenticatedLayout>
    <Footer class="footer">
        <p>AGB</p>
        <p>Datenschutz</p>
    </Footer>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.intro-text {
    margin-top: 2rem;
    text-align: center;
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
    gap: 10rem;
    justify-content: center;
    align-items: center;
    margin: 2rem;
    @include breakpoint("mobile") {
        margin-inline: 0;
    }

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

.figure {
    display: flex;
    flex-direction: column;
    align-items: center;

}

.footer {
    padding-top: 4rem;

    p {
        padding: 0.25rem;
        color: white;
    }
}
</style>