<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'btn-text active'
        : 'notactive '
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';
.active {
    text-decoration: underline 2px;
    padding-left: 1rem;
}

.notactive {
    display: block;
    padding-left: 1rem;
    color: $blue;
    font-size: 1.25rem;
}
</style>
