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

<style scoped>
@import '../../css/_main.scss';
</style>