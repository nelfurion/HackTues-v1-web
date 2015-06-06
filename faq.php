<?php 

    require_once 'functions/user/init.php';

    if (Session::exists('home'))
    {
        echo Session::flash('home');
    }

    $user = new User();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>FAQ</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">		
	<title>HackTUES</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">		
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<header>		
			<div class="row">					
				<div class="col-sm-12">
                    <a href="home"><h1>Hack<span class="blue">TUES</span></h1></a>
				</div>
			</div>
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
		            		<span class="sr-only">Toggle navigation</span>
		            		<span class="icon-bar"></span>
		            		<span class="icon-bar"></span>
		            		<span class="icon-bar"></span>
		          		</button>
					</div>
					<div id="navbar" class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<li><a href="home">Начало</a></li>
                            <li><a href="teams">Отбори</a></li>
							<li><a href="prizes">Награди</a></li>
							<li><a href="rules">Регламент</a></li>
							<li class="active"><a href="#">FAQ<span class="sr-only">(current)</span></a></li>
                            <?php 
                                if ($user->isLoggedIn())
                                {
                            ?>
                                <li><a href="profile">Профил</a></li>
                                <!-- <a href="/<?php echo escape($user->getData()->username); ?>"> -->
                                <li><a href="logout.php">Излез</a></li>
                            <?php
                                }
                            ?>                            		        	        
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<hr />
		<div class="jumbotron">
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                Секцията за често задавани въпроси покрива доста информация за хакатона. Ако все пак сте несигурни относно нещо, свържете се с нас.
            </div>
            <div class="panel-group" id="accordion">
                <div class="faqHeader">Основни въпроси</div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Каква е темата на хакатона и какво включва?</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                            Автоматизация и софтуер за подобрение на учебния процес a.k.a. Hack for TUES a.k.a. Hack for education.
                            <br>
                            Тоест състезателите трябва да създадат проект, който по някакъв начин да подпомага учебния процес в ТУЕС или като цяло.
                            Проектите могат да бъдат най-различни, от автоматизиране на целия процес, до конкретни приложения за конкретни предмети.
                            <br>
                            С две думи - каквото ви дойде на ум.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Кога и къде ще се проведе хакатона?</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            Доопределят се датите, а мястото е ТУЕС.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Имате въпроси или препоръки?</a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            Пишете ни на httues@gmail.com.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFinished">Трябва ли проектът да бъде завършен до края на състезанието?</a>
                        </h4>
                    </div>
                    <div id="collapseFinished" class="panel-collapse collapse">
                        <div class="panel-body">
                            Не. Разбираме, че времето е малко и това би било много трудно за постигане, ако не и невъзможно.
                            <br>
                            Трябва обаче, отборите/състезателите да могат да покажат какво представляват идеите им. Ако могат да завършат проектите си на време,
                            разбира се би било супер.
                        </div>
                    </div>

                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOutsiders">Могат ли външни хора да участват в състезанието?</a>
                        </h4>
                    </div>
                    <div id="collapseOutsiders" class="panel-collapse collapse">
                        <div class="panel-body">
                            Състезанието е за учениците на ТУЕС към ТУ-София. Външни хора, поне за това издание на състезанието не могат да участват.
                        </div>
                    </div>
                    
                </div>

                <div class="faqHeader">Записване</div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">Задължителна ли е регистрацията през сайта?</a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            <strong>Да, за хората, които не са се регистрирали до сега(през формата).</strong> Ако имате проблеми с регистрацията можете да ни пишете на имейл: httues@gmail.com.
                        </div>
                    </div>
                </div>
                <div class="faqHeader">Организация</div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">Как се разпределят отборите?</a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse">
                        <div class="panel-body">
                        	Участниците имат правото сами да съставят отборите си. През първия ден съставените отбори/самостоятелни състезатели ще могат да представят идеите си
                            и да потърсят още хора, ако им трябват. Хората, които не са си намерили отбори до тогава, ще могат да го направят тогава.
                            <br>Ако след това все още има хора без отбори, те трябва да се объррнат към някой от организаторите. Ако все пак искат да участват без
                            отбори, могат, позволено е.
                        </div>
                    </div>
                </div>
        <!--
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">На какъв принцип става оценяването?</a>
                </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse">
                <div class="panel-body">
                    Проектите се оценяват от жури. През последният ден, отборите/състезателите представвят своите проекти(не е нужно да са напълно завършени).
                    Журито им задава въпроси относно тях и ги оценява. Победителите се разбират на края на хакатона.
                </div>
            </div>
        </div>
        -->
    </div>
		</div>
		<hr />
	</div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>