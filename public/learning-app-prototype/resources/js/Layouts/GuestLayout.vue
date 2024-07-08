<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Footer from '@/Layouts/Footer.vue';

import { Link } from '@inertiajs/vue3';
</script>

<template>
    <!-- Page Content -->
    <main class="main">
        <div class="guest-layout">
            <!-- Logo
            <div class="logo">
                <Link :href="route('/')" as="button">
                    <ApplicationLogo class="logo-icon" />
                </Link>
            </div> -->
            <div>
                <slot />
            </div>
        </div>
    </main>
    <Footer class="footer">
        <p>AGB</p>
        <p>Datenschutz</p>
    </Footer>
</template>
<style scoped lang="scss">
@import '../../css/_main.scss';

.main {
    margin-top: 3rem;
    padding: 0 2rem;

    @include breakpoint("mobile") {
        margin-top: 0rem;
    }

    .guest-layout {
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: $background;
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