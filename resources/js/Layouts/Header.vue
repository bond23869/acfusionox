<template>
    <header class="main-header">
        <div class="logo">Acfusionox</div>
        <nav class="main-nav">
            <InertiaLink href="/dashboard">Dashboard</InertiaLink>
            <InertiaLink href="/settings">Settings</InertiaLink>
            <!-- More links as needed -->
            <InertiaLink href="/logout" method="post">Logout</InertiaLink>
        </nav>
    </header>
</template>

<script>
import { InertiaLink } from '@inertiajs/inertia-vue3';
export default {
    name: 'Header',
    components: {
        InertiaLink
    },
    // ... any logic specific to header
}
</script>

<style scoped>
/* Some basic styles for the header */
.main-header {
    display: flex;
    justify-content: space-between;
    padding: 1em 2em;
    background-color: #2d87f0;
    color: white;
}

.main-nav a {
    margin-left: 20px;
    color: white;
    text-decoration: none;
}
</style>
