<script setup>
const props = defineProps({
    visible: Boolean
});

</script>

<template>
    <div v-if="visible" class="help-popup">
        <div class="inner">
            <slot></slot>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.help-popup {
    padding: 1rem;
    right: 3rem;
    top: 15rem;
    background-color: $grey;
    border-radius: 10px;
    z-index: 60;


    .inner {

        z-index: 70;
        color: $white;
    }
}</style>