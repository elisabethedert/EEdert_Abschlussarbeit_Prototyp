<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button
        :type="type"
        class="btn btn-green"
    >
        <slot />
    </button>
</template>
<style scoped>
@import '../../css/_main.scss';
</style>
