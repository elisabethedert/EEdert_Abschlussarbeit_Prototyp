<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <h1>Profil</h1>
            <div class="input">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                    />
                    <UpdatePasswordForm/>
                    <DeleteUserForm/>
            </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';

.input {
    margin-left: auto;
    margin-right: auto;
    --space-y-reverse: 0;
    margin-top: calc(1.5rem * calc(1 - var(--space-y-reverse)));
    margin-bottom: calc(1.5rem * var(--space-y-reverse));
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}
</style>

