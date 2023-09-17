<template>
    <header class="main-header">
        <div class="logo">Acfusionox</div>
        <nav class="main-nav">
            <a href="/dashboard">Dashboard</a>
            <a href="/settings">Settings</a>
            <!-- More links as needed -->
            <a href="/logout">Logout</a>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'Header',
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
