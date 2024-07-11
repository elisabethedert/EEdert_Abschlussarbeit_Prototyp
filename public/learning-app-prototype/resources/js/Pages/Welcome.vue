<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Footer from '@/Layouts/Footer.vue';
import Arrow from '@/assets/Arrow.vue';
import DropdownNav from '@/Components/DropdownNav.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Circle from '@/Components/Circle.vue';
import Fig2 from '@/assets/Fig2.vue';
import Blink from '@/assets/Blink.vue';

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
                Registrieren
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
    z-index: 10;
    
    @include breakpoint("mobile") {
        background-color: $background;
        margin-inline: 1rem;
        padding-top: 2rem;
        gap: 1rem;
    }

    .item {
        padding: 1rem;

        @include breakpoint("mobile") {
            padding: 0rem 0rem 1rem 0rem;
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
            @include breakpoint("mobile") {
                padding-top: 6rem;
            }
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


.arguments {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    
    @include breakpoint("mobile") {
        flex-direction: column;
        justify-content: center;
    }

    h3,
    p {
        color: $white;
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
