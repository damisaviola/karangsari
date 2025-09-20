  <footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2023 &copy; Mazer</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                by <a href="https://saugi.me">Saugi</a></p>
        </div>
    </div>
</footer>
        </div>
    </div>
   
    
    <script src="<?= base_url('assets/dist/assets/static/js/components/dark.js') ?>"></script>
    <script src="<?= base_url('assets/dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/assets/compiled/js/app.js') ?>"></script>

   

    
<script>
    document.querySelector('.sidebar-toggle').addEventListener('click', () => {
        document.querySelector('.email-app-sidebar').classList.toggle('show')
    })
    document.querySelector('.sidebar-close-icon').addEventListener('click', () => {
        document.querySelector('.email-app-sidebar').classList.remove('show')
    })
    document.querySelector('.compose-btn').addEventListener('click', () => {
        document.querySelector('.compose-new-mail-sidebar').classList.add('show')
    })
    document.querySelector('.email-compose-new-close-btn').addEventListener('click', () => {
        document.querySelector('.compose-new-mail-sidebar').classList.remove('show')
    })
</script>


<script>
 
    document.querySelectorAll('.user-details').forEach(item => {
        item.addEventListener('click', () => {
            document.getElementById('chatbox-sidebar').classList.add('show');
        });
    });

    document.querySelector('.chat-close-icon').addEventListener('click', () => {
        document.getElementById('chatbox-sidebar').classList.remove('show');
    });
</script>

<script>
    const fileInput = document.getElementById('chatFile');
    const chatBody = document.querySelector('.chatbox-body');

    fileInput.addEventListener('change', (event) => {
        const files = event.target.files;
        for (let file of files) {
          t
            let fileElement = document.createElement('div');
            fileElement.classList.add('chat-message', 'from-me', 'mb-2');
            fileElement.innerHTML = `<i class="bi bi-file-earmark"></i> ${file.name}`;
            chatBody.appendChild(fileElement);
        }
        chatBody.scrollTop = chatBody.scrollHeight; 
    });
</script>

</body>

</html>