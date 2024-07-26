<script setup>
</script>

<template>
    <div class="guest-layout">

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

    .guest-layout {
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: $background;
    }
}
</style>