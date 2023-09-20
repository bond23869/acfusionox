<template>
  <div class="dashboard">
    <HeaderComponent />
    <div class="container mx-auto pt-12 pb-12">
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

      <div class="sm:grid sm:grid-cols-2">
        <div class="mx-auto max-w-7xl py-12 sm:px-6 lg:px-8 border">
          <h2>Your Google Docs</h2>
          <ul v-if="googleDocsFetched">
            <li v-for="doc in googleDocs" :key="doc.id">{{ doc.title }}</li>
          </ul>
        </div>
        <div class="mx-auto max-w-7xl py-12 sm:px-6 lg:px-8 border">
          <h2>Your Websites</h2>
          <ul>
            <li v-for="website in websites" :key="website.id">
              <a :href="website.url" target="_blank">{{ website.name }}</a>
            </li>
          </ul>
        </div>
      </div>

    </div>


    <!-- Google Docs Display -->

    <!-- Websites Display -->

    <div class="actions-section">
      <button @click="testGoogleDriveConnection" class="action-button">Test Google Drive Connection</button>
      <button @click="fetchGoogleDocs" class="action-button">Fetch Google Docs</button>
      <!-- Add more buttons as needed -->
    </div>
  </div>
</template>
  
<script>
import HeaderComponent from '../Layouts/Header.vue';

export default {
  components: {
    HeaderComponent,
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
  props: {
    user: Object,
  },
  methods: {
    testGoogleDriveConnection() {
      // Logic to test connection with Google Drive
      // This could be a simple request to check if the user's token is valid
    },
    async fetchGoogleDocs() {
      try {
        let response = await axios.post('/api/fetch-google-docs');
        if (response.data.success) {
          // handle the returned docs, maybe set them to a data property or trigger a notification
        } else {
          // handle the error, maybe display a message to the user
        }
      } catch (error) {
        console.error("There was an error fetching the documents:", error);
      }
    }
  }
}
</script>
  
<style scoped>
/* Basic styling for dashboard content and buttons */
.dashboard-content {
  padding: 2em;
}

.actions-section {
  margin-top: 20px;
}

.action-button {
  margin-right: 10px;
  padding: 10px 20px;
  background-color: #2d87f0;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.action-button:hover {
  background-color: #1f65d4;
}
</style>
  