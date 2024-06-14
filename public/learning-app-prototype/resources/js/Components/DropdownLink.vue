<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link :href="href" class="dropdown-link">
    <slot />
    </Link>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.dropdown-link {
    display: block;
    width: auto;
    padding: 0 1rem;
    text-align: left;
    font-size: 1rem;
    color: $grey;

    &:focus {
        background-color: $background-light;
        outline: none;
    }

    transition: ease-in-out;
    transition-duration: 150ms;

    @include breakpoint("mobile") {
        padding: 0.75rem 0.25rem;
    }
}
</style>