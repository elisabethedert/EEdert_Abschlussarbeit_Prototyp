<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <p class="input-error">
            {{ message }}
        </p>
    </div>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.input-error {
    margin-top: 0.25rem;
    color: $danger-red;
}
</style>