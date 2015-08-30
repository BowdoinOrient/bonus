<? $this->load->view('template/head'); ?>

<style>
.content {
    position: relative;
    width: 100%;
    height: 1957px;
    overflow: scroll;
    -webkit-overflow-scrolling:touch;
}
</style>

<body>

<? $this->load->view('template/bodyheader', $headerdata); ?>

<div class="content">    
    <!-- 
    <header>
        <hgroup>
            <h2 id="articletitle" class="articletitle">This application is closed.</h2>
        </hgroup>            
    </header>
    -->
    <iframe id="survey" src="https://docs.google.com/forms/d/1cuTLq15EI7i4rLuUOsBnMA99FZoB24mAfZqroX-9edI/viewform?embedded=true" width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
</div>

<? $this->load->view('template/bodyfooter', $footerdata); ?>
<? $this->load->view('bonus/bonusbar', TRUE); ?>

</body>
</html>
