<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="input-label">
        <span v-if="value">{{ value }}</span>
        <span v-else>
            <slot />
        </span>
    </label>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.input-label {
    color: $blue;
    font-weight: bold;
}
</style>