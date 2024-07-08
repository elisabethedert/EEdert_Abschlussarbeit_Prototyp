<script setup>
import Footer from '@/Layouts/Footer.vue';
import Nav from '@/Components/Nav.vue';
</script>

<template>
    <div class="authenticated-layout">
        <header>
            <Nav />
        </header>
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
}

.footer {
    padding-top: 4rem;

    p {
        padding: 0.25rem;
        color: white;
    }
}

.authenticated-layout {
    background-color: $background;
    align-items: center;
}
</style>