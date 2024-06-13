<script setup>
</script>

<template>
    <div class="dance2">
        <h3>
            Schade, das war nicht richtig...
        </h3>
        <div class="figure">
            <svg width="250" height="250" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="318" cy="208" r="75" fill="#E3A328" />
                <circle class="figur2-1" cx="202" cy="265" r="111" fill="#E3A328" />
                <path
                    d="M286.833 162C291.314 167.592 294 174.727 294 182.5C294 200.449 279.673 215 262 215C244.327 215 230 200.449 230 182.5C230 174.76 232.664 167.652 237.111 162.071"
                    stroke="black" stroke-width="5" />
                <path d="M294 182C294 200.225 279.673 215 262 215C244.327 215 230 200.225 230 182" stroke="black"
                    stroke-width="5" />
                <circle cx="374" cy="183" r="32.5" stroke="black" stroke-width="5" />
                <circle cx="262" cy="183" r="32.5" stroke="black" stroke-width="5" />
                <path d="M227 351C236.333 360.667 252.7 386.4 243.5 412C246.167 408.333 252.9 403.2 258.5 412"
                    stroke="black" stroke-width="5" stroke-linecap="round" />
                <path d="M176.5 351C167.167 360.667 150.8 386.4 160 412C157.333 408.333 150.6 403.2 145 412" stroke="black"
                    stroke-width="5" stroke-linecap="round" />
            </svg>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';

.dance2 {
    background: $background-light;
    position: absolute;
    top: 55%;
    left: 50%;
    transform: translate(-50%, -50%);

    h3 {
        font-size: 1.75rem;
        color: $blue;
    }
}

.figur2-1 {
    animation-name: dance2;
    animation-duration: 0.9s;
    animation-direction: alternate;
    animation-timing-function: ease-in-out;
    animation-iteration-count: infinite;
}

@keyframes dance2 {
    0% {
        transform: translateX(0px);
    }

    50% {
        transform: translateX(-15px);
    }

    100% {
        transform: translateX(15px);
    }
}
</style>
