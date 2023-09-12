<template>
    <div class="google-signup-widget">
      <p>Connect with Google to access your Docs:</p>
      <a :href="googleAuthUrl" class="google-signup-button">Connect to Google Docs</a>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        googleAuthUrl: '/login/google' // This URL should point to your server-side OAuth initiation.
      }
    }
  }
  </script>
  
  <style scoped>
  .google-signup-widget {
    border: 1px solid #ccc;
    padding: 20px;
    text-align: center;
    border-radius: 10px;
  }
  
  .google-signup-button {
    background-color: #4285F4;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
  }
  
  .google-signup-button:hover {
    background-color: #357ABD;
  }
  </style>
  