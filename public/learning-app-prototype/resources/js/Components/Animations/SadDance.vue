<script setup>
</script>

<template>
    <div class="figure">
        <svg width="250" height="250" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle class="sad head" cx="318" cy="208" r="75" fill="#E3A328" />
            <circle cx="202" cy="265" r="111" fill="#E3A328" />
            <circle class="sad eyes" cx="374" cy="183" r="32.5" stroke="black" stroke-width="5" />
            <circle class="sad eyes" cx="262" cy="183" r="32.5" stroke="black" stroke-width="5" />
            <path d="M227 351C236.333 360.667 252.7 386.4 243.5 412C246.167 408.333 252.9 403.2 258.5 412" stroke="black"
                stroke-width="5" stroke-linecap="round" />
            <path d="M176.5 351C167.167 360.667 150.8 386.4 160 412C157.333 408.333 150.6 403.2 145 412" stroke="black"
                stroke-width="5" stroke-linecap="round" />
        </svg>
    </div>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';

.sad {
    animation-name: down;
    animation-duration: 1.2s;
    animation-direction: alternate;
    animation-timing-function: ease-in-out;
    animation-iteration-count: 1;
    animation-fill-mode: forwards;

    &.head {
        animation-delay: 0.5s;

    }
}

@keyframes down {
    0% {
        transform: translateY(0px);
    }

    100% {
        transform: translateY(25px);
    }
}
</style>
