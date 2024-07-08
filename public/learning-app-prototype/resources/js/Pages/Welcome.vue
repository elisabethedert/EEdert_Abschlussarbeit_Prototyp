<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Arrow from '@/assets/Arrow.vue';

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
            <Link v-if="$page.props.auth.user" :href="route('dashboard')">
            Dashboard
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
    </header>
    <GuestLayout>

        <div class="intro-text">
            <h1>Circulo</h1>
            <h2>Secure Product Design</h2>
            <p>Entdecke mit Circulo spielerisch die Grundlagen von Secure Product Design. Mit interaktiven
                Herausforderungen und
                spannenden Aufgaben erlernst du die wichtigsten Sicherheitsprinzipien in der Produktentwicklung.
                Werde
                zum Sicherheitsexperten und gestalte zukunftssichere Produkte!
            </p>

            <Link class="link btn btn-yellow" :href="route('login')">
            Los geht's!
            <Arrow />
            </Link>
        </div>
        <div class="about">
            <h2>Headline</h2>
            <p>Mit Circulo meisterst abwechslungsreiche Aufgaben von den Grundlagen bis zum Expertenwissen. Profitiere
                von einer motivierenden Lernumgebung, die mühelosen Lernfortschritt und zeitliche Flexibilität bietet.
                Entdecke, wie einfach und spannend Secure Product Design sein kann!</p>
            <div class="arguments">

            </div>
        </div>
    </GuestLayout>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.topnav {
    max-width: 1200px;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    display: flex;
    justify-content: flex-end;

    .item {
        margin-top: 1rem;
        padding: 2rem 1rem 0rem 1rem;
    }
}

.intro-text {
    text-align: center;
    display: flex;
    align-items: center;
    flex-direction: column;

    p {
        margin-top: 2rem;
        max-width: 800px;
    }

    .link {
        margin-top: 2rem;
    }
}

.about {
    h2 {
        margin-top: 4rem;
        text-align: left;
    }

    p {
        margin-top: 1rem;
        max-width: 800px;
    }

    .arguments {

    }
}
</style>
