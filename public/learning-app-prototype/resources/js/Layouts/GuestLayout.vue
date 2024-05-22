<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
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
</template>
<style scoped lang="scss">
@import '../../css/_main.scss';

.guest-layout {
    min-height: 100vh;
    background-color: $background;
}
</style>