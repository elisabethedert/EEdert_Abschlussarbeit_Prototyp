<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Footer from '@/Layouts/Footer.vue';
import { Head, Link } from '@inertiajs/vue3';
import { onMounted, onUnmounted } from 'vue';
import Fig3 from '@/Assets/Fig3.vue';
import Circle from '@/Components/Circle.vue';
import Blink from '@/Assets/Blink.vue';

const props = defineProps({
    streak: Number,
    lectureCount: Number,
    currentLecture: Number
})

/**
 * handles speed of scrolling 
 * @param event 
 */
const handleScroll = (event) => {
    const delta = Math.max(-1, Math.min(1, (event.wheelDelta || -event.detail)));
    const scrolling = event.target.closest('.units');
    scrolling.scrollLeft += delta * -60;
    event.preventDefault();
};

/**
 * adds horizontal scrolling
 */
onMounted(() => {
    const scrollContainer = document.querySelector('.units');
    if (scrollContainer === null) {
        return;
    }
    scrollContainer.addEventListener('mousewheel', handleScroll);
    scrollContainer.addEventListener('DOMMouseScroll', handleScroll);

    // progressbar
    var count = props.currentLecture;
    var maxCount = props.lectureCount;
    count = count === maxCount ? maxCount : count + 1;
    progressbar(count, maxCount);
});

/**
 * removes horizontal scrolling
 */
onUnmounted(() => {
    const scrollContainer = document.querySelector('.units');
    if (scrollContainer === null) {
        return;
    }
    scrollContainer.removeEventListener('mousewheel', handleScroll);
    scrollContainer.removeEventListener('DOMMouseScroll', handleScroll);
});

/**
 * progressbar 
 * @param {number} count current question
 * @param {number} maxCount number of ll questions
 */
function progressbar(count, maxCount) {
    var newWidth = (count / maxCount) * 100 + "%";
    document.getElementsByClassName("progress-bar")[0].style.width = newWidth;
}
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="intro-text">
            <h1>Hey {{ $page.props.auth.user.name }},</h1>
            <h2>Schön dich zu sehen!</h2>
        </div>

        <div class="player-info">
            <Circle :width="100" bgColor="67917B">
                <h3> {{ $page.props.auth.user.experience_points }}</h3>
                <p>Punkte</p>
            </Circle>

            <Fig3 :width="75" />

            <Circle :width="100" bgColor="67917B">
                <h3>{{ streak }}</h3>
                <p>Streak</p>
            </Circle>
        </div>
        <div class="intro-text">
            <p><b>Hinter jeder Unit verbirgt sich ein neuer Schwerpunkt, den du vertiefen kannst.</b></p>
        </div>
        <div class="container">
            <!-- al units in scrollcontainer -->
            <div class="units">
                <Circle :width="250" bgColor="67917B">
                    <h3>Grundlagen</h3>
                    <p>{{ currentLecture }} / {{ lectureCount }}</p>
                    <div class="progress dark">
                        <div class="progress-bar">
                            <span style="width: 40%;"></span>
                        </div>
                    </div>
                    <Link href="unit1/lektionen" type="button" class="btn btn-yellow">Unit 1
                    </Link>
                </Circle>
                <Circle :width="250" bgColor="103A51">
                    <h3>Design Principles</h3>
                    <p> 0 / 10 </p>
                    <div class="progress dark">
                        <div class="progress-bar">
                            <span style="width: 40%;"></span>
                        </div>
                    </div>
                    <Link type="button" class="btn btn-yellow">Unit 2
                    </Link>
                </Circle>
                <Circle :width="250" bgColor="FBF4CE">
                    <h3>Design Fokus Areas</h3>
                    <p> 0 / 12 </p>
                    <div class="progress light">
                        <div class="progress-bar">
                            <span style="width: 40%;"></span>
                        </div>
                    </div>
                    <Link type="button" class="btn btn-yellow">Unit 3
                    </Link>
                </Circle>
                <Circle :width="250" bgColor="67917B">
                    <h3>Zugriffskontrolle</h3>
                    <p> 0 / 10 </p>
                    <div class="progress dark">
                        <div class="progress-bar">
                            <span style="width: 40%;"></span>
                        </div>
                    </div>
                    <Link type="button" class="btn btn-yellow">
                    Unit 4
                    </Link>
                </Circle>
                <Circle :width="250" bgColor="103A51">
                    <h3>Injection</h3>
                    <p> 0 / 10 </p>
                    <div class="progress dark">
                        <div class="progress-bar">
                            <span style="width: 40%;"></span>
                        </div>
                    </div>
                    <Link type="button" class="btn btn-yellow">Unit 5
                    </Link>
                </Circle>
            </div>
            <Blink class="blink" :width="50" />
        </div>
    </AuthenticatedLayout>
    <Footer class="footer">
        <p>AGB</p>
        <p>Datenschutz</p>
    </Footer>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.intro-text {
    text-align: center;
    margin-top: 2rem;
}

.container {
    display: flex;

    .units {
        overflow: auto;
        display: flex;
        flex-direction: row;
        background-color: $background-light;
        border-radius: 25px;
        margin: 2rem;

        h3 {
            margin-bottom: 0.25rem;
        }

        :nth-child(3n+1),
        :nth-child(3n+2) {

            h3,
            p {
                color: $white;
            }
        }

        :nth-child(3n) {

            h3,
            p {
                color: $blue;
            }
        }

        .progress {
            width: 150px;
            height: 20px;
            align-items: first baseline;
            display: flex;
            border-radius: 50px;

            &-bar {
                border-radius: 50px;
                width: 11%;
                height: 15px;
                background-color: $yellow;
                color: #ffffff;
                display: flex;
                align-items: center;

                span {
                    text-align: center;
                    margin-left: 10px;
                }
            }

            &.dark {
                background-color: $background-light;
            }

            &.light {
                background-color: $blue;
            }
        }

        .figure {
            width: 55px;
        }

        .content {

            .btn {
                margin-top: 1rem;
            }
        }
    }

    .blink {
        margin-left: -30px;

        @include breakpoint('mobile') {
            width: 30%;
        }
    }
}

.player-info {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-block: 2rem;
    gap: 2rem;

    @include breakpoint('mobile') {
        gap: 0;
    }

    h3 {
        color: $white;
        font-size: 1.5rem;

    }

    p {
        color: $white;
        font-size: larger;
    }

}

.footer {
    padding-top: 4rem;

    p {
        padding: 0.25rem;
        color: white;
    }
}
</style>
