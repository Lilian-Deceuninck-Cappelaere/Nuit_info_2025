  <footer class="app-footer">
      <div class="footer-content">
          <div class="footer-text">
              developper par ZeroCodage_FullPromptage
          </div>
          <div class="footer-logos">
              <a href="https://www.iut-littoral.fr/"><img src="assets/images/iutlittoral-logo.jpg" alt="Info Calais" class="logo-info"></a>
              <a href="https://www.jrcan.dev/"><img src="assets/images/logo_JrCanDev.png" alt="JrCanDev" class="logo-jrcandev"></a>

          </div>
      </div>
  </footer>


  <!-- Bouton flottant -->
  <button id="chatbotToggle" class="Forum" aria-label="Discuter avec l'IA" style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; font-size: 24px;">
      💬
  </button>

  <!-- Mini chatbot -->
  <div id="chatbotWidget" style="
    position: fixed;
    bottom: 70px;
    right: 20px;
    width: 350px;
    height: 450px;
    background-color: #2d2d2d;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.5);
    display: none; /* caché par défaut */
    flex-direction: column;
    overflow: hidden;
    z-index: 999;
">
      <iframe src="inc/chatbot.php" style="width:100%; height:100%; border:none; border-radius:15px;"></iframe>
  </div>

  <script>
      const toggleBtn = document.getElementById('chatbotToggle');
      const chatbot = document.getElementById('chatbotWidget');

      toggleBtn.addEventListener('click', () => {
          // toggle affichage
          if (chatbot.style.display === 'none' || chatbot.style.display === '') {
              chatbot.style.display = 'flex';
          } else {
              chatbot.style.display = 'none';
          }
      });
  </script>

  </div>

  </body>

  </html>