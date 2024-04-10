<?php include('../layout/header.php')?>


<h1>CONTACT</h1>

<hr id="hrcontact">

<!--DEBUT FORMULAIRE-->
<div class="contact-container">
    <div class="contact-form-container">
        <form id="contactForm" action="#" method="post" novalidate>

            <div class="input-container">
                <label for="title">Civilité:</label>
                <select name="title" id="title" required>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mme</option>
                    <option value="Miss">Mlle</option>
                </select>
            </div>
            
            <div class="input-container">
                <label for="firstName">Prénom:</label>
                <input type="text" id="firstName" name="firstName" required>
                <span id="errorfirstname" class="error-message"></span>
            </div>

            <div class="input-container">
                <label for="lastName">Nom:</label>
                <input type="text" id="lastName" name="lastName" required>
                <span id="errorlastname" class="error-message"></span>
            </div>

            <div class="input-container">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <span id="emailError" class="error-message"></span>
            </div>

            <div class="input-container">
                <label for="phone">Numéro de téléphone:</label>
                <input type="tel" id="phone" name="phone">
            </div>

            <div class="input-container">
                <label for="subject">Objet:</label>
                <select name="subject" id="subject" required>
                    <option value="productInfo">Information produit</option>
                    <option value="priceRequest">Demande de prix</option>
                    <option value="customerService">Service client</option>
                    <option value="others">Divers</option>
                </select>
            </div>

            <div class="input-container">
                <label for="message">Votre message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
                <span id="errormessage" class="error-message"></span>
            </div>

            <div class="input-container">
                <input type="checkbox" id="dataAgreement" name="dataAgreement" required oninvalid="this.setCustomValidity('Veuillez accepter les conditions.')" oninput="setCustomValidity('')">
                <label for="dataAgreement">Veuillez accepter les conditions d'utilisation et la politique de confidentialité</label>
            </div>

            <button type="submit" id="c">Envoyer</button>
        </form>
    </div>
    
    <div class="image-container">
        <img src="/Photographie/photopagecontact/facade.png" alt="Une description de l'image">
    </div>
</div>


<div id="carteadresse">
    <div id="coordonne">
        <h3>adresse:</h3>
        <p>Rue du Rhône, 35 <br>
        1204 <br>
        Genève</p>
        <br>
        <h3>telephone:</h3>
        <a href="tel:+41444444444"><i class="fa-solid fa-phone" style="color: #ffffff;"></i>+41 44 444 44 44</a>
        <br>
        <h3>Mail:</h3>
        <a href="mailto:laperledulac@laperle.ch"><i class="fa-regular fa-envelope" style="color: #ffffff;"></i> laperledulac@laperle.ch</a>
        <br>
        <h3>Horaire d'ouverture:</h3>
        <br>
        <h5>lundi au vendredi: 10h - 19h</h5> 
        <h5> Samedi: 10h - 17h</h5>
         <h5>Dimanche fermé</h5>

    </div>

    <div id="carte">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2761.321976628603!2d6.146292813104854!3d46.20404957097509!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c652efaf84ee3%3A0x4d5afa50bb621b89!2sRue%20du%20Rh%C3%B4ne%2035%2C%201204%20Gen%C3%A8ve!5e0!3m2!1sfr!2sch!4v1692217463705!5m2!1sfr!2sch" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>

<!--FIN FORMULAIRE-->


    
    


<?php include('../layout/footer.php')?>