<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="authenticated-layout">
            <nav class="nav">
                <!-- Primary Navigation Menu -->
                <div class="nav-primary">
                    <div class="menu-items">
                        <div class="menu-items-flex">
                            <!-- Logo -->
                            <div class="logo">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="logo-icon"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="links">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>
                            </div>
                        </div>
                        <div class="dropdown">
                            <!-- Settings Dropdown -->
                            <div class="dropdown-container">
                                <Dropdown>
                                    <template #trigger>
                                        <!-- <span class="inline-flex rounded-md"> -->
                                        <span class="trigger">
                                            <button
                                                type="button"
                                                class="btn-text"
                                            >
                                                {{ $page.props.auth.user.name }}
                                                <svg viewBox="0 0 34 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M29.2353 1.33461L23.233 8.4138L20.3868 11.7619L18.8088 13.6275C18.5983 13.8714 18.3852 14.1249 18.1747 14.3688C18.0385 14.529 17.9022 14.6892 17.7563 14.8469C17.5562 15.0521 17.6394 15.0123 18.0183 14.7203L19.3246 14.718C18.7735 14.5705 18.0562 13.7676 17.6201 13.4231C16.954 12.8928 16.2905 12.3529 15.6296 11.8033C14.3176 10.7066 13.0326 9.58621 11.765 8.43938C9.22997 6.14573 6.79625 3.74462 4.45871 1.25538C2.24996 -1.09586 -1.30567 2.42471 0.90308 4.77595C3.34559 7.37611 5.89653 9.88107 8.55142 12.2689C9.87887 13.4628 11.236 14.6233 12.608 15.767C13.98 16.9108 15.4155 18.32 16.9697 19.1708C18.7932 20.1766 20.4609 19.3289 21.6793 17.9158C22.8977 16.5027 24.2085 14.9383 25.4695 13.4435C27.8921 10.5928 30.3173 7.73238 32.7399 4.88166C33.6167 3.85335 33.7681 2.36166 32.7557 1.34526C31.8677 0.444952 30.0954 0.291457 29.216 1.32943L29.2353 1.33461Z"/>
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <!-- <div class="-me-2 flex items-center sm:hidden"> -->
                        <div class="hamburger">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="btn-text"
                            >
                                <svg stroke="currentColor" fill="none" viewBox="0 0 40 30">
                                    <g
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                        }">
                                        <path d="M3.99703 6.00436C12.237 5.92436 20.477 5.58436 28.697 5.01436C30.047 4.92436 31.197 3.93436 31.197 2.51436C31.197 1.23436 30.057 -0.0856432 28.697 0.00435685C20.477 0.584357 12.237 0.924357 3.99703 1.00436C0.777031 1.03436 0.777031 6.03436 3.99703 6.00436Z" fill="#103A51"/>
                                        <path d="M2.40751 16.5445C14.7675 15.8445 27.1275 15.1545 39.4875 14.4545C42.6875 14.2745 42.7075 9.27445 39.4875 9.45445C27.1275 10.1545 14.7675 10.8445 2.40751 11.5445C-0.792494 11.7245 -0.812494 16.7245 2.40751 16.5445Z" fill="#103A51"/>
                                        <path d="M8.28711 27.2245C16.8071 26.5045 25.3371 25.9745 33.8771 25.6545C37.0871 25.5345 37.0971 20.5345 33.8771 20.6545C25.3371 20.9845 16.8071 21.5045 8.28711 22.2245C6.93711 22.3345 5.78711 23.2945 5.78711 24.7245C5.78711 25.9845 6.93711 27.3345 8.28711 27.2245Z" fill="#103A51"/>
                                    </g>
                                    <g
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                        }">
                                    <path d="M5.06028 23.7422C16.2712 18.4911 27.4859 13.2493 38.6969 7.99813C41.5998 6.63976 39.757 1.99172 36.8354 3.35754C25.6245 8.60866 14.4098 13.8505 3.19886 19.1016C0.295893 20.46 2.13875 25.108 5.06028 23.7422Z" fill="#103A51"/>
                                    <path d="M38.7769 19.7502C27.7228 14.1764 16.6737 8.59394 5.61964 3.02015C2.75836 1.57604 0.24104 5.89616 3.11964 7.35028C14.1737 12.9241 25.2228 18.5065 36.2769 24.0803C39.1381 25.5244 41.6555 21.2043 38.7769 19.7502Z" fill="#103A51"/>

                                </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden menu-items-responsive"
                >
                <!-- <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="menu-items-responsive"
                > -->
                    <div class="links">

                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="settings">
                        <div class="userinfo">
                            <div>
                                <span>
                                    {{ $page.props.auth.user.name }}
                                </span>
                            </div>
                            <div class="email">
                                <span>
                                    {{ $page.props.auth.user.email }}
                                </span>
                            </div>
                        </div>

                        <div class="links">
                            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                Dashboard
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('profile.edit')" :active="route().current('profile.edit')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="logout btn-text">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="header" v-if="$slots.header">
                <div >
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.authenticated-layout {
    min-height: 100vh;
    background-color: $background-light;

    .nav {
        background-color: $background-light;

        &-primary {
            max-width: 80rem;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem; 
            padding-right: 1rem; 
        
            .menu-items {
                display: flex;
                justify-content: space-between;
                padding: 3rem 0rem;

                &-flex {
                    display: flex;

                    .logo {
                        flex-shrink: 0;
                        display: flex;
                        align-items: center;
                        padding: 0 1rem;

                        &-icon {
                            display: block;
                            height: 2.5rem;
                            width: auto;
                            fill: currentColor;
                        }
                    }

                    .links {
                        margin-left: 2rem;
                        display: flex;
                        
                        @include breakpoint("mobile") {
                            margin-top: 1px;
                            margin-bottom: 1px;
                            margin-inline-start: 2.5rem;
                            display: none;
                        }
                    }
                }
            }
            .dropdown {
                @include breakpoint("mobile") {
                    display: none;
                    align-items: center;
                    margin-inline-start: 1.5rem;
                }

                &-container {
                    position: relative;
                    margin-inline-start: 0.75rem;   

                    .trigger {
                        display: inline-flex;
                        border-radius: 25px;

                        button {
                            display: inline-flex;
                            align-items: center;

                            svg {
                                margin-left: 0.5rem;
                                fill: currentColor;
                                height: 15px;
                                width: auto;
                            }
                        }
                    }
                }
            }
            .hamburger {
                display: none;

                @include breakpoint("mobile") {
                    display: flex;
                    align-items: center;
                    margin-inline-end: 0.75rem; 
                }

                svg {
                    fill: currentColor;
                    height: 25px;
                    width: auto;
                }
            }
        }
        .menu-items-responsive {
            .links {
                margin-top: 0.25rem;
                padding-top: 10px;
                padding-bottom: 10px;

                .logout {
                    color: $danger-red!important;
                    margin-top: 2rem;
                }
            }
            .settings {
                padding-top: 1rem;
                .userinfo {
                    padding-left: 1rem;

                    .email {
                        font-size: 0.825rem;
                        color: $green;
                    }
                }
            }
        }
    }
    .header {
        max-width: 80rem;
        margin-left: auto;
        margin-right: auto;
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

</style>