<template>
     <div>
        <header>
            <!-- Other header content -->
            <button @click="logout">Logout</button>
        </header>

        <!-- Main content and other components -->
    </div>
    <div class="dashboard-container">
        <div class="header">
            <h1>Welcome to Acfusionox, {{ user.name }}!</h1>
            <p>Manage your Google Docs and WordPress content here.</p>
        </div>

        <div v-if="!user.google_id">
            <GoogleDocsSignup />
        </div>

        <div v-else>
            <div class="sync-section">
                <button @click="syncDocs">Sync Google Docs</button>
                <p>Last synced: {{ user.lastSynced }}</p>
            </div>

            <div class="docs-list">
                <!-- Display a list of Google Docs here -->
            </div>

            <div class="settings-section">
                <!-- Settings and other configurations -->
            </div>
        </div>

        <div class="footer">
            <a href="/support">Contact Support</a>
        </div>
    </div>
</template>

<script>
import GoogleDocsSignup from './GoogleDocsSignup.vue';
import { Inertia } from '@inertiajs/inertia';
export default {
    components: {
        GoogleDocsSignup
    },
    props: ['user'],
    methods: {
        syncDocs() {
            // Logic to initiate syncing of Google Docs with WordPress.
        },
        logout() {
            Inertia.post('/logout');
        }
    }
}
</script>

<style scoped>
/* Styling for the dashboard can be added here */
</style>
