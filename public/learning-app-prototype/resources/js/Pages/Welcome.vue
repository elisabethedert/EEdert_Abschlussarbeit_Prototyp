<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Footer from '@/Layouts/Footer.vue';
import Arrow from '@/assets/Arrow.vue';
import DropdownNav from '@/Components/DropdownNav.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Circle from '@/Components/Circle.vue';
import Fig2 from '@/assets/Fig2.vue';
import Blink from '@/assets/Blink.vue';
import ArrowRound from '@/assets/ArrowRound.vue';

import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>

    <Head title="Welcome" />
    <header>
        <nav v-if="canLogin" class="topnav">
            <div class="logo">
                <Link>
                <ApplicationLogo class="logo-icon" />
                </Link>
            </div>
            <Link class="btn-text item" v-if="$page.props.auth.user" :href="route('dashboard')">
            Dashboard
            </Link>
            <Link class="btn-text item" v-if="$page.props.auth.user" :href="route('dashboard')">
            Team
            </Link>
            <template v-else>
                <Link class="btn-text item" :href="route('login')">
                Log in
                </Link>
                <Link class="btn-text item" v-if="canRegister" :href="route('register')">
                Register
                </Link>
            </template>
        </nav>
        <DropdownNav v-if="!canLogin" />
    </header>
    <GuestLayout>
        <div class="intro-text">
            <div class="headline">
                <h1>Circulo</h1>
                <Blink width="40" />
            </div>

            <h2>Secure Product Design</h2>
            <p><b>Entdecke mit Circulo spielerisch die Grundlagen von Secure Product Design. Mit interaktiven
                    Herausforderungen und
                    spannenden Aufgaben erlernst du die wichtigsten Sicherheitsprinzipien in der Produktentwicklung.
                    Werde
                    zum Sicherheitsexperten und gestalte zukunftssichere Produkte!
                </b></p>
            <div class="link">
                <Fig2 width="100" />
                <Link class="btn btn-yellow" :href="route('login')">
                Los geht's!
                <Arrow />
                </Link>
            </div>
        </div>
        <div class="about">
            <h2>Headline</h2>
            <div class="description">
                <p>Mit Circulo meisterst abwechslungsreiche Aufgaben von den Grundlagen bis zum Expertenwissen.
                    Profitiere
                    von einer motivierenden Lernumgebung, die mühelosen Lernfortschritt und zeitliche Flexibilität
                    bietet.
                    Entdecke, wie einfach und spannend Secure Product Design sein kann!</p>
                <ArrowRound class="arrow" width="80" />
            </div>
            <div class="arguments">
                <Circle width="225" bgColor="67917B">
                    <h3>Alleine oder im Team</h3>
                    <p>Lerne nur für dich oder mit deinen Kolleg:innen.</p>
                </Circle>
                <Circle width="225" bgColor="67917B">
                    <h3>Von den Grundlagen bis zum Expertenwissen</h3>
                    <p>Lerne die Konzepte von Secure Design kennen.</p>
                </Circle>

                <Circle width="225" bgColor="67917B">
                    <h3>Müheloser Lernforschritt</h3>
                    <p>Erlebe kontinuierlichen Lernfortschritt</p>
                </Circle>
                <Circle width="225" bgColor="67917B">
                    <h3>Abwechslungsreiche Aufgaben</h3>
                    <p>Profitiere von einer motivierenden Lernumgebung.</p>
                </Circle>
            </div>
        </div>
    </GuestLayout>
    <Footer class="footer">
        <p>AGB</p>
        <p>Datenschutz</p>
    </Footer>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.topnav {
    margin-inline: 2rem;
    max-width: 1200px;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    padding-top: 1rem;

    @include breakpoint("mobile") {
        margin-inline: 1rem;
        padding-top: 2rem;
        gap: 1rem;
    }

    .item {
        padding: 1rem;

        @include breakpoint("mobile") {
            padding: 0;
        }
    }

    .logo svg {
        padding: 1rem 0rem 1rem 0rem;
        width: 55px;

        @include breakpoint("mobile") {
            display: none;
        }
    }
}

.intro-text {
    text-align: center;
    display: flex;
    align-items: center;
    flex-direction: column;

    .headline {
        display: flex;
        align-items: center;

        h1 {
            font-size: 4rem;
            padding-top: 4rem;
        }
    }

    p {
        margin-top: 2rem;
        max-width: 800px;
    }

    .link {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 4rem;
    }
}

.about {
    display: flex;
    align-items: center;
    flex-direction: column;

    h2 {
        margin-top: 4rem;
    }

    .description {
        display: flex;

        @include breakpoint("mobile") {
            flex-direction: column;
            align-items: center;
        }

        p {
            text-align: center;
            margin-top: 1rem;
            max-width: 800px;
        }
    }

    .arguments {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
        justify-content: center;

        @include breakpoint("mobile") {
            justify-content: center;
        }

        h3,
        p {
            color: $white;
        }
    }
}

.footer {
    padding-top: 4rem;

    p {
        padding: 0.25rem;
        color: white;
    }
}
</style>
