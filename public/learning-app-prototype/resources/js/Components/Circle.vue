<script setup>
const props = defineProps({
    bgColor: String,
    textColor: String,
    width: Number,
})
</script>

<template>
    <div class="circle">
        <svg :width="width" :height="width" viewBox="0 0 421 431" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="210.5" cy="220.5" r="210.5" fill="#CCC8C8" />
            <circle cx="210.5" cy="210.5" r="210.5" :fill="'#' + bgColor" />
        </svg>
        <div class="content">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.circle {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 1rem;

    .content {
        position: absolute;
        gap: 0.25rem;
        text-align: center;
        align-items: center;
        padding: 2rem;
        display: flex;
        flex-direction: column;
    }
}
</style>