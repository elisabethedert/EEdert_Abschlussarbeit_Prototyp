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
    border: 2px solid $danger-red;
}
</style>