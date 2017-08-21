<style>

	body{
		margin: 0;
	}

   .header-min {
   		margin: 0;
   		background: linear-gradient(to right, #599333, #fff);
   		width: 900px;
   		height: 50px;
   }

   .content{
   		padding-left: 50px;
   		display: inline-block;
   		position: relative;
   		top: -77px;
   }	

   .error-img{
   		display: inline-block;
   		margin-top: 50px;
   		margin-left: 150px;
   }

   .block{
   		height: 300px;
   		min-width: 1156px;
   }
</style>

<title>ГУД | Доступ заблокирован</title> 


<div class="header-min">

</div>

<div class="block">
<img src="/img/another/Warning_Basic_Full_TRAN.png" class="error-img">

<div class="content">
	<h2>Доступ заблокирован</h2>
	<h3>У Вас недостаточно прав для доступа к этой странице. Требуются права <?= $role?>.</h3>
	<p>
		Для перехода к данной странице <a href="/authorization/login">авторизуйтесь</a> с валидными правами доступа или вернитесь <a href="javascript:history.back();">назад</a>.
	</p>
</div>
</div>
<?php die();?>