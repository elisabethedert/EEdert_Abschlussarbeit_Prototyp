<script setup>
import { ref } from 'vue';
const props = defineProps({
    visible: Boolean
});

const emit = defineEmits(['showhelp']);

const closeHelpPopup = () => {
    emit('showhelp', false);
};
</script>

<template>
    <div v-if="visible" class="help-popup">
        <div class="inner">
            <svg class="x-close" @click="closeHelpPopup" width="22" height="30" viewBox="0 0 22 30" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1.45353 5.3367C6.07646 12.1582 10.916 18.8359 15.9362 25.3697C16.7576 26.4448 18.2184 26.8556 19.4016 26.0704C20.4681 25.3627 20.9376 23.6829 20.1106 22.5995C15.0821 16.0712 10.2425 9.39344 5.61961 2.57197C3.81413 -0.0944018 -0.351957 2.67033 1.45353 5.3367Z" />
                <path
                    d="M7.21114 27.2354C11.2619 20.0594 15.0874 12.7533 18.7038 5.3496C19.3008 4.13547 19.0185 2.64454 17.7887 1.93454C16.6802 1.29454 14.967 1.62181 14.365 2.8446C10.7573 10.2533 6.93173 17.5594 2.88101 24.7354C1.29699 27.539 5.62712 30.039 7.21114 27.2354Z" />
            </svg>
            <slot></slot>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.help-popup {
    position: fixed;
    padding: 1rem;
    right: 3rem;
    width: 400px;
    top: 15rem;
    background-color: $grey;
    border-radius: 10px;
    z-index: 60;


    .inner {
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 70;
        width: 80%;
        color: $white;

        .x-close {
            position: absolute;
            right: 1rem;
            fill: $blue;
            cursor: pointer;
        }
    }
}</style>