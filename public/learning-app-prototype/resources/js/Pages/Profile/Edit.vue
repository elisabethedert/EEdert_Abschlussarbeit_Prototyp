<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Footer from '@/Layouts/Footer.vue';
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
    <Footer class="footer">
        <p>AGB</p>
        <p>Datenschutz</p>
    </Footer>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';

.input {
    margin-left: auto;
    margin-right: auto;
    margin-top: 2rem;
    margin-bottom: 2rem;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.footer {
    padding-top: 4rem;

    p {
        padding: 0.25rem;
        color: white;
    }
}
</style>

