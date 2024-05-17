<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <GuestLayout class="layout-center">
        <Head title="Email Verification" />
        <div class="form-container">
            <p class="info-text">
                Thanks for signing up! Before getting started, could you verify your email address by clicking on the link
                we just emailed to you? If you didn't receive the email, we will gladly send you another.
            </p>

            <div class="info-text" v-if="verificationLinkSent">
                A new verification link has been sent to the email address you provided during registration.
            </div>

            <form @submit.prevent="submit">
                <div class="input-container">
                    <PrimaryButton :disabled="form.processing">
                        Erneut senden
                    </PrimaryButton>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="btn btn-green"
                        >Log Out</Link
                    >
                </div>
            </form>
        </div>
    </GuestLayout>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';
</style>