<?if(bonus()):?>

	<div id="bonusbar" class="bonusbar">
	<span id="bonusbarnav" class="bonusbarnav">
		&#x235f; / 	
		<?if(substr(uri_string(),0,6)=="bonus/"):?>
		<a href="<?=site_url()?>">Home</a> 
		<?else:?>
		<a href="<?=site_url()?>bonus/dashboard">Dashboard</a> 
		<?endif;?>
		<button class="bonusbutton" id="bonus-logout">Logout of <?=username()?></button>
		<span id="login-notify"></span>
	</span>

	<?if(substr(uri_string(),0,8)=="article/"):?>
		<button id="publisharticle" class="bonusbutton" style="<? if($article->published): ?>display:none;<?endif;?>">Publish</button>
		<button id="savearticle" class="bonusbutton">Save</button>
		<span id="bonustools">
			<span id="savenotify"></span>
			Vol. <input type="text" name="volume" id="volume" size="2" value="<?=$article->volume?>" />
			/ No. <input type="text" name="issue_number" id="issue_number" size="2" value="<?=$article->issue_number?>" />
			<input type="hidden" name="section_id" id="section_id" size="2" value="<?=$article->section_id?>" />
			/ Priority <input type="text" name="priority" id="priority" size="2" value="<?=$article->priority?>" />
			<? if($article->published): ?>/ <a href="#" class="delete" id="unpublish">Unpublish</a><?endif;?>
			/ <a href="#" class="delete" id="deletearticle">Delete</a>
		</span>
	<?endif;?>
	
	</div>

<?else:?>

<style>
#bonus-login-mini {
	display:none;
	border-right: 1px white solid;
}
#bonus-login-mini form {
	display:inline;
}
</style>

	<div id="bonushook">
		<a href="#" id="bonus-login-enable">&#x235f;</a>
	</div>
	<div id="bonus-login-mini" class="bonusbar" style="width:auto !important;">
		<span class="bonus-hook">&#x235f;</span>
		<form id="bonus-login-mini-form">
			<input type="text" size="20" id="username" name="username" placeholder="Username"/>
			<input type="password" size="20" id="password" name="password" placeholder="Password"/>
			<button type="submit" id="bonus-login-mini-submit">Go</button>
		</form>
		<span id="login-notify"></span>
	</div>

<?endif;?>

<script>
$(document).ready(function()
{
	$("#bonushook").click(function() {
		$("#bonushook").hide();
		$("#bonus-login-mini").show();
		$("#bonus-login-mini form #username").focus();
	});
	$("#bonus-login-mini .bonus-hook").click(function() {
		$("#bonushook").show();
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