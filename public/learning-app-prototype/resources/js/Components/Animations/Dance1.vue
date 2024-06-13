<script setup>
var count = 0;
var maxCount = 10;

window.addEventListener("keypress", function (e) {
    if (e.key === "Enter") {
        count = count === maxCount ? maxCount : count + 1;
        var newWidth = (count / maxCount) * 100 + "%";
        console.log(newWidth)
        document.getElementById("progressbar").style.width = newWidth;
        document.getElementById("progressbar").innerHTML = count + "/" + maxCount
    }
    if ((e.key === "z") && (count > 0)) {
        console.log("back")
        count = count - 1;
        var newWidth = (count / maxCount) * 100 + "%";
        document.getElementById("progressbar").style.width = newWidth;
        document.getElementById("progressbar").innerHTML = count + "/" + maxCount
    }
});
</script>

<template>
    <h1>SVG Animation</h1>
    <div>
        <h2>
            Figur1
        </h2>
        <div>
            <svg width="500" height="500" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="500" height="500" fill="white" />
                <circle class="figur1-2" cx="255" cy="231" r="75" fill="#E3A328" />
                <circle class="figur1-1" cx="255" cy="110" r="75" fill="#E3A328" />
                <circle class="figur1-3" cx="255" cy="352" r="75" fill="#E3A328" />
                <circle class="figur1-1" cx="199" cy="85" r="32.5" stroke="black" stroke-width="5" />
                <circle class="figur1-1" cx="311" cy="85" r="32.5" stroke="black" stroke-width="5" />
                <path d="M279 406C288.333 415.667 304.7 441.4 295.5 467C298.167 463.333 304.9 458.2 310.5 467"
                    stroke="black" stroke-width="5" stroke-linecap="round" />
                <path d="M228.5 406C219.167 415.667 202.8 441.4 212 467C209.333 463.333 202.6 458.2 197 467" stroke="black"
                    stroke-width="5" stroke-linecap="round" />
            </svg>
        </div>
    </div>
    <div>
        <h2>Figur2</h2>
        <div>
            <svg width="500" height="500" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="500" height="500" fill="white" />
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
    <div>
        <h2>Figur3</h2>
        <div>
            <svg width="500" height="500" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="500" height="500" fill="white" />
                <circle class="figur3" cx="248" cy="200" r="75" fill="#E3A328" />
                <circle class="figur3" cx="304" cy="175" r="32.5" stroke="black" stroke-width="5" />
                <circle class="figur3" cx="192" cy="175" r="32.5" stroke="black" stroke-width="5" />
                <circle cx="187" cy="308" r="77" fill="#E3A328" />
                <circle cx="309" cy="308" r="77" fill="#E3A328" />
                <path d="M275 352C284.333 361.667 300.7 387.4 291.5 413C294.167 409.333 300.9 404.2 306.5 413"
                    stroke="black" stroke-width="5" stroke-linecap="round" />
                <path d="M224.5 352C215.167 361.667 198.8 387.4 208 413C205.333 409.333 198.6 404.2 193 413" stroke="black"
                    stroke-width="5" stroke-linecap="round" />
            </svg>
        </div>
    </div>
    <div>
        <h2>Figur3 Konfettie</h2>
        <div>
            <svg width="500" height="500" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g class="confettie">
                    <!-- <path class="confettie-long1" d="M150.951 120C144.951 124.333 136.551 136.6 150.951 151"
                        stroke="#CE2121" stroke-width="5" stroke-linecap="round" />
                    <path class="confettie-long2" d="M279.542 230.107C282.808 223.466 284.472 208.692 265 202.73"
                        stroke="#CE2121" stroke-width="5" stroke-linecap="round" />
                    <path class="confettie-long3" d="M370.546 113.153C364.464 117.37 355.829 129.473 369.949 144.147"
                        stroke="#CE2121" stroke-width="5" stroke-linecap="round" />
                    <path class="confettie-long1" d="M337 227.957C344.401 228.027 358.44 223.135 355.389 203"
                        stroke="#4C979C" stroke-width="5" stroke-linecap="round" />
                    <path class="confettie-long2" d="M154 209.957C161.401 210.027 175.44 205.135 172.389 185"
                        stroke="#4C979C" stroke-width="5" stroke-linecap="round" />
                    <path class="confettie-long3" d="M213.642 296C214.746 303.318 221.803 316.404 241.199 310.198"
                        stroke="#FFE600" stroke-width="5" stroke-linecap="round" />
                    <path class="confettie-long1" d="M306.243 151.568C303.333 144.762 293.212 133.872 276 144.757"
                        stroke="#FFE600" stroke-width="5" stroke-linecap="round" /> -->
                    <circle class="confettie-circle1" cx="288" cy="315" r="5" fill="#747DD4" />
                    <circle class="confettie-circle2" cx="226" cy="251" r="5" fill="#747DD4" />
                    <circle class="confettie-circle3" cx="210" cy="160" r="5" fill="#747DD4" />
                    <circle class="confettie-circle1" cx="158.951" cy="86" r="5" fill="#747DD4" />
                    <circle class="confettie-circle2" cx="297" cy="66" r="5" fill="#747DD4" />
                    <circle class="confettie-circle3" cx="403" cy="150" r="5" fill="#747DD4" />
                    <circle class="confettie-circle1" cx="132" cy="310" r="5" fill="#747DD4" />
                    <circle class="confettie-circle2" cx="93" cy="190" r="5" fill="#747DD4" />

                    <path class="draw"
                        d="M432.042 393C432.042 393 452.542 371.7 440.542 336.5C428.542 301.3 421.267 296.1 429.542 263C434.542 243 443.242 215.4 432.042 183C420.842 150.6 443.042 127.5 446.542 105.5C450.042 83.5 442.542 49.6 426.542 40"
                        stroke="#CE2121" stroke-width="5" stroke-linecap="round" />
                    <path class="draw"
                        d="M65.3456 434C65.3456 434 44.8457 412.7 56.8457 377.5C68.8457 342.3 76.1209 337.1 67.8457 304C62.8456 284 54.1456 256.4 65.3456 224C76.5457 191.6 54.3458 168.5 50.8457 146.5C47.3457 124.5 54.8457 90.6 70.8457 81"
                        stroke="#CE2121" stroke-width="5" stroke-linecap="round" />
                    <path class="draw"
                        d="M210.042 413C210.042 413 230.542 391.7 218.542 356.5C206.542 321.3 199.267 316.1 207.542 283C212.542 263 221.242 235.4 210.042 203C198.842 170.6 221.042 147.5 224.542 125.5C228.042 103.5 220.542 69.6 204.542 60"
                        stroke="#CE2121" stroke-width="5" stroke-linecap="round" />
                    <path class="draw-1"
                        d="M153.346 379C153.346 379 132.846 357.7 144.846 322.5C156.846 287.3 164.121 282.1 155.846 249C150.846 229 142.146 201.4 153.346 169C164.546 136.6 142.346 113.5 138.846 91.5C135.346 69.5 142.846 35.6 158.846 26"
                        stroke="#CE2121" stroke-width="5" stroke-linecap="round" />
                    <path class="draw-1"
                        d="M346.346 447C346.346 447 325.846 425.7 337.846 390.5C349.846 355.3 357.121 350.1 348.846 317C343.846 297 335.146 269.4 346.346 237C357.546 204.6 335.346 181.5 331.846 159.5C328.346 137.5 335.846 103.6 351.846 94"
                        stroke="#CE2121" stroke-width="5" stroke-linecap="round" />
                </g>
                <g>
                    <circle class="figur3" cx="248" cy="200" r="75" fill="#E3A328" />
                    <circle class="figur3" cx="304" cy="175" r="32.5" stroke="black" stroke-width="5" />
                    <circle class="figur3" cx="192" cy="175" r="32.5" stroke="black" stroke-width="5" />
                    <circle cx="187" cy="308" r="77" fill="#E3A328" />
                    <circle cx="309" cy="308" r="77" fill="#E3A328" />
                    <path d="M275 352C284.333 361.667 300.7 387.4 291.5 413C294.167 409.333 300.9 404.2 306.5 413"
                        stroke="black" stroke-width="5" stroke-linecap="round" />
                    <path d="M224.5 352C215.167 361.667 198.8 387.4 208 413C205.333 409.333 198.6 404.2 193 413"
                        stroke="black" stroke-width="5" stroke-linecap="round" />
                </g>
            </svg>
        </div>
    </div>
    <div>
        <h2>Ladebalken</h2>
        <div id="myProgress">
            <div id="progressbar">
                <span>
                    0/{{ maxCount }}
                </span>
            </div>
        </div>
    </div>

    <svg viewBox="0 0 1000 1000">
        <circle class="confetti" r="30" cy="-50" cx="900" style="transform-origin: 900px -50px"></circle>
        <circle class="confetti" r="30" cy="-50" cx="800" style="transform-origin: 800px -50px"></circle>
        <circle class="confetti" r="30" cy="-50" cx="700" style="transform-origin: 700px -50px"></circle>
        <circle class="confetti" r="30" cy="-50" cx="600" style="transform-origin: 600px -50px"></circle>
        <circle class="confetti" r="30" cy="-50" cx="500" style="transform-origin: 500px -50px"></circle>
        <circle class="confetti" r="30" cy="-50" cx="400" style="transform-origin: 400px -50px"></circle>
        <circle class="confetti" r="30" cy="-50" cx="300" style="transform-origin: 300px -50px"></circle>
        <circle class="confetti" r="30" cy="-50" cx="200" style="transform-origin: 200px -50px"></circle>
        <circle class="confetti" r="30" cy="-50" cx="100" style="transform-origin: 100px -50px"></circle>
        <circle class="confetti" r="30" cy="-50" cx="0" style="transform-origin: 0px -50px"></circle>
    </svg>
</template>

<style scoped lang="scss">
$turns: 6;
$duration: 6s;
$count: 10;

.confetti {
  animation: move $duration linear infinite, color $duration/$turns linear infinite, opacity $duration linear infinite;
  @for $i from 1 through $count {
    &:nth-child(#{$i}) {
      $hue: 10*$i;
      fill: hsl($hue, 80, 40);
      animation-delay: $i * $duration * random(100) * -0.01;
      --dark: #{hsl($hue, 80, 20)};
      --tilt: random(100)/100
      ;
    }
  }
}

@keyframes move {
  100% {
    transform: translate(100px, 1000px) rotate3D(1, var(--tilt), 0.21, $turns*360deg);
  }
}

@keyframes color {
  50% {
    fill: var(--dark);
  }
}

@keyframes opacity {
  50% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}

/*Page Setup*/

svg {
  width: 100vw;
  height: 80vh;
}

#myProgress {
    width: 450px;
    height: 35px;
    background-color: #0e0a63;
    align-items: first baseline;
    display: flex;
    border-radius: 50px;
}

#progressbar {
    border-radius: 50px;
    width: 0%;
    height: 30px;
    background-color: #5980a7;
    color: #fff;
    display: flex;
    align-items: center;

    span {
        text-align: center;
        margin-left: 10px;
    }
}

.draw {
    stroke-dasharray: 100;
    animation: dashdraw 2s linear infinite;
}

.draw-1 {
    animation-delay: 1s;
    stroke-dasharray: 100;
    animation: dashdraw 2s linear infinite;
}

@keyframes dashdraw {
    to {
        stroke-dashoffset: 200;
    }
}

.figur1-1 {
    animation-delay: 1.4s;
}

.figur1-2 {
    animation-delay: 1.2s;
}

.figur1-3 {
    animation-delay: 1s;
}

.figur1-1,
.figur1-2,
.figur1-3 {
    animation-name: dance1;
    animation-duration: 0.9s;
    animation-direction: alternate;
    animation-timing-function: ease-in-out;
    animation-iteration-count: infinite;
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

.figur3 {
    animation-name: dance3;
    animation-duration: 0.9s;
    animation-direction: alternate;
    animation-timing-function: ease-in-out;
    animation-iteration-count: infinite;
}

@keyframes dance3 {
    0% {
        transform: translateY(0px);
    }

    50% {
        transform: translateY(-10px);
    }

    100% {
        transform: translateY(10px);
    }
}

.confettie {

    .confettie-star1,
    .confettie-star2,
    .confettie-star3 {
        animation-name: star;
        animation-duration: 0.9s;
        animation-direction: alternate;
        animation-timing-function: ease-in-out;
        // animation-iteration-count: infinite;
    }

    .confettie-star2 {
        animation-delay: 0.2s;
    }

    .confettie-star3 {
        animation-delay: 0.4s;
    }

    .confettie-circle1,
    .confettie-circle2,
    .confettie-circle3 {
        animation-name: star;
        animation-duration: 0.9s;
        animation-direction: alternate;
        animation-timing-function: ease-in-out;
        animation-iteration-count: infinite;
    }

    .confettie-circle2 {
        animation-delay: 0.2s;
    }

    .confettie-circle3 {
        animation-delay: 0.4s;
    }

}

@keyframes star {
    0% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}

@keyframes circle {
    0% {
        opacity: 0;
    }

    100% {
        opacity: 1;
    }
}</style>
