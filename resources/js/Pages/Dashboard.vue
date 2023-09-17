<template>

    <HeaderComponent />
    <div class="dashboard">
  
      <h1>Welcome, {{ username }}</h1>
  
      <!-- Google Connection Status -->
      <div v-if="isConnectedToGoogle">
        <p>Status: Connected to Google</p>
        <button @click="fetchGoogleDocs">Fetch Google Docs</button>
      </div>
      <div v-else>
        <p>Status: Not connected to Google</p>
        <!-- Add connection button or link to connect to Google -->
      </div>
  
      <!-- Google Docs Display -->
      <div v-if="googleDocsFetched">
        <h2>Your Google Docs</h2>
        <ul>
          <li v-for="doc in googleDocs" :key="doc.id">{{ doc.title }}</li>
        </ul>
      </div>
  
      <!-- Websites Display -->
      <h2>Your Websites</h2>
      <ul>
        <li v-for="website in websites" :key="website.id">
          <a :href="website.url" target="_blank">{{ website.name }}</a>
        </li>
      </ul>
  
    </div>
  </template>
  
  <script>
  export default {
    components: {
      HeaderComponent: () => import('../Components/Header.vue')
    },
    data() {
      return {
        username: "User", // Placeholder. Fetch actual username from the user's session or API.
        isConnectedToGoogle: false, // Placeholder. Determine actual connection status.
        googleDocsFetched: false, 
        googleDocs: [],
        websites: [ // Placeholder data
          { id: 1, name: 'My Portfolio', url: 'https://portfolio.com' },
          { id: 2, name: 'My Blog', url: 'https://blog.com' }
        ]
      };
    },
    methods: {
      fetchGoogleDocs() {
        // Here, you'd typically make an API call to fetch the user's Google Docs
        // Simulating with dummy data:
        setTimeout(() => {
          this.googleDocs = [
            { id: 1, title: 'Document 1' },
            { id: 2, title: 'Document 2' }
            // Add more dummy docs as needed
          ];
          this.googleDocsFetched = true;
        }, 2000);
      }
    }
  }
  </script>
  
  <style scoped>
  .dashboard {
    padding: 20px;
  }
  </style>
  