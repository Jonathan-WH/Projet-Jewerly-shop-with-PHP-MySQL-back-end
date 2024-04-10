<?php include('../layout/header.php')?>

<h1 id="nouveauteh1">NOUVEAUTÉES</h1>

<hr>


<div id="sortienouveaute"></div>

    
    


    <!--FIN DIV NEWSLETTER-->
    <div id="formnews">
        <hr id="hr5">
        <h3>Abonnez-vous à notre newsletter pour être les premier à découvrir les nouvelles collections</h3>
        <form id="newsletter" onsubmit="return false;">
            <div>

                <input type="mail" id="emailInput" placeholder="Email (champ obligatoire)">

            </div>
            <div>
                <button type="submit" id="bn">Envoyer</button>
            </div>
        </form>
        <div id="emailError"></div>
        <div id="thankYouMessage"></div>
        <hr id="hr6">
    </div>


    <!--FIN DIV NEWSLETTER-->


    <?php include('../layout/footer.php')?>