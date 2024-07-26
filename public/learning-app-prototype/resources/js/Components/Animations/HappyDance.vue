<script setup>
</script>

<template>
    <div class="figure">
        <svg width="200" height="200" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
            <desc>Eine Figur bestehend aus Beinen drei Kreisen und Kulleraugen bewegt sich fröhlich</desc>
            <circle class="figur1-2" cx="255" cy="238" r="75" fill="#67917B" />
            <circle class="figur1-1" cx="255" cy="117" r="75" fill="#67917B" />
            <circle class="figur1-3" cx="255" cy="359" r="75" fill="#67917B" />
            <circle class="figur1-2" cx="255" cy="231" r="75" fill="#E3A328" />
            <circle class="figur1-1" cx="255" cy="110" r="75" fill="#E3A328" />
            <circle class="figur1-3" cx="255" cy="352" r="75" fill="#E3A328" />
            <circle class="figur1-1" cx="199" cy="85" r="32.5" stroke="#103A51" stroke-width="5" fill="#FCF9E7" />
            <circle class="figur1-1" cx="311" cy="85" r="32.5" stroke="#103A51" stroke-width="5" fill="#FCF9E7" />
            <path d="M279 406C288.333 415.667 304.7 441.4 295.5 467C298.167 463.333 304.9 458.2 310.5 467"
                stroke="#103A51" stroke-width="5" stroke-linecap="round" />
            <path d="M228.5 406C219.167 415.667 202.8 441.4 212 467C209.333 463.333 202.6 458.2 197 467"
                stroke="#103A51" stroke-width="5" stroke-linecap="round" />
        </svg>
    </div>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';

.figur1-1 {
    animation-delay: 0.4s;
}

.figur1-2 {
    animation-delay: 0.2s;
}

.figur1-1,
.figur1-2,
.figur1-3 {
    animation-name: dance1;
    animation-duration: 0.8s;
    animation-direction: alternate;
    animation-timing-function: ease-in-out;
    animation-iteration-count: 2;
}

@keyframes dance1 {
    0% {
        transform: translateX(0px);
    }

    50% {
        transform: translateX(-25px);
    }

    100% {
        transform: translateX(25px);
    }
}
</style>