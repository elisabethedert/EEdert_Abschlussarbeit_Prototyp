<script setup>
import { ref } from 'vue';
import Footer from '@/Layouts/Footer.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showMenu = ref(false);
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
    <div class="authenticated-layout">
        <header>
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
                            <NavLink class="item">
                                Team
                            </NavLink>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="drop-name btn-text" @click="toggleProfile">{{ $page.props.auth.user.name }} <svg
                                viewBox="0 0 34 20" fill="green" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M29.2353 1.33461L23.233 8.4138L20.3868 11.7619L18.8088 13.6275C18.5983 13.8714 18.3852 14.1249 18.1747 14.3688C18.0385 14.529 17.9022 14.6892 17.7563 14.8469C17.5562 15.0521 17.6394 15.0123 18.0183 14.7203L19.3246 14.718C18.7735 14.5705 18.0562 13.7676 17.6201 13.4231C16.954 12.8928 16.2905 12.3529 15.6296 11.8033C14.3176 10.7066 13.0326 9.58621 11.765 8.43938C9.22997 6.14573 6.79625 3.74462 4.45871 1.25538C2.24996 -1.09586 -1.30567 2.42471 0.90308 4.77595C3.34559 7.37611 5.89653 9.88107 8.55142 12.2689C9.87887 13.4628 11.236 14.6233 12.608 15.767C13.98 16.9108 15.4155 18.32 16.9697 19.1708C18.7932 20.1766 20.4609 19.3289 21.6793 17.9158C22.8977 16.5027 24.2085 14.9383 25.4695 13.4435C27.8921 10.5928 30.3173 7.73238 32.7399 4.88166C33.6167 3.85335 33.7681 2.36166 32.7557 1.34526C31.8677 0.444952 30.0954 0.291457 29.216 1.32943L29.2353 1.33461Z" />
                            </svg>
                        </button>
                        <div class="dropdown-content" v-if="showProfile">
                            <p>{{ $page.props.auth.user.experience_points }} Punkte</p>
                            <DropdownLink class="profile" :href="route('profile.edit')"> Profile </DropdownLink>
                            <DropdownLink class="logout btn" :href="route('logout')" method="post" as="button">
                                Log Out
                            </DropdownLink>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="toggle-icon">
                <button @click="toggleNav">

                    <svg width="30" height="28" viewBox="0 0 42 28" fill="none" xmlns="http://www.w3.org/2000/svg">
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
        </header>
        <!-- Page Content -->
        <main class="main">
            <slot />
        </main>
        <Footer class="footer">
            <p>AGB</p>
            <p>Datenschutz</p>
        </Footer>
    </div>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';
.main {
    margin-top: 3rem;
    padding: 0 2rem;
    
    @include breakpoint("mobile") {
        margin-top: 0rem;
    }
}

.footer {
    padding-top: 4rem;

    p {
        padding: 0.25rem;
        color: white;
    }
}

.authenticated-layout {
    background-color: $background;
    align-items: center;

    @include breakpoint("mobile") {
    }

    .nav-wrapper {
        background-color: $background;
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        padding-top: 1rem;
        z-index: 100;

        @include breakpoint("mobile") {
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
                padding: 1rem 0rem 1rem 2rem;

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
        }

        .menu {
            display: flex;
            justify-content: space-between;
            align-items: center;

            .item {
                padding: 1rem;
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
        margin-right: 2rem;
        position: relative;
        width: 150px;
        display: flex;
        justify-content: flex-end;

        @include breakpoint("mobile") {
            justify-content: flex-start;
        }

        .drop-name {
            color: $blue;
            font-size: 1.25rem;
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

        &-content {
            position: absolute;
            top: 2rem;
            right: 0;

            p {
                cursor: default;
                margin-bottom: 1rem;
            }

            .logout {
                color: $danger-red;
                background: none;
                font-size: 1rem;
            }

            .profile {
                text-align: right;
                color: $blue;
                font-weight: bold;
                text-decoration: none;

                &:hover {
                    text-decoration: underline;

                }

                @include breakpoint("mobile") {
                    text-align: left;
                }
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
}
</style>