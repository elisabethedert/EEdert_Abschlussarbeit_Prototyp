<script setup>
</script>

<template>
    <div class="figure">
        <svg width="250" height="250" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
            <desc>Eine Figur bestehend aus Beinen zwei Kreisen und Kulleraugen bewegt sich traurig</desc>
            <circle class="head" cx="318" cy="208" r="75" fill="#E3A328" />
            <circle class="body" cx="202" cy="265" r="111" fill="#E3A328" />
            <circle class="eyes" cx="374" cy="183" r="32.5" stroke="black" stroke-width="5" fill="#FCF9E7" />
            <circle class="eyes" cx="262" cy="183" r="32.5" stroke="black" stroke-width="5" fill="#FCF9E7" />
            <path d="M227 351C236.333 360.667 252.7 386.4 243.5 412C246.167 408.333 252.9 403.2 258.5 412"
                stroke="black" stroke-width="5" stroke-linecap="round" />
            <path d="M176.5 351C167.167 360.667 150.8 386.4 160 412C157.333 408.333 150.6 403.2 145 412" stroke="black"
                stroke-width="5" stroke-linecap="round" />
        </svg>
    </div>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';

.head {
    animation-duration: 1s;
    animation-direction: alternate;
    animation-timing-function: ease-in-out;
    animation-iteration-count: 1;
    animation-fill-mode: forwards;
    animation-name: downhead;
}

.body {
    animation-duration: 1s;
    animation-direction: alternate;
    animation-timing-function: ease-in-out;
    animation-iteration-count: 1;
    animation-fill-mode: forwards;
    animation-name: downbody;
}

.eyes {
    animation-duration: 1.2s;
    animation-direction: alternate;
    animation-timing-function: ease-in-out;
    animation-iteration-count: 1;
    animation-fill-mode: forwards;
    animation-name: downeyes;
}

@keyframes downeyes {
    0% {
        transform: translateY(0px);
    }

    100% {
        transform: translateY(45px);
    }
}

@keyframes downbody {
    0% {
        transform: translateY(0px);
    }

    100% {
        transform: translateY(15px);
    }
}


@keyframes downhead {
    0% {
        transform: translateY(0px);
    }

    100% {
        transform: translateY(35px);
    }
}
</style>
