<script setup>

defineProps({
    showXp: Boolean,
    xp: Number
})
</script>

<template>
    <div class="animation">
        <div class="result">
            <div class="xp" v-if="showXp">
                <svg width="60" height="60" viewBox="0 0 172 181" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <desc>Ein Geldstück mit der entsprechenden Zahl an Experience Points die man sich erspielt hat</desc>
                    <circle cx="102.501" cy="116.15" r="64.4146" fill="#67917B" />
                    <circle cx="102.501" cy="110.5" r="64.4146" fill="#E3A328" />
                    <path
                        d="M97.1262 57.539C98.8176 52.3332 106.182 52.3332 107.874 57.539L116.835 85.119C117.592 87.4471 119.761 89.0233 122.209 89.0233L151.208 89.0233C156.682 89.0233 158.958 96.0276 154.529 99.245L131.069 116.29C129.088 117.729 128.26 120.28 129.016 122.608L137.977 150.188C139.669 155.393 133.71 159.722 129.282 156.505L105.821 139.46C103.841 138.021 101.159 138.021 99.1788 139.46L75.7178 156.505C71.2896 159.722 65.3313 155.393 67.0228 150.188L75.9841 122.608C76.7405 120.28 75.9118 117.729 73.9314 116.29L50.4705 99.245C46.0422 96.0276 48.3181 89.0233 53.7917 89.0233L82.791 89.0233C85.2389 89.0233 87.4084 87.4471 88.1649 85.119L97.1262 57.539Z"
                        fill="#FFD521" />
                    <path d="M2.99971 59.7515C10.3384 59.933 25.8259 60.7792 29.0666 62.7125" stroke="#103A51"
                        stroke-width="5" stroke-linecap="round" class="draw" />
                    <path d="M32.8637 18.5648C37.6592 24.1229 47.4363 36.164 48.1812 39.8633" stroke="#103A51"
                        stroke-width="5" stroke-linecap="round" class="draw" />
                    <path d="M76.0882 3.00002C77.655 10.1718 80.5115 25.4171 79.4033 29.0243" stroke="#103A51"
                        stroke-width="5" stroke-linecap="round" class="draw" />
                    <foreignObject class="xp-input" x="85" y="65" width="160" height="160">
                        <p><b> {{ xp }}</b></p>
                    </foreignObject>
                </svg>
            </div>
            <slot name="result"></slot>
        </div>
        <div class="figure">
            <slot name="figure"></slot>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';

.animation {
    display: flex;
    align-items: center;

    .result {

        border-radius: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;

        .xp-input {
            color: $blue;
            font-size: 4.5rem;
        }

        h3 {
            margin-left: 10px;
            margin-top: 10px;
            font-size: 1.5rem;
            text-align: center;
            color: $blue;
        }
    }
}

.draw {
    stroke-dasharray: 25;
    animation: dashdraw 7s linear infinite;
}

@keyframes dashdraw {
    to {
        stroke-dashoffset: 200;
    }
}
</style>