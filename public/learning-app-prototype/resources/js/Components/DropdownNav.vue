<script setup>
import DropdownLink from '@/Components/DropdownLink.vue';
import { ref } from 'vue';

const showProfile = ref(false);

const toggleProfile = () => {
    if (showProfile.value) {
        showProfile.value = false;
    } else {
        showProfile.value = true;
    }
    console.log(props.auth.user.name)
};
</script>

<template>
    <div class="dropdown">
        <button class="drop-name btn-text" @click="toggleProfile">{{ $page.props.auth.user.name }}
            <svg viewBox="0 0 34 20" fill="green" xmlns="http://www.w3.org/2000/svg">
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
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

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

        @include breakpoint("mobile") {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            left: 1.5rem;
        }

        p {
            cursor: default;
            margin-bottom: 1.5rem;
        }

        .logout {
            color: $danger-red;
            background: none;
            font-size: 1rem;

            @include breakpoint("mobile") {
                padding-left: 0;
            }
        }

        .profile {
            text-align: center;
            color: $blue;
            font-weight: bold;
            text-decoration: none;
            background: none;

            @include breakpoint("mobile") {
                text-align: left;
            }
            
            &:hover {
                text-decoration: underline;
            }
        }
    }
}
</style>