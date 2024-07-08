<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Footer from '@/Layouts/Footer.vue';
import Nav from '@/Components/Nav.vue';

</script>

<template>
    <div class="guest-layout">

        <main class="main">
            <slot />
        </main>
        <Footer class="footer">
            <p>AGB</p>
            <p>Datenschutz</p>
        </Footer>
    </div>
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
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    padding-top: 4rem;

    p {
        padding: 0.25rem;
        color: white;
    }
}
</style>