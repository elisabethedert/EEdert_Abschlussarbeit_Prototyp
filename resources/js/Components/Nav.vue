<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import DropdownNav from '@/Components/DropdownNav.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const showMenu = ref(false);

/**
 * Toggles the navigation menu on mobile devices
 */
const toggleNav = () => {
    if (showMenu.value) {
        showMenu.value = false;
    } else {
        showMenu.value = true;
    }
    console.log(showMenu.value)
};
</script>

<template>
    <nav class="nav-wrapper">
        <div class="wrapper">
            <div class="topnav" :class="{ responsive: showMenu }">
                <div class="logo">
                    <Link href="/">
                    <ApplicationLogo class="logo-icon" />
                    </Link>
                </div>
                <div class="menu">
                    <NavLink class="item" :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </NavLink>
                    <p class="item">
                        Team
                    </p>
                </div>
            </div>
            <DropdownNav />
        </div>
    </nav>
    <div class="toggle-icon">
        <button @click="toggleNav">
            <svg width="30" height="28" viewBox="0 0 42 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <desc>Burgermenü-Symbol</desc>
                <path
                    d="M3.99703 6.00436C12.237 5.92436 20.477 5.58436 28.697 5.01436C30.047 4.92436 31.197 3.93436 31.197 2.51436C31.197 1.23436 30.057 -0.0856432 28.697 0.00435685C20.477 0.584357 12.237 0.924357 3.99703 1.00436C0.777031 1.03436 0.777031 6.03436 3.99703 6.00436Z"
                    fill="#103A51" />
                <path
                    d="M2.40751 16.5445C14.7675 15.8445 27.1275 15.1545 39.4875 14.4545C42.6875 14.2745 42.7075 9.27445 39.4875 9.45445C27.1275 10.1545 14.7675 10.8445 2.40751 11.5445C-0.792494 11.7245 -0.812494 16.7245 2.40751 16.5445Z"
                    fill="#103A51" />
                <path
                    d="M8.28711 27.2245C16.8071 26.5045 25.3371 25.9745 33.8771 25.6545C37.0871 25.5345 37.0971 20.5345 33.8771 20.6545C25.3371 20.9845 16.8071 21.5045 8.28711 22.2245C6.93711 22.3345 5.78711 23.2945 5.78711 24.7245C5.78711 25.9845 6.93711 27.3345 8.28711 27.2245Z"
                    fill="#103A51" />
            </svg>
        </button>
    </div>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.nav-wrapper {
    background-color: $background;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    padding-top: 1rem;
    z-index: 100;

    @include breakpoint("mobile") {
        padding-top: 2rem;
        position: relative;
    }

    .wrapper {
        margin-inline: 2rem;
        display: flex;
        justify-content: space-between;
        text-align: center;
        align-items: center;
        position: relative;

        .logo svg {
            padding: 1rem 0rem 1rem 0rem;
            width: 55px;

            @include breakpoint("mobile") {
                display: none;
            }
        }
    }
}

.toggle-icon {
    display: none;

    @include breakpoint("mobile") {
        display: block;
        position: absolute;
        right: 2rem;
        top: 0;
        z-index: 40;
        padding: 1rem 0rem 1rem 2rem;

        button {
            border: none;
            background: none;
        }
    }

    &:hover {
        cursor: pointer;
    }
}

.topnav {
    margin-right: 0;
    display: flex;
    align-items: center;
    
    @include breakpoint("mobile") {
        gap: 1rem;
        display: none;
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
    }

    .menu {
        display: flex;
        justify-content: space-between;
        align-items: center;

        @include breakpoint("mobile") {
            flex-direction: column;
            padding: 0rem;
            width: 100%;
        }

        p {
            color: $blue;
            font-size: 1.25rem;
            font-weight: bold;
        }

        .item {
            padding: 1rem;

            @include breakpoint("mobile") {
                padding: 0;
            }
        }

        .active {
            text-decoration: underline;
        }
    }
}

@include breakpoint("mobile") {
    .responsive {
        display: flex;
        width: auto;
        left: 0;
        right: 0;
    }
}
</style>