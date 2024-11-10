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

.authenticated-layout {
    background-color: $background;
    align-items: center;
}
</style>