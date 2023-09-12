<template>
  <div class="container">
      <div class="welcome-container">
          <div class="brand-logo">
              <img :src="logoPath" alt="Acfusionox Logo">
          </div>

          <h1>Welcome to Acfusionox</h1>
          <p>Your bridge between Google Docs and WordPress. Let's make content management seamless and efficient.</p>

          <div class="feature-list">
              <h2>Features:</h2>
              <ul>
                  <li>Instantly sync Google Docs to WordPress.</li>
                  <li>Automate content updates with ease.</li>
                  <li>Secure connections to both Google and WordPress.</li>
                  <li>Customizable settings to fit your workflow.</li>
              </ul>
          </div>

          <div class="get-started-btn-container">
              <a href="/login" class="get-started-btn">Get Started</a>
          </div>

          <div class="footer">
              Need help? <a href="/support">Contact Support</a>
          </div>
      </div>
  </div>
</template>

<script>
export default {
  data() {
      return {
          logoPath: 'path-to-your-logo.png'
      }
  }
}
</script>

<style scoped>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  font-family: 'Arial', sans-serif;
  background-color: #f7f9fc;
}

.welcome-container {
  background-color: #ffffff;
  border-radius: 15px;
  padding: 40px 60px;
  box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
  text-align: center;
  width: 60%;
  max-width: 600px;
}

.brand-logo img {
  width: 150px;
  margin-bottom: 20px;
}

h1 {
  color: #333;
  font-size: 2.5em;
  margin-bottom: 20px;
}

p, .feature-list h2, .feature-list li {
  color: #666;
  font-size: 1.2em;
  line-height: 1.5;
  margin-bottom: 20px;
}

.feature-list {
  text-align: left;
}

.get-started-btn-container {
  margin-top: 20px;
}

.get-started-btn {
  background-color: #2d87f0;
  color: #ffffff;
  padding: 15px 30px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: bold;
  font-size: 1.2em;
  transition: background-color 0.3s;
}

.get-started-btn:hover {
  background-color: #1f65d4;
}

.footer {
  margin-top: 40px;
  font-size: 0.9em;
}

.footer a {
  color: #2d87f0;
  text-decoration: none;
}

.footer a:hover {
  text-decoration: underline;
}
</style>
