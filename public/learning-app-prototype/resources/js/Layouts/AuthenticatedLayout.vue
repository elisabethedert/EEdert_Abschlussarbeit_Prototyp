<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showMenu = ref(true);
const showProfile = ref(false);

const toggleNav = () => {
    if (showMenu.value) {
        showMenu.value = false;
    } else {
        showMenu.value = true;
    }
    console.log(showMenu.value)
};

const toggleProfile = () => {
    if (showProfile.value) {
        showProfile.value = false;
    } else {
        showProfile.value = true;
    }
    console.log(showProfile.value)
};

</script>

<template>
    <div>
        <div class="authenticated-layout">
            <nav class="nav-wrapper">
                <div class="wrapper">
                    <div class="topnav" :class="{ responsive: showMenu }">
                        <div class="logo">
                            <Link :href="route('dashboard')">
                            <ApplicationLogo class="logo-icon" />
                            </Link>
                        </div>
                        <div class="menu">
                            <NavLink class="item" :href="route('dashboard')" :active="route().current('dashboard')">
                                Dashboard
                            </NavLink>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn btn-text" @click="toggleProfile">{{ $page.props.auth.user.name }} <svg
                                viewBox="0 0 34 20" fill="green" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M29.2353 1.33461L23.233 8.4138L20.3868 11.7619L18.8088 13.6275C18.5983 13.8714 18.3852 14.1249 18.1747 14.3688C18.0385 14.529 17.9022 14.6892 17.7563 14.8469C17.5562 15.0521 17.6394 15.0123 18.0183 14.7203L19.3246 14.718C18.7735 14.5705 18.0562 13.7676 17.6201 13.4231C16.954 12.8928 16.2905 12.3529 15.6296 11.8033C14.3176 10.7066 13.0326 9.58621 11.765 8.43938C9.22997 6.14573 6.79625 3.74462 4.45871 1.25538C2.24996 -1.09586 -1.30567 2.42471 0.90308 4.77595C3.34559 7.37611 5.89653 9.88107 8.55142 12.2689C9.87887 13.4628 11.236 14.6233 12.608 15.767C13.98 16.9108 15.4155 18.32 16.9697 19.1708C18.7932 20.1766 20.4609 19.3289 21.6793 17.9158C22.8977 16.5027 24.2085 14.9383 25.4695 13.4435C27.8921 10.5928 30.3173 7.73238 32.7399 4.88166C33.6167 3.85335 33.7681 2.36166 32.7557 1.34526C31.8677 0.444952 30.0954 0.291457 29.216 1.32943L29.2353 1.33461Z" />
                            </svg>
                        </button>
                        <div class="dropdown-content" v-if="showProfile">
                            <DropdownLink class="profile" :href="route('profile.edit')"> Profile </DropdownLink>
                            <DropdownLink class="logout btn btn-danger" :href="route('logout')" method="post" as="button">
                                Log Out
                            </DropdownLink>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="toggle-icon">
                <button @click="toggleNav">
                    toggle
                </button>
            </div>

            <!-- Page Content -->
            <main class="main">
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.main {
    margin-top: 4rem;

    @include breakpoint("mobile") {
        margin-top: 0rem;
    }
}

.authenticated-layout {
    min-height: 100vh;
    background-color: $background;
    
    .nav-wrapper {
        background-color: $background;
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;

        @include breakpoint("mobile") {
            position: relative;
        }

        .wrapper {
            display: flex;
            justify-content: space-between;
            padding-top: 1rem;
            text-align: center;
            align-items: center;
            position: relative;

            .logo svg {
                padding: 1rem 0rem 1rem 2rem;

                @include breakpoint("mobile") {
                    padding: 1rem;

                }
            }
        }
    }

    .toggle-icon {
        display: none;

        @include breakpoint("mobile") {
            display: block;
            position: absolute;
            right: 0;
            top: 0;
            padding: 1rem;
            z-index: 40;
        }

        &:hover {
            cursor: pointer;
        }
    }

    .topnav {
        margin-top: 0;
        margin-right: 0;
        display: flex;
        align-items: center;

        @include breakpoint("mobile") {
            display: none;
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            margin-top: 4.5rem;
        }

        .menu {
            display: flex;
            justify-content: space-between;
            align-items: center;

            .item {
                padding: 1rem;

                @include breakpoint("mobile") {
                    padding: 0.25rem;
                }
            }

            @include breakpoint("mobile") {
                flex-direction: column;
                padding: 0rem;
                width: 100%;
            }

            .active {
                text-decoration: underline;
            }
        }
    }

    .dropdown {
        position: relative;
        align-items: left;

        .dropbtn {
            color: $blue;
            padding: 1rem 1.5rem;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;

            svg {
                margin-left: 0.5rem;
                fill: currentColor;
                height: 15px;
                width: auto;
            }
        }

        .dropdown-content {
            position: absolute;

            .profile {
                color: $blue;
                font-weight: bold;
                text-decoration: none
            }
        }
    }

    @include breakpoint("mobile") {
        .responsive {
            display: block;
        }
    }
}
</style>