







//SCRIPT POUR AFFICHER SOUS MENU

$(window).on("load", function () {

    //cacher les sous menu
    $("div#pierreprecieuse, div#joaillerie, div#horlogerie, div#nouveaute").hide();


    //afficher les sous menu



    $('.sousmenuJ, #joaillerie').hover(
        function () {

            //cacher les sous menu
            $("div#pierreprecieuse, div#horlogerie, div#nouveaute").hide();

            $('#joaillerie').stop().slideDown(400);
        },
        function () {
            $('#joaillerie').stop().slideUp(400);
        }
    );

    $('.sousmenuP, #pierreprecieuse').hover(
        function () {

            //cacher les sous menu
            $(" div#joaillerie, div#horlogerie, div#nouveaute").hide();

            $('#pierreprecieuse').stop().slideDown(400);
        },


        function () {
            $('#pierreprecieuse').stop().slideUp(400);
        }
    );

    $("li.sousmenuH, #horlogerie").hover(
        function () {

            //cacher les sous menu
            $("div#pierreprecieuse, div#joaillerie, div#nouveaute").hide();

            $('#horlogerie').stop().slideDown(400);
        },
        function () {
            $('#horlogerie').stop().slideUp(400);
        }
    );

    $("li.sousmenuN, div#nouveaute").hover(
        function () {

            //cacher les sous menu
            $("div#pierreprecieuse, div#joaillerie, div#horlogerie").hide();

            $('#nouveaute').stop().slideDown(400);
        },
        function () {
            $('#nouveaute').stop().slideUp(400);
        }
    );

    // SOULIGNER ELEMENT MENU LORSQUE LA DIV SOUSMENU EST SORTI 
    $('#joaillerie').hover(
        function () {
            $(".sousmenuJ").addClass('underlineU'); // Ajout de la classe 'underline' lors du survol de #joaillerie
        },
        function () {
            $(".sousmenuJ").removeClass('underlineU'); // Retrait de la classe 'underline' lorsqu'on ne survole plus #joaillerie
        }
    );

    $('#pierreprecieuse').hover(
        function () {
            $(".sousmenuP").addClass('underlineU'); // Ajout de la classe 'underline' lors du survol de #joaillerie
        },
        function () {
            $(".sousmenuP").removeClass('underlineU'); // Retrait de la classe 'underline' lorsqu'on ne survole plus #joaillerie
        }
    );

    $('#horlogerie').hover(
        function () {
            $(".sousmenuH").addClass('underlineU'); // Ajout de la classe 'underline' lors du survol de #joaillerie
        },
        function () {
            $(".sousmenuH").removeClass('underlineU'); // Retrait de la classe 'underline' lorsqu'on ne survole plus #joaillerie
        }
    );




    //AFFICHER SOUS MENU BURGER + ICONE QUI CHANGE AU CLIQUE ET QUI RESET LES AUTRES ICONE DES BOUTON ( SM1 SM2 SM3)

    $(".sousmenu1, .sousmenu2, .sousmenu3").hide();

    $(".sm1").click(function () {
        let icon = $(this).find('i');
        if (icon.hasClass('fa-circle-chevron-down')) {
            icon.removeClass('fa-circle-chevron-down');
            icon.addClass('fa-circle-chevron-up');
        } else {
            icon.removeClass('fa-circle-chevron-up');
            icon.addClass('fa-circle-chevron-down');
        }

        // Reset bouton chevron
        $('.sm2, .sm3').find('i').removeClass('fa-circle-chevron-up').addClass('fa-circle-chevron-down');
        $(".sousmenu2, .sousmenu3").fadeOut(0);
        $(".sousmenu1").stop().fadeToggle(600);
      
    });

    $(".sm2").click(function () {
        let icon = $(this).find('i');
        if (icon.hasClass('fa-circle-chevron-down')) {
            icon.removeClass('fa-circle-chevron-down');
            icon.addClass('fa-circle-chevron-up');
        } else {
            icon.removeClass('fa-circle-chevron-up');
            icon.addClass('fa-circle-chevron-down');
        }

        // Reset bouton chevron
        $('.sm1, .sm3').find('i').removeClass('fa-circle-chevron-up').addClass('fa-circle-chevron-down');
        $(".sousmenu1, .sousmenu3").fadeOut(0);
        $(".sousmenu2").stop().fadeToggle(600);
      
    });

    $(".sm3").click(function () {
        let icon = $(this).find('i');
        if (icon.hasClass('fa-circle-chevron-down')) {
            icon.removeClass('fa-circle-chevron-down');
            icon.addClass('fa-circle-chevron-up');
        } else {
            icon.removeClass('fa-circle-chevron-up');
            icon.addClass('fa-circle-chevron-down');
        }

        // Reset bouton chevron
        $('.sm1, .sm2').find('i').removeClass('fa-circle-chevron-up').addClass('fa-circle-chevron-down');
        $(".sousmenu2, .sousmenu1").fadeOut(0);
        $(".sousmenu3").stop().fadeToggle(600);
        
    });




    //RESET SOUS MENU AU CLIQUE DU HAMBURGER

    $("input.checkbox").click(function () {
        $(".sousmenu1, .sousmenu2, .sousmenu3").slideUp();
        // Reset bouton chevrons
        $('.sm1, .sm2, .sm3').find('i').removeClass('fa-circle-chevron-up').addClass('fa-circle-chevron-down');
    })


});//FIN FONCTION SOUS MENU

// MENU STICKY

//fixer le menu Navigation
            // relever la position du menu par rapport au document
            let mn = $("nav").offset().top;

            $(window).scroll(function () {
                let scrl = $(window).scrollTop();

                //fixation du menu
                if (scrl >= mn) {
                    $("nav.website").css({
                        "position": "fixed",
                        "z-index": 99999,
                        "top": 0,
                        "left": 0,
                        "background-color": "black"
                    });
                    $("#nouveaute, #joaillerie, #pierreprecieuse, #horlogerie").css({
                        "background-color": "black"
                    });
                } else {
                    $("nav.website").css({
                        "position": "static",
                        "width" : '100%',
                        "background-color": "transparent"
                    });
                    $("#nouveaute, #joaillerie, #pierreprecieuse, #horlogerie").css({
                        "background-color": "rgba(0, 0, 0, 0.6)"
                    });
                }

            });


//fixer le menu HAmburger
 // relever la position du menu par rapport au document


 $(".navbar1").css({
    "position": "fixed",
    "z-index": 99999,
    "top": 0,
    "left": 0,
    
 })


//FONCTION AJOUTER SEULEMENT POUR CONTRER LE BUG DE LA TAILLE DES IMAGES DES SOUS MENU EN ATTENDANT DE TROUVER UNE AUTRE SOLUTION
 //$(window).resize(function() {
  //  if ($(window).width() <= 720) {
   //    location.reload();
 //  } else {
 //     location.reload();
//   }
// });



// ANIMATION DIV PHOTO TEXT 
let xOffset;

const windowWidth = window.innerWidth;

if (windowWidth <= 650) {            // Pour les smartphones
    xOffset = '-250%';
} else if (windowWidth <= 855) {     // Pour les tablettes
    xOffset = '-200%';
} else {                             // Pour les grands écrans
    xOffset = '-100%';
}

gsap.from("#phototextphoto", {
    x: xOffset,
    opacity: 0, 
    ease: "power4.out", 
    scrollTrigger: {
        trigger: "#phototextphoto",
        start: "top 60%", 
        end: "bottom 60%",
        scrub: 1.5
    }
});

gsap.from("#phototexttext", {
    
    opacity: 0, 
    ease: "power4.out", 
    scrollTrigger: {
        trigger: "#phototext",
        start: "top 60%", 
        end: "bottom 60%",
        scrub: 1.5
    }
});

//animation #photopub

gsap.set("#photopub", {opacity: 0, y: 30, scale: 0.2});

let tl2 = gsap.timeline({
    scrollTrigger: {
        trigger: "#photopub",
        start: "top 75%",
        end: "bottom 60%",
        scrub: 1.5
    }
});

// Animation de l'élément
tl2.to("#photopub", {opacity: 1, y: 0, duration: 3, scale: 1});




//ANIMATION DIV NINE PICS
gsap.registerPlugin(ScrollTrigger);

// Pour l'élément venant de la gauche
gsap.from("#ninegauche img", {
    rotation: -90, 
    x: '-150%', 
    opacity: 0, 
    ease: "power4.out", 
    scrollTrigger: {
        trigger: "#ninegauche img",
        start: "top 60%", 
        end: "bottom 60%",
        scrub: 1.5
    }
});

// Rotation + Déplacement pour #ninedroite
gsap.from("#ninedroite", {
    rotation: 90, 
    xPercent: -200, 
    opacity: 0, 
    ease: "power4.out", 
    scrollTrigger: {
        trigger: "#ninedroite",
        start: "top 80%", 
        end: "bottom 50%",
        scrub: 1.5
    }
});

// Rotation + Déplacement pour #ninedroite img
gsap.from("#ninedroite img", { 
    opacity: 0, 
    ease: "ease.out", 
    scrollTrigger: {
        trigger: "#ninedroite img",
        start: "top 80%", 
        end: "bottom 50%",
        scrub: 1.5
    }
});

//INTERACTION FORMNULAIRE NEWSLETTER
$(document).ready(function() {
    $('#buttonnewsletter, #bn').click(function(event) {
        event.preventDefault();

        const emailInputElement = $('#emailInput');
        const emailInputValue = emailInputElement.val();
        const emailError = $('#emailError');
        const thankYouMessage = $('#thankYouMessage');

        // Vérifie si le champ est vide
        if (emailInputValue === "") {
            emailError.text("Veuillez entrer une adresse e-mail.");
            emailError.css('color', 'red');
            thankYouMessage.text("");  // <-- Ajouté pour masquer le message de remerciement
            return;
        }

        // Vérifie si l'adresse e-mail est valide
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailRegex.test(emailInputValue)) {
            emailError.text("Veuillez entrer une adresse e-mail valide.");
            emailError.css('color', 'red');
            thankYouMessage.text("");  // <-- Ajouté pour masquer le message de remerciement
            return;
        }

        // Si tout va bien, réinitialisez le message d'erreur et affichez le message de remerciement
        emailError.text("");
        thankYouMessage.text("Merci de vous être abonné à notre newsletter!");
        thankYouMessage.css('color', 'white');

        // Réinitialisez le champ d'entrée
        emailInputElement.val("");
    });
});

//ANIMATION NOTRE HISTOIRE + animation div la perle (texte sous le carousel)
// Initialisation
gsap.set("#notrehistoire img", {opacity: 0, scale: 0.2});
gsap.set("#notrehistoire h3, #notrehistoire h1, #notrehistoire hr, #notrehistoire p", {opacity: 0, y: 100});

let tl = gsap.timeline({
    scrollTrigger: {
        trigger: "#notrehistoire",
        start: "top 30%", 
        end: "bottom 60%",
        scrub: 1.5 ,
    }
});

// Animation de l'image en premier
tl.to("#notrehistoire img", {opacity: 1, scale: 1, duration: 1})

  // Ensuite, animation des éléments de texte séquentiellement avec un léger décalage
  .to("#notrehistoire h3", {opacity: 1, y: 0, duration: 0.4}, "+=0.1")
  .to("#notrehistoire h1", {opacity: 1, y: 0, duration: 0.4}, "+=0.1")
  .to("#notrehistoire hr", {opacity: 1, y: 0, duration: 0.4}, "+=0.1")
  .to("#notrehistoire p", {opacity: 1, y: 0, duration: 0.4}, "+=0.1");

  gsap.set("#laperle", {opacity: 0, scale: 0.2});
  gsap.set("#notrehistoire h3, #notrehistoire h1, #notrehistoire hr, #notrehistoire p", {opacity: 0, y: 100});
  
  let tl23 = gsap.timeline({
      scrollTrigger: {
          trigger: "#laperle",
          start: "top 80%", 
          end: "bottom 40%",
          scrub: 1.5 ,
      }
  });
  
  // Animation de l'image en premier
  tl23.to("#laperle", {opacity: 1, scale: 1, duration: 1})

 


//VIDEO***********************
$(document).ready(function() {
    let $video = $("video");

    // Lancer la vidéo une fois que la page est chargée
    $video.trigger("play");

    // Relancer la vidéo du début lorsqu'elle se termine
    $video.on("ended", function() {
        this.currentTime = 0;
        $(this).trigger("play");
    });
});



//ANIMATION PAGE LA MAISON DIX MIX**********************************

gsap.registerPlugin(ScrollTrigger);

// ANIMATION IMAGE
gsap.from(".imgmix1", { 
    x: '-100%', 
    opacity: 0, 
    ease: "power4.out", 
    scrollTrigger: {
        trigger: ".imgmix1",
        start: "top 60%", 
        end: "bottom 60%",
        scrub: 1.5
    }
});

gsap.from(".imgmix2", { 

    opacity: 0, 
    ease: "power4.out", 
    scrollTrigger: {
        trigger: ".imgmix2",
        start: "top 60%", 
        end: "bottom 60%",
        scrub: 1.5
    }
});

gsap.from(".imgmix3", {

    x: '-100%', 
    opacity: 0, 
    ease: "power4.out", 
    scrollTrigger: {
        trigger: ".imgmix3",
        start: "top 60%", 
        end: "bottom 60%",
        scrub: 1.5
    }
});

//ANIMATION TEXTE
gsap.from(".mix1", {
    x: '-100%', 
    opacity: 0, 
    ease: "power4.out", 
    scrollTrigger: {
        trigger: ".mix1",
        start: "top 80%", 
        end: "bottom 50%",
        scrub: 1.5
    }
});

gsap.from(".mix2", {
    x: '-100%', 
    opacity: 0, 
    ease: "power4.out", 
    scrollTrigger: {
        trigger: ".mix2",
        start: "top 80%", 
        end: "bottom 50%",
        scrub: 1.5
    }
});

gsap.from(".mix3", {
    x: '-100%', 
    opacity: 0, 
    ease: "power4.out", 
    scrollTrigger: {
        trigger: ".mix3",
        start: "top 80%", 
        end: "bottom 50%",
        scrub: 1.5
    }
});

//FIN ANIMATION PAGE LA MAISON DIX MIX**********************************


//SORTIE MESSAGE POUR LA PAGE NOUVEAUTE




$.getJSON('data.json', function(data) {
    $.each(data, function(collection, articles) {
        // Convertir le titre de la collection en un ID adapté pour une ancre
        let collectionID = collection.toLowerCase();
        
        // Créer la balise h1 avec l'ID de la collection comme identifiant
        let output = `<h1 class="collection-title" id="${collectionID}">${collection}</h1>`;
        
        output += '<div class="collection-row">'; // Nouveau div pour grouper les articles en ligne

        $.each(articles, function(index, article) {
            output += `
                <div class="item-card1">
                    <img src="${article.image}" alt="${article.titre}">
                    <div class="item-text1">
                        <h3>${article.titre}</h3>
                        <p>${article.description}</p>
                        <span>${article.prix}</span>
                        <a href="${article.lien}" class="item-link">En savoir plus</a>
                    </div>
                </div>
            `;
        });

        output += '</div>'; // Fin du div collection-row
        $('#sortienouveaute').append(output);
    });
// Une fois tout le contenu généré, déclenchez l'événement personnalisé
$(document).trigger("contentLoaded");


});

//ANIMER LE SCROLL JUSQUAU HASH #venus #carte etcc****************
$(window).on('load', function() {
    setTimeout(function() {
        if (window.location.hash) {
            let hash = window.location.hash;
            if ($(hash).length) {  // Vérifiez si l'élément existe
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 1000);
            }
        }
    }, 100);  // Retard de 100ms
});







//AJOUTER LE CLIQUE POUR LA PAGE NOUVEAUTE POUR LES SMARTPHONE POUR AFFICHER LES INFO
$(document).ready(function() {
    $('.item-card').click(function() {
        // Trouver le texte associé à l'élément sur lequel l'utilisateur a cliqué
        let itemText = $(this).find('.item-text');

        // Masquer tous les autres textes affichés (si vous voulez que seulement un soit ouvert à la fois)
        $('.item-text').not(itemText).hide();

        // Afficher ou masquer le texte
        itemText.toggle();
    });
});





//COOKIE*********************************


$(document).ready(function() {
    setTimeout(function() {
        $('.cookie-modal').fadeIn();
    }, 1000);

    $('.accept-btn').click(function() {
        $('.cookie-modal').fadeOut();
        // Vous pouvez ajouter ici un code pour sauvegarder la préférence de l'utilisateur, par exemple en utilisant les cookies
    });

    $('.refuse-btn').click(function() {
        $('.cookie-modal').fadeOut();
        // Vous pouvez ajouter ici un code pour sauvegarder la préférence de l'utilisateur, par exemple en utilisant les cookies
    });
});




//FORMULAIRE DE CONTACT

$(document).ready(function() {
    $("#contactForm").submit(function(event) {
        event.preventDefault();  // Empêche l'envoi du formulaire par défaut

        // Initialisation des erreurs
        let hasError = false;

        // Vérification du prénom
        if ($("#firstName").val() === "") {
            $("#errorfirstname").text("Veuillez entrer votre prénom.");
            hasError = true;
        } else {
            $("#errorfirstname").text("");
        }

        // Vérification du nom
        if ($("#lastName").val() === "") {
            $("#errorlastname").text("Veuillez entrer votre nom.");
            hasError = true;
        } else {
            $("#errorlastname").text("");
        }

        // Vérification de l'email
        let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        let email = $("#email").val();
        if (email === "") {
            $("#emailError").text("Veuillez entrer votre email.");
            hasError = true;
        } else if (!emailPattern.test(email)) {
            $("#emailError").text("Veuillez entrer un email valide.");
            hasError = true;
        } else {
            $("#emailError").text("");
        }

        // Vérification du message
        if ($("#message").val() === "") {
            $("#errormessage").text("Veuillez entrer votre message.");
            hasError = true;
        } else {
            $("#errormessage").text("");
        }

        // Vérification de la case à cocher
        if (!$("#dataAgreement").prop('checked')) {
            $("#dataAgreement").next().css("color", "red");
            hasError = true;
        } else {
            $("#dataAgreement").next().css("color", "");
        }

        // Si tout est correct, affichez le message de remerciement
        if (!hasError) {
            $(".contact-form-container").html('<img id="photomerci"src="/Photographie/photopagecontact/employe.png" alt="Remerciement"><div id="thankYouMessage">Merci pour votre message, nous vous recontactons très rapidement !</div>');
        }
    });
});

//animation page contact
$(document).ready(function() {
    gsap.registerPlugin(ScrollTrigger);

    gsap.from('.image-container', {
        opacity: 0,
        scale: 0.4,
        duration: 1.5,
        stagger: 0.3,
        ease: 'power3.out',
        scrollTrigger: {
            trigger: '.contact-container',
            start: 'top center',
            end: 'bottom center',
            scrub: true
        }
    });
});

$(document).ready(function() {
    gsap.registerPlugin(ScrollTrigger);

    gsap.from('#coordonne, #carte', {
        opacity: 0,
        scale: 0.4,
        duration: 1.5,
        stagger: 0.3,
        ease: 'power3.out',
        scrollTrigger: {
            trigger: '#carteadresse',
            start: 'top center',
            end: 'bottom 70%',
            scrub: true
        }
    });
});




//LOGIN FENETRE
$(document).ready(function() {
    $('button.button-admin').click(function(){
    
        $("div.admin-login-form").toggleClass('login-show');
    })

    $('i#croix-admin').click(function(){
    
        $("div.admin-login-form").toggleClass('login-show');
    })
});

//fonction pour le formulaire de modife des admin
function editAdmin(admin) {
    $('#editId').val(admin.id_user);
    $('#editUsername').val(admin.username);
    $('#editNom').val(admin.nom);
    $('#editPrenom').val(admin.prenom);
    $('#editEmail').val(admin.email);
    $('#editForm').css({
        'right': '50%',
        'transform': 'translateX(50%) translateY(-50%)',
        'z-index': '10'
    });
    $('#deleteForm').css('right', '-100%');
}

//fonction pour le formulaire de suppression des admin
function deleteAdmin(admin) {
    $('#deleteId').val(admin.id_user);
    $('#adminInfo').text(admin.nom + " " + admin.prenom + " " + admin.email);
    $('#deleteForm').css({
        'right': '50%',
        'transform': 'translateX(50%) translateY(-50%)',
        'z-index': '10'
    });
    $('#editForm').css('right', '-100%');
}

//fonction pour le formulaire de modife des créateurs
function editCreat(creat) {
    $('#editId').val(creat.id_createur);
    $('#editCreateur').val(creat.nom_createur);
    $('#editWebsite').val(creat.website);
    $('#editForm').css({
        'right': '50%',
        'transform': 'translateX(50%) translateY(-50%)',
        'z-index': '10'
    });
    $('#deleteForm').css('right', '-100%');
}

//fonction pour le formulaire de suppression des créateurs
function deleteCreat(creat) {
    $('#deleteId').val(creat.id_createur);
    $('#creatInfo').text(creat.nom_createur);
    $('#deleteForm').css({
        'right': '50%',
        'transform': 'translateX(50%) translateY(-50%)',
        'z-index': '10'
    });
    $('#editForm').css('right', '-100%');
}

//fonction pour le formulaire de modife des catégories
function editCat(cat) {
    $('#editId').val(cat.id_categorie);
    $('#editCategorie').val(cat.nom_categorie);
    $('select[name="type_categorie"]').val(cat.type_categorie);
   
    $('#editForm').css({
        'right': '50%',
        'transform': 'translateX(50%) translateY(-50%)',
        'z-index': '10'
    });
    $('#deleteForm').css('right', '-100%');
}

//fonction pour le formulaire de suppression des catégorie
function deleteCat(cat) {
    $('#deleteId').val(cat.id_categorie);
    $('#catInfo').text(cat.nom_categorie);
    $('#deleteForm').css({
        'right': '50%',
        'transform': 'translateX(50%) translateY(-50%)',
        'z-index': '10'
    });
    $('#editForm').css('right', '-100%');
}

// EDIT ARTICLE
function editArticle(article, buttonElement) {
    // Mettre à jour les champs du formulaire avec les données de l'article
    $('#editId').val(article.id_article);
    $('#editArticle').val(article.nom_article);
    $('#editPrixarticle').val(article.prix_article);
    $('#editDescription').val(article.description_article);
    $('#form_add_article.update_article select[name="ref_createur"]').val(article.ref_createur);
    $('#form_add_article.update_article select[name="genre"]').val(article.genre);

      // Décocher toutes les catégories d'abord
      $('input[name="ref_categorie[]"]').prop('checked', false);

     // Cocher les catégories
    $('#form_add_article.update_article input[type="checkbox"], #form_add_article.update_article input[type="radio"]').prop('checked', false); // Décocher toutes les cases

    if (article.categories && article.categories.length) {
        article.categories.forEach(function(categoryId) {
            // Cocher la case pour chaque catégorie
            $('#form_add_article.update_article input[value="' + categoryId + '"]').prop('checked', true);
        });}
  


   // Calculer la position du bouton et ajuster la position de la div
   let $button = $(buttonElement);
   let buttonOffset = $button.offset();
   let formTop = buttonOffset.top

   // Positionner la div en fonction du bouton
   $('#update_form_article').css({
       'top': (formTop - 2500) + 'px',
       'right': '10%',
       'z-index': '10'
   }).show();

   $('#deleteForm').css('right', '-300%');
}

//fonction pour le formulaire de suppression des articles
function deleteArticle(article, buttonElement) {
    $('#deleteId').val(article.id_article);
    $('#articleInfo').text(article.nom_article);
    
  
    $('#deleteForm').css({
        'right': '23%',
        'top': '30%',
        'z-index': '10'
    }).show();
    $('#editForm').css('right', '-300%');
}





//FERMER FENETRE ADMIN UPDATE

$('#croix-update-admin').click(function(){
    $('#editForm, #update_form_article').css('right', '-300%');
});

$('#croix-delete-admin').click(function(){
    $('#deleteForm').css('right', '-300%');
});


//FONCTION POUR AFFICHER LE MOT DE PASSE
$(document).ready(function() {
    $('#togglePassword').click(function() {
        let passwordInput = $('#password');
        if (passwordInput.attr('type') === "password") {
            passwordInput.attr('type', 'text');
        } else {
            passwordInput.attr('type', 'password');
        }
    });
});



