<?if(bonus()):?>

	<div id="bonusbar" class="bonusbar">
	
		<span id="bonus-left">
			<span class="bonus-hook" id="bonus-logout">&#x235f;</span> / 
			<?if(substr(uri_string(),0,6)=="bonus/"):?>
			<a href="<?=site_url()?>">Home</a> 
			<?else:?>
			<a href="<?=site_url()?>bonus/dashboard">Dashboard</a> 
			<?endif;?>
			<span class="hidemobile">/ Hello <?=username()?>.</span> <span id="login-notify"></span>
		</span>

		<?if(substr(uri_string(),0,8)=="article/"):?>
			<button id="publisharticle" style="<? if($article->published): ?>display:none;<?endif;?>">Publish</button>
			<button id="savearticle">Save</button>
			<span id="bonus-right">
				<span id="savenotify"></span>
				<span class="hidemobile">Vol. <input type="text" name="volume" id="volume" size="2" value="<?=$article->volume?>" />
				/ No. <input type="text" name="issue_number" id="issue_number" size="2" value="<?=$article->issue_number?>" />
				<input type="hidden" name="section_id" id="section_id" size="2" value="<?=$article->section_id?>" />
				/ Priority <input type="text" name="priority" id="priority" size="2" value="<?=$article->priority?>" />
				<? if($article->published): ?>/ <a href="#" class="delete" id="unpublish">Unpublish</a><?endif;?>
				/ <a href="#" class="delete" id="deletearticle">Delete</a></span>
			</span>
		<?endif;?>
	
	</div>

<?else:?>

	<div id="bonus-hook-wrapper">
		<span class="bonus-hook" id="bonus-login-enable">&#x235f;</span>
	</div>
	<div id="bonus-login-mini" class="bonusbar" style="width:auto !important;">
		<span class="bonus-hook">&#x235f;</span>
		<form id="bonus-login-mini-form">
			<input type="text" size="10" id="username" name="username" placeholder="Username" autocapitalize="off" autocorrect="off"/>
			<input type="password" size="10" id="password" name="password" placeholder="Password" autocapitalize="off" autocorrect="off"/>
			<button type="submit" id="bonus-login-mini-submit">Go</button>
		</form>
		<span id="login-notify"></span>
	</div>

<?endif;?>

<script>
$(document).ready(function()
{
	$("#bonus-login-enable").click(function() {
		$("#bonus-login-enable").hide();
		$("#bonus-login-mini").show();
		$("#bonus-login-mini form #username").focus();
	});
	$("#bonus-login-mini .bonus-hook").click(function() {
		$("#bonus-login-enable").show();
		$("#bonus-login-mini").hide();
	});	
	$("#bonus-login-mini-submit").click(function(event) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "<?=site_url()?>bonus/ajax_verifylogin/",
			data: {
				username: urlencode($('input[name=username]').val()),
				password: urlencode($('input[name=password]').val())
			},
			dataType: 'json',
			success: function(result){
				//show alert
				$("#login-notify").html(result.status);
				if(result.success) {
					//refresh page
					location.reload();
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				$("#login-notify").html("Login failed.");
			}
		});
	});
	$("#bonus-logout").click(function(event) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url: "<?=site_url()?>bonus/ajax_logout/",
			data: {
				logout: true
			},
			dataType: 'json',
			success: function(result){
				//show alert
				$("#login-notify").html(result.status);
				if(result.success) {
					//refresh page
					location.reload();
				}
			},
			error: function(XMLHttpRequest, textStatus, errorThrown){
				$("#login-notify").html("Logout failed.");
			}
		});
	});
});
</script>