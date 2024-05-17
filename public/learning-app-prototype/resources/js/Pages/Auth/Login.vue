<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout class="layout-center">
        <Head title="Log in" />
        <h1>Einloggen</h1>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div class="form-container">
            <form @submit.prevent="submit">
                <div class="input-container">
                    <InputLabel for="email" value="Email:" />

                    <TextInput
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                    />

                    <InputError class="error-msg" :message="form.errors.email" />
                </div>

                <div class="input-container">
                    <InputLabel for="password" value="Passwort:" />

                    <TextInput
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                    />

                    <InputError class="error-msg" :message="form.errors.password" />
                </div>

                <div>
                    <label class="remember-container">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="remember-check">Angemeldet bleiben</span>
                    </label>
                </div>

                <div class="submit">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="btn-text link"
                    >
                        Passwort vergessen?
                    </Link>

                    <PrimaryButton :disabled="form.processing">
                        Log in
                    </PrimaryButton>

                    <Link class="btn btn-green" :href="route('register')">
                        Neues Konto erstellen
                    </Link>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';
</style>