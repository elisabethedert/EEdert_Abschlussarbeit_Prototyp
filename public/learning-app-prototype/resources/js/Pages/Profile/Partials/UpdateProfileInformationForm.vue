<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <section>
        <div class="form-container auth">
            <h2>Profil Information</h2>

            <p class="description">
                Aktualisieree die Profilinformationen und die E-Mail-Adresse deines Kontos.
            </p>
        <form @submit.prevent="form.patch(route('profile.update'))">
            <div class="input-container">
                <InputLabel for="name" value="Name:" />

                <TextInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="error-msg" :message="form.errors.name" />
            </div>

            <div class="input-container">
                <InputLabel for="email" value="Email:" />

                <TextInput
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="error-msg" :message="form.errors.email" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="description-big">
                    Deine E-Mail-Adresse ist nicht verifiziert.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="btn-text"
                    >
                    Klicke hier, um die Bestätigungs-E-Mail erneut zu senden.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                > 
                    <p class="description-big">
                        Es wurde ein neuer Verifizierungslink an deine E-Mail-Adresse gesendet.
                    </p>
                </div>
            </div>

            <div>
                <p v-if="form.recentlySuccessful" class="description-big">Erfolgreich gespeichert</p>
                <PrimaryButton :disabled="form.processing">Speichern</PrimaryButton>
            </div>
        </form>
    </div>
    </section>
</template>

<style scoped lang="scss">
@import '../../../../css/_main.scss';
</style>
