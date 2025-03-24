$(document).ready(function () {

  // Podesi visinu sekcija
  $("main#spapp > section").height($(document).height() - 60);

  // Inicijalizacija spapp.js sa error page
  var app = $.spapp({ pageNotFound: "error_404" });

  // Definišemo rute za SPA
  app.route({
      view: "movies",
      onCreate: function () {
          $("#movies").append($.now() + ": Home page created<br/>");
      },
      onReady: function () {
          $("#movies").append($.now() + ": Home page ready<br/>");
      }
  });

  app.route({ view: "movies", load: "pages/movies.html" });

  app.route({
      view: "profile",
      onCreate: function () {
          $("#profile").append("Welcome to your profile!");
      }
  });

  app.route({ view: "login", load: "pages/login.html" });

  // Pokreni SPA aplikaciju
  app.run();
});
